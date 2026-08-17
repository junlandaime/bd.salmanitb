<?php

namespace App\Services;

use App\Models\SpnReferralCode;

class SpnReferralService
{
    public function validate(string $code, int $batchId): ?SpnReferralCode
    {
        $referralCode = SpnReferralCode::forBatch($batchId)
            ->active()
            ->where('code', $code)
            ->first();

        if (!$referralCode || !$referralCode->isValid()) {
            return null;
        }

        return $referralCode;
    }

    /**
     * Validate a referral code for the current active SPN batch.
     * Returns a structured array for JSON/controller usage.
     */
    public function validateCode(string $code): array
    {
        $batch = \App\Models\ActivityBatch::whereHas('activity', function ($q) {
            $q->whereIn('slug', ['sekolah-pranikah-offline', 'sekolah-pranikah-online', 'spn']);
        })->where('status', 'aktif')->latest()->first();

        if (!$batch) {
            return ['valid' => false, 'message' => 'Tidak ada batch aktif.'];
        }

        $referralCode = $this->validate($code, $batch->id);

        if (!$referralCode) {
            return ['valid' => false, 'message' => 'Kode referal tidak valid atau sudah kadaluarsa.'];
        }

        return [
            'valid' => true,
            'discount_amount' => (int) $referralCode->discount_amount,
            'referral_code_id' => $referralCode->id,
            'owner_name' => $referralCode->owner_name,
        ];
    }

    public function apply(SpnReferralCode $code): void
    {
        $code->incrementUsage();
    }
}
