<?php

namespace App\Services;

use App\Models\ActivityBatch;
use App\Models\SpnDiscount;
use App\Models\SpnPricingPackage;
use App\Models\SpnReferralCode;
use App\Models\SpnRegistration;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use App\Mail\SpnRegistrationConfirmation;

class SpnRegistrationService
{
    public function calculateTotal(SpnPricingPackage $package, ?string $statusDiri, ?SpnReferralCode $referral): array
    {
        $hargaDasar = $package->base_price;
        $potonganDiskon = 0;
        $potonganReferal = 0;

        if ($statusDiri) {
            $discount = SpnDiscount::forStatus($statusDiri)
                ->where('activity_batch_id', $package->activity_batch_id)
                ->first();

            if ($discount) {
                $potonganDiskon = ($hargaDasar * $discount->discount_percent) / 100;
            }
        }

        if ($referral && $referral->isValid()) {
            $potonganReferal = $referral->discount_amount;
        }

        $totalBayar = $hargaDasar - $potonganDiskon - $potonganReferal;
        
        return [
            'harga_dasar' => $hargaDasar,
            'potongan_diskon' => $potonganDiskon,
            'potongan_referal' => $potonganReferal,
            'total_bayar' => max(0, $totalBayar), // Ensure total is not negative
        ];
    }

    public function generateRegistrationCode(ActivityBatch $batch): string
    {
        return DB::transaction(function () use ($batch) {
            $prefix = 'SPN' . $batch->batch_ke . '-';
            
            $lastReg = SpnRegistration::where('activity_batch_id', $batch->id)
                ->where('registration_code', 'like', $prefix . '%')
                ->orderBy('registration_code', 'desc')
                ->lockForUpdate()
                ->first();

            $sequence = 1;
            if ($lastReg) {
                $lastSequence = (int) substr($lastReg->registration_code, strlen($prefix));
                $sequence = $lastSequence + 1;
            }

            return $prefix . str_pad($sequence, 4, '0', STR_PAD_LEFT);
        });
    }

    public function createRegistration(array $data, $buktiFile = null): SpnRegistration
    {
        return DB::transaction(function () use ($data, $buktiFile) {
            $batch = ActivityBatch::findOrFail($data['activity_batch_id']);
            $data['registration_code'] = $this->generateRegistrationCode($batch);

            // Defensive check for recent migration columns (in case hosting hasn't run php artisan migrate yet)
            if (!Schema::hasColumn('spn_registrations', 'spn_discount_id')) {
                unset($data['spn_discount_id']);
            }
            if (!Schema::hasColumn('spn_registrations', 'discount_label')) {
                unset($data['discount_label']);
            }

            $registration = SpnRegistration::create($data);

            if ($buktiFile) {
                $registration->addMedia($buktiFile)->toMediaCollection('bukti_bayar');
            }

            if (!empty($data['spn_referral_code_id'])) {
                $referral = SpnReferralCode::find($data['spn_referral_code_id']);
                if ($referral) {
                    $referral->incrementUsage();
                }
            }

            // Phase 2: Auto-Create User & Email
            $user = User::where('email', $data['email'])->first();
            $activationToken = null;
            $hasExistingAccount = false;

            if (!$user) {
                // User baru -> buat akun otomatis dan buat activation token untuk set password
                $activationToken = Str::random(60);
                $user = User::create([
                    'name' => $data['nama_lengkap'],
                    'email' => $data['email'],
                    'password' => Hash::make(Str::random(16)),
                    'activation_token' => $activationToken,
                ]);
            } else {
                // User sudah terdaftar sebelumnya
                // Jika sudah memiliki akun aktif (activation_token kosong), tidak perlu aktivasi password lagi
                if (empty($user->activation_token)) {
                    $hasExistingAccount = true;
                } else {
                    $activationToken = $user->activation_token;
                }
            }

            // Link user_id back to SpnRegistration
            $registration->update(['user_id' => $user->id]);

            // Send confirmation email with graceful error handling so SMTP timeout doesn't break registration
            try {
                Mail::to($registration->email)->send(new SpnRegistrationConfirmation($registration, $activationToken, $hasExistingAccount));
            } catch (\Throwable $e) {
                Log::error('Gagal mengirim email konfirmasi pendaftaran SPN ke ' . $registration->email . ': ' . $e->getMessage());
            }

            return $registration;
        });
    }

    public function verifyRegistration(SpnRegistration $reg, User $admin, ?string $catatan = null): void
    {
        $reg->update([
            'status' => 'terverifikasi',
            'verified_by' => $admin->id,
            'verified_at' => Carbon::now(),
            'catatan_admin' => $catatan,
        ]);

        // NOTE: Alumni role + BatchAlumni record are NOT created here.
        // They are created automatically by the spn:promote-alumni command
        // after the activity batch's tanggal_selesai_kegiatan has passed.
    }

    public function rejectRegistration(SpnRegistration $reg, User $admin, string $catatan): void
    {
        DB::transaction(function () use ($reg, $admin, $catatan) {
            $reg->update([
                'status' => 'ditolak',
                'verified_by' => $admin->id,
                'verified_at' => Carbon::now(),
                'catatan_admin' => $catatan,
            ]);

            // send rejection email
            // Mail::to($reg->email)->send(new \App\Mail\SpnRegistrationRejected($reg));
        });
    }

    public function getStatistics(int $batchId): array
    {
        $registrations = SpnRegistration::forBatch($batchId)->get();
        
        $verifiedRegs = $registrations->where('status', 'terverifikasi');

        return [
            'total' => $registrations->count(),
            'pending' => $registrations->where('status', 'pending')->count(),
            'verified' => $verifiedRegs->count(),
            'rejected' => $registrations->where('status', 'ditolak')->count(),
            'total_infak' => $verifiedRegs->sum('total_bayar'),
            'packages' => $registrations->groupBy('paket')->map->count()->toArray(),
            'gender' => $registrations->groupBy('jenis_kelamin')->map->count()->toArray(),
        ];
    }
}
