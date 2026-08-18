<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityBatch;
use App\Models\SpnPricingPackage;
use App\Models\SpnRegistration;
use App\Services\SpnRegistrationService;
use App\Services\SpnReferralService;

class SpnRegistrationController extends Controller
{
    protected $registrationService;
    protected $referralService;

    public function __construct(SpnRegistrationService $registrationService, SpnReferralService $referralService)
    {
        $this->registrationService = $registrationService;
        $this->referralService = $referralService;
    }

    private function getActiveBatch()
    {
        ActivityBatch::updateExpiredBatches();

        return ActivityBatch::whereHas('activity', function ($q) {
            $q->whereIn('slug', ['sekolah-pranikah-offline', 'sekolah-pranikah-online', 'spn']);
        })->where('status', 'aktif')->latest()->first();
    }

    public function step1()
    {
        $batch = $this->getActiveBatch();
        if (!$batch || !$batch->isRegistrationOpen()) {
            return redirect()->route('spn.index')->with('info', 'Mohon maaf, saat ini pendaftaran Sekolah Pranikah sedang ditutup. Nantikan pembukaan batch berikutnya.');
        }

        $registeredCount = SpnRegistration::where('activity_batch_id', $batch->id)
            ->where('status', '!=', 'ditolak')
            ->count();

        if ($batch->kuota && $registeredCount >= $batch->kuota) {
            return redirect()->route('spn.index')->with('info', 'Mohon maaf, kuota pendaftaran untuk ' . ($batch->nama_batch ?? 'batch ini') . ' sudah penuh.');
        }

        return view('spn.daftar.langkah-1', compact('batch'));
    }

    public function storeStep1(Request $request)
    {
        $validated = $request->validate([
            'restu' => 'required|in:sudah,akan',
            'gambaran_awal' => 'required|string|max:500',
            'alasan' => 'required|string|max:500',
            'harapan' => 'required|string|max:500',
        ]);

        $request->session()->put('spn_step1', $validated);

        return redirect()->route('spn.daftar.step2');
    }

    public function step2()
    {
        $prefill = [];
        if (auth()->check()) {
            $user = auth()->user();
            $prevReg = SpnRegistration::where('user_id', $user->id)->latest()->first();
            $prefill = [
                'nama_lengkap' => $prevReg->nama_lengkap ?? $user->name,
                'nama_gelar' => $prevReg->nama_gelar ?? '',
                'nama_panggilan' => $prevReg->nama_panggilan ?? '',
                'jenis_kelamin' => $prevReg->jenis_kelamin ?? '',
                'email' => $user->email,
                'whatsapp' => $prevReg->whatsapp ?? '',
                'instagram' => $prevReg->instagram ?? '',
                'tanggal_lahir' => ($prevReg && $prevReg->tanggal_lahir) ? $prevReg->tanggal_lahir->format('Y-m-d') : '',
                'asal_daerah' => $prevReg->asal_daerah ?? '',
                'domisili' => $prevReg->domisili ?? '',
                'status_pernikahan' => $prevReg->status_pernikahan ?? '',
            ];
        }

        return view('spn.daftar.langkah-2', compact('prefill'));
    }

