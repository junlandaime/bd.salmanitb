<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaarufProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        // Identity
        'user_id',
        'is_active',
        'gender',
        'full_name',
        'nickname',
        'birth_place_date',

        // Location - Origin
        'origin_province',
        'origin_city',
        'origin_district',
        'origin_village',

        // Location - Residence
        'current_residence',
        'residence_province',
        'residence_city',
        'residence_district',
        'residence_village',

        // Education
        'last_education',
        'education_level',
        'university',
        'custom_university',
        'major',

        // Career & Marriage
        'occupation',
        'marriage_target_year',

        // Personality & Preferences
        'personality',
        'expectation',
        'ideal_partner_criteria',
        'visi_misi',
        'kelebihan_kekurangan',

        // Media & Documents
        'photo_url',
        'instagram',
        'informed_consent_url',

        // Screening Questions
        'is_in_taaruf_process',
        'is_smoker',
        'is_polygamy_intended',
        'has_debt',
        'has_dependents',
    ];

    protected $casts = [
        'is_active'            => 'boolean',
        'is_in_taaruf_process' => 'boolean',
        'is_smoker'            => 'boolean',
        'is_polygamy_intended' => 'boolean',
        'has_debt'             => 'boolean',
        'has_dependents'       => 'boolean',
    ];

    /**
     * Get the user that owns the taaruf profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the questions received on this profile.
     */
    public function questions()
    {
        return $this->hasMany(TaarufQuestion::class, 'profile_id');
    }

    /**
     * Get the latest SPN batch name for this profile.
     */
    public function getLatestSpnBatchAttribute(): ?string
    {
        if (!$this->user) {
            return null;
        }

        // 1. Check official batch alumni records
        $latestAlumni = $this->user->batchAlumni()
            ->with('activityBatch')
            ->get()
            ->sortByDesc(fn($ba) => $ba->activityBatch?->batch_ke ?? 0)
            ->first();

        if ($latestAlumni && $latestAlumni->activityBatch) {
            return $latestAlumni->activityBatch->nama_batch;
        }

        // 2. Check verified SPN registrations
        $latestReg = \App\Models\SpnRegistration::where('user_id', $this->user_id)
            ->where('status', 'terverifikasi')
            ->with('activityBatch')
            ->latest('id')
            ->first();

        if ($latestReg && $latestReg->activityBatch) {
            return $latestReg->activityBatch->nama_batch;
        }

        return 'Alumni SPN';
    }

    /**
     * Get human-readable last active label.
     */
    public function getLastActiveLabelAttribute(): string
    {
        if ($this->user && $this->user->last_login_at) {
            return 'Aktif ' . $this->user->last_login_at->diffForHumans();
        }

        if ($this->updated_at) {
            return 'Aktif ' . $this->updated_at->diffForHumans();
        }

        return 'Aktif baru-baru ini';
    }
}
