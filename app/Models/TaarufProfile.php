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
}