    public function storeStep2(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nama_gelar' => 'nullable|string|max:255',
            'nama_panggilan' => 'required|string|max:50',
            'jenis_kelamin' => 'required|in:pria,wanita',
            'email' => 'required|email|max:255',
            'whatsapp' => 'required|string|max:20',
            'instagram' => 'nullable|string|max:255',
            'tanggal_lahir' => 'required|date',
            'asal_daerah' => 'required|string|max:255',
            'domisili' => 'required|string|max:500',
            'status_pernikahan' => 'required|in:belum,menikah,pernah',
        ]);

        // Pencegahan pendaftaran ganda di batch yang sama
        $batch = $this->getActiveBatch();
        if ($batch) {
            $existingReg = SpnRegistration::where('activity_batch_id', $batch->id)
                ->where('email', $request->email)
                ->whereIn('status', ['pending', 'terverifikasi'])
                ->first();

            if ($existingReg) {
                return back()->withInput()->withErrors([
                    'email' => 'Email ' . $request->email . ' sudah terdaftar pada ' . ($batch->nama_batch ?? 'batch ini') . ' (Kode: #' . $existingReg->registration_code . ', Status: ' . ucfirst($existingReg->status) . '). Jika ingin mengecek status atau mengubah berkas, silakan login ke Dashboard Peserta.'
                ]);
            }
        }

        $validated['usia'] = \Carbon\Carbon::parse($validated['tanggal_lahir'])->age;

        $request->session()->put('spn_step2', $validated);

        return redirect()->route('spn.daftar.step3');
    }

    public function step3()
    {
        $prefill = [];
        if (auth()->check()) {
            $user = auth()->user();
            $prevReg = SpnRegistration::where('user_id', $user->id)->latest()->first();
            $prefill = [
                'pendidikan' => $prevReg->pendidikan ?? '',
                'status_diri' => $prevReg->status_diri ?? '',
                'pekerjaan' => $prevReg->pekerjaan ?? '',
                'jabatan' => $prevReg->jabatan ?? '',
                'instansi' => $prevReg->instansi ?? '',
                'lokasi_kerja' => $prevReg->lokasi_kerja ?? '',
                'universitas' => $prevReg->universitas ?? '',
                'jurusan' => $prevReg->jurusan ?? '',
                'angkatan' => $prevReg->angkatan ?? '',
            ];
        }

        return view('spn.daftar.langkah-3', compact('prefill'));
    }

    public function storeStep3(Request $request)
    {
        $rules = [
            'pendidikan' => 'required|string',
            'status_diri' => 'required|string',
            'pekerjaan' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'instansi' => 'required|string|max:255',
            'lokasi_kerja' => 'required|string|max:255',
        ];

        if ($request->status_diri === 'mahasiswa') {
            $rules['universitas'] = 'required|string';
            $rules['jurusan'] = 'required|string|max:255';
            $rules['angkatan'] = 'required|string|max:10';
        }

        $validated = $request->validate($rules);

        $request->session()->put('spn_step3', $validated);

        return redirect()->route('spn.daftar.step4');
    }

    public function step4(Request $request)
    {
        $batch = $this->getActiveBatch();
        if (!$batch) {
            return redirect()->route('spn.index')->with('error', 'Pendaftaran SPN saat ini sedang tidak dibuka.');
        }

        $packages = SpnPricingPackage::where('activity_batch_id', $batch->id)
                                     ->where('is_active', true)
                                     ->orderBy('sort_order')
                                     ->get();

        $allDiscounts = \App\Models\SpnDiscount::where('activity_batch_id', $batch->id)
                                            ->where('is_active', true)
                                            ->get();

        $step3 = $request->session()->get('spn_step3', []);
        $statusDiri = $step3['status_diri'] ?? '';
        $universitas = strtolower($step3['universitas'] ?? '');

        // Filter diskon yang hanya sesuai dengan status diri & universitas di Langkah 3
        $discounts = $allDiscounts->filter(function ($disc) use ($statusDiri, $universitas) {
            // Diskon umum terbuka (Alumni SSC/LMD, Staff Salman, dll)
            if (empty($disc->applies_to_status_diri) && empty($disc->category)) {
                return true;
            }
            if (in_array($disc->category, ['alumni_ssc', 'staff_salman'])) {
                return true;
            }
            // Mahasiswa ITB: Hanya jika status mahasiswa dan kampus ITB
            if ($disc->category === 'mahasiswa_itb' || $disc->applies_to_status_diri === 'mahasiswa') {
                return $statusDiri === 'mahasiswa' && $universitas === 'itb';
            }
            // Alumni ITB: Hanya jika alumni ITB
            if ($disc->category === 'alumni_itb' || $disc->applies_to_status_diri === 'alumni_itb') {
                return $statusDiri === 'alumni_itb' || $statusDiri === 'alumni';
            }
            // Karyawan/Dosen ITB: Hanya jika dosen atau karyawan
            if ($disc->category === 'karyawan_dosen' || $disc->applies_to_status_diri === 'dosen') {
                return $statusDiri === 'dosen' || $statusDiri === 'karyawan';
            }

            return $disc->applies_to_status_diri === $statusDiri;
        })->values();

        return view('spn.daftar.langkah-4', compact('packages', 'discounts'));
    }

    public function validateReferral(Request $request)
    {
        $code = $request->input('code');
        $result = $this->referralService->validateCode($code);

        return response()->json($result);
    }

    public function storeStep4(Request $request)
    {
        $validated = $request->validate([
            'paket' => 'required|exists:spn_pricing_packages,id',
            'spn_discount_id' => 'nullable|exists:spn_discounts,id',
            'metode_bayar' => 'required|in:qris,transfer',
            'info_dari' => 'required|string',
            'kode_referal' => 'nullable|string',
        ]);

        $package = SpnPricingPackage::find($validated['paket']);
        if (!$package->isAvailable()) {
            return back()->withInput()->withErrors([
                'paket' => 'Paket harga ' . $package->name . ' sudah ditutup atau tidak lagi tersedia. Silakan pilih paket yang aktif.'
            ]);
        }
        $hargaDasar = $package->base_price;
        $potonganDiskon = 0;
        $potonganReferal = 0;
        $spnReferralCodeId = null;
        $discountLabel = '';
        $selectedDiscountId = null;

        $isNormalBird = ($package->slug === 'normal_bird' || str_contains(strtolower($package->name), 'normal'));

        if ($isNormalBird && $request->filled('spn_discount_id')) {
            $discount = \App\Models\SpnDiscount::where('activity_batch_id', $package->activity_batch_id)
                ->where('id', $request->spn_discount_id)
                ->where('is_active', true)
                ->first();

            if ($discount) {
                // Validasi server-side kelayakan diskon terhadap data Langkah 3
                $step3 = $request->session()->get('spn_step3', []);
                $statusDiri = $step3['status_diri'] ?? '';
                $universitas = strtolower($step3['universitas'] ?? '');

                $isEligible = true;
                if ($discount->category === 'mahasiswa_itb' || $discount->applies_to_status_diri === 'mahasiswa') {
                    if ($statusDiri !== 'mahasiswa' || $universitas !== 'itb') {
                        $isEligible = false;
                    }
                } elseif ($discount->category === 'alumni_itb' || $discount->applies_to_status_diri === 'alumni_itb') {
                    if ($statusDiri !== 'alumni_itb' && $statusDiri !== 'alumni') {
                        $isEligible = false;
                    }
                } elseif ($discount->category === 'karyawan_dosen' || $discount->applies_to_status_diri === 'dosen') {
                    if ($statusDiri !== 'dosen' && $statusDiri !== 'karyawan') {
                        $isEligible = false;
                    }
                }

                if (!$isEligible) {
                    return back()->withInput()->withErrors([
                        'spn_discount_id' => 'Kategori diskon yang dipilih tidak sesuai dengan data kampus atau status diri yang Anda isi di Langkah 3.'
                    ]);
                }

                $selectedDiscountId = $discount->id;
                $potonganDiskon = round($hargaDasar * $discount->discount_percent / 100);
                $discountLabel = $discount->label . ' (' . $discount->discount_percent . '%)';
            }
        }

        if (!empty($validated['kode_referal'])) {
            $refResult = $this->referralService->validateCode($validated['kode_referal']);
            if (isset($refResult['valid']) && $refResult['valid']) {
                $potonganReferal = $refResult['discount_amount'] ?? 0;
                $spnReferralCodeId = $refResult['referral_code_id'] ?? null;
            }
        }

        $totalBayar = max(0, $hargaDasar - $potonganDiskon - $potonganReferal);

        $sessionData = [
            'paket' => $package->slug,
            'spn_pricing_package_id' => $package->id,
            'spn_discount_id' => $selectedDiscountId,
            'discount_label' => $discountLabel,
            'spn_referral_code_id' => $spnReferralCodeId,
            'metode_bayar' => $validated['metode_bayar'],
            'info_dari' => $validated['info_dari'],
            'harga_dasar' => $hargaDasar,
            'potongan_diskon' => $potonganDiskon,
            'potongan_referal' => $potonganReferal,
            'total_bayar' => $totalBayar,
            // Display helpers for step 5 review
            '_paket_name' => $package->name,
            '_discount_label' => $discountLabel,
            '_referral_code' => $validated['kode_referal'] ?? null,
        ];

        $request->session()->put('spn_step4', $sessionData);

        return redirect()->route('spn.daftar.step5');
    }

    public function step5(Request $request)
    {
        $reviewData = array_merge(
            $request->session()->get('spn_step1', []),
            $request->session()->get('spn_step2', []),
            $request->session()->get('spn_step3', []),
            $request->session()->get('spn_step4', [])
        );

        if (empty($reviewData)) {
            return redirect()->route('spn.daftar.step1');
        }

        return view('spn.daftar.langkah-5', compact('reviewData'));
    }

    public function storeStep5(Request $request)
    {
        $request->validate([
            'setuju' => 'accepted',
            'bukti_bayar' => 'required|file|mimes:jpg,jpeg,png,webp,pdf|max:5120',
        ]);

        $step1 = $request->session()->get('spn_step1');
        $step2 = $request->session()->get('spn_step2');
        $step3 = $request->session()->get('spn_step3');
        $step4 = $request->session()->get('spn_step4');

        if (empty($step1) || empty($step2) || empty($step3) || empty($step4)) {
            return redirect()->route('spn.daftar.step1')->with('error', 'Sesi pendaftaran Anda telah berakhir. Silakan isi kembali formulir pendaftaran.');
        }

        $data = array_merge($step1, $step2, $step3, $step4);
        
        // Remove temp display-only keys and non-DB keys
        unset($data['_paket_name'], $data['_discount_label'], $data['_referral_code'], $data['usia'], $data['kode_referal']);

        $batch = $this->getActiveBatch();
        if (!$batch) {
            return back()->with('error', 'Batch pendaftaran tidak ditemukan atau belum aktif.');
        }

        $data['activity_batch_id'] = $batch->id;
        $data['setuju'] = true;

        try {
            $registration = $this->registrationService->createRegistration($data, $request->file('bukti_bayar'));

            // Clear session data
            $request->session()->forget(['spn_step1', 'spn_step2', 'spn_step3', 'spn_step4']);

            return redirect()->route('spn.daftar.step6', ['code' => $registration->registration_code]);
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Gagal memproses pendaftaran SPN Langkah 5: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return back()->withInput()->with('error', 'Terjadi kendala saat memproses pendaftaran: ' . $e->getMessage() . '. Silakan coba beberapa saat lagi atau hubungi admin.');
        }
    }

    public function step6($code)
    {
        $registration = SpnRegistration::where('registration_code', $code)->firstOrFail();
        return view('spn.daftar.langkah-6', compact('registration'));
    }
}
