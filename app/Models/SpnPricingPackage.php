<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class SpnPricingPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'activity_batch_id',
        'name',
        'slug',
        'base_price',
        'available_from',
        'available_until',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'base_price' => 'decimal:2',
        'available_from' => 'date',
        'available_until' => 'date',
        'is_active' => 'boolean',
    ];

    public function activityBatch(): BelongsTo
    {
        return $this->belongsTo(ActivityBatch::class);
    }

    public function isAvailable(): bool
    {
        if (!$this->is_active) {
            return false;
        }

        $now = Carbon::now()->startOfDay();

        if ($this->available_from && $now->lt($this->available_from)) {
            return false;
        }

        if ($this->available_until && $now->gt($this->available_until)) {
            return false;
        }

        return true;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeAvailable($query)
    {
        $now = Carbon::now()->startOfDay();
        return $query->active()
            ->where(function ($q) use ($now) {
                $q->whereNull('available_from')->orWhere('available_from', '<=', $now);
            })
            ->where(function ($q) use ($now) {
                $q->whereNull('available_until')->orWhere('available_until', '>=', $now);
            });
    }
}
