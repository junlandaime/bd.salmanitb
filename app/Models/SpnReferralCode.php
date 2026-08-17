<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SpnReferralCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'activity_batch_id',
        'code',
        'owner_name',
        'discount_amount',
        'max_usage',
        'used_count',
        'is_active',
    ];

    protected $casts = [
        'discount_amount' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function activityBatch(): BelongsTo
    {
        return $this->belongsTo(ActivityBatch::class);
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(SpnRegistration::class);
    }

    public function isValid(): bool
    {
        if (!$this->is_active) {
            return false;
        }

        if (!is_null($this->max_usage) && $this->used_count >= $this->max_usage) {
            return false;
        }

        return true;
    }

    public function incrementUsage(): void
    {
        $this->increment('used_count');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeForBatch($query, $batchId)
    {
        return $query->where('activity_batch_id', $batchId);
    }
}
