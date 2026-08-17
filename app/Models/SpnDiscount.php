<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SpnDiscount extends Model
{
    use HasFactory;

    protected $fillable = [
        'activity_batch_id',
        'category',
        'label',
        'applies_to_status_diri',
        'discount_percent',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function activityBatch(): BelongsTo
    {
        return $this->belongsTo(ActivityBatch::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeForStatus($query, $statusDiri)
    {
        return $query->active()->where('applies_to_status_diri', $statusDiri);
    }
}
