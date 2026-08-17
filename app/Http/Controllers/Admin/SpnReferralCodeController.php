<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SpnReferralCode;
use Illuminate\Http\Request;

class SpnReferralCodeController extends Controller
{
    protected function getActiveBatch()
    {
        return \App\Models\ActivityBatch::whereHas('activity', function ($q) {
            $q->whereIn('slug', ['sekolah-pranikah-offline', 'sekolah-pranikah-online', 'spn']);
        })->where('status', 'aktif')->latest()->first();
    }

    protected function getActiveBatchId()
    {
        $batch = $this->getActiveBatch();
        return $batch ? $batch->id : 0;
    }

    public function index()
    {
        $batch = $this->getActiveBatch();
        $referralCodes = SpnReferralCode::where('activity_batch_id', $this->getActiveBatchId())
                                        ->orderBy('created_at', 'desc')
                                        ->get();
        return view('admin.spn.referral.index', compact('referralCodes', 'batch'));
    }

    public function create()
    {
        return view('admin.spn.referral.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:50|unique:spn_referral_codes,code',
            'owner_name' => 'required|string|max:255',
            'discount_amount' => 'required|numeric|min:0',
            'max_usage' => 'nullable|integer|min:1',
            'is_active' => 'nullable|boolean'
        ]);

        $data = $request->all();
        $data['code'] = strtoupper($data['code']);
        $data['activity_batch_id'] = $this->getActiveBatchId();
        $data['is_active'] = $request->has('is_active');
        $data['used_count'] = 0;

        SpnReferralCode::create($data);

        return redirect()->route('admin.spn.referral.index')
            ->with('success', 'Referral code berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $referralCode = SpnReferralCode::findOrFail($id);
        return view('admin.spn.referral.edit', compact('referralCode'));
    }

    public function update(Request $request, $id)
    {
        $referralCode = SpnReferralCode::findOrFail($id);

        $request->validate([
            'code' => 'required|string|max:50|unique:spn_referral_codes,code,' . $referralCode->id,
            'owner_name' => 'required|string|max:255',
            'discount_amount' => 'required|numeric|min:0',
            'max_usage' => 'nullable|integer|min:1',
        ]);

        $data = $request->all();
        $data['code'] = strtoupper($data['code']);
        $data['is_active'] = $request->has('is_active');

        $referralCode->update($data);

        return redirect()->route('admin.spn.referral.index')
            ->with('success', 'Referral code berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $referralCode = SpnReferralCode::findOrFail($id);
        
        if ($referralCode->used_count > 0) {
            // Soft warning, but we'll allow it if desired. 
            // In a strict environment, we might reject deletion.
            $referralCode->delete();
            return redirect()->route('admin.spn.referral.index')
                ->with('success', 'Referral code berhasil dihapus, meskipun sudah pernah digunakan.');
        }

        $referralCode->delete();
        return redirect()->route('admin.spn.referral.index')
            ->with('success', 'Referral code berhasil dihapus.');
    }
}
