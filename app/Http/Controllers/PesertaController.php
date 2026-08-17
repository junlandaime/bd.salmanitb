<?php

namespace App\Http\Controllers;

use App\Models\SpnRegistration;
use App\Models\SpnPricingPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesertaController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        
        // Load SPN registrations (currently the only program, but generic structure)
        $registrations = SpnRegistration::with(['activityBatch.activity', 'pricingPackage', 'referralCode'])
            ->where('user_id', $user->id)
            ->latest()
            ->get();
            
        return view('peserta.dashboard', compact('registrations'));
    }

    public function show($id)
    {
        $user = Auth::user();
        
        $registration = SpnRegistration::with(['activityBatch.activity', 'pricingPackage', 'referralCode'])
            ->where('id', $id)
            ->where('user_id', $user->id)
            ->firstOrFail();
            
        return view('peserta.show', compact('registration'));
    }

    public function edit($id)
    {
        $user = Auth::user();
        
        $registration = SpnRegistration::with(['pricingPackage'])
            ->where('id', $id)
            ->where('user_id', $user->id)
            ->firstOrFail();
            
        $packages = SpnPricingPackage::where('is_active', true)->get();
            
        return view('peserta.edit', compact('registration', 'packages'));
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        
        $registration = SpnRegistration::where('id', $id)
            ->where('user_id', $user->id)
            ->firstOrFail();

        $freeFields = [
            'nama_lengkap', 'nama_gelar', 'nama_panggilan', 'jenis_kelamin', 'email', 'whatsapp', 'instagram',
            'tanggal_lahir', 'asal_daerah', 'domisili', 'status_pernikahan',
            'pendidikan', 'status_diri', 'pekerjaan', 'jabatan', 'instansi', 'lokasi_kerja', 'universitas', 'jurusan', 'angkatan',
            'restu', 'gambaran_awal', 'alasan', 'harapan', 'info_dari'
        ];

        $protectedFields = [
            'paket', 'spn_pricing_package_id', 'metode_bayar', 'spn_referral_code_id'
        ];

        // Update free fields
        foreach ($freeFields as $field) {
            if ($request->has($field)) {
                $registration->$field = $request->input($field);
            }
        }

        // Check protected fields for changes
        $pendingChanges = $registration->pending_changes ?? [];
        $hasProtectedChanges = false;

        foreach ($protectedFields as $field) {
            if ($request->has($field) && $request->input($field) != $registration->$field) {
                $pendingChanges[$field] = $request->input($field);
                $hasProtectedChanges = true;
            }
        }

        // If registration was previously rejected, reset status to pending so admin can re-review
        $wasRejected = ($registration->status === 'ditolak');
        if ($wasRejected) {
            $registration->status = 'pending';
        }

        if ($hasProtectedChanges) {
            $registration->pending_changes = $pendingChanges;
        }

        $registration->save();

        if ($request->hasFile('bukti_bayar')) {
            $registration->clearMediaCollection('bukti_bayar');
            $registration->addMedia($request->file('bukti_bayar'))->toMediaCollection('bukti_bayar');
        }

        if ($wasRejected) {
            $message = 'Data dan berkas pendaftaran Anda telah berhasil diperbarui dan dikirim kembali untuk diverifikasi oleh admin.';
        } else {
            $message = 'Data berhasil diperbarui.';
        }

        if ($hasProtectedChanges) {
            $message .= ' Beberapa perubahan paket/pembayaran memerlukan persetujuan admin.';
        }

        return redirect()->route('peserta.registration.show', $registration->id)
            ->with('success', $message);
    }
}
