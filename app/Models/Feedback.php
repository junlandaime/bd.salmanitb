<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Feedback extends Model
{
    use SoftDeletes;

    protected $table = 'feedbacks';

    protected $fillable = [
        'user_id',
        'category',
        'subject',
        'message',
        'status',
        'closed_by',
        'closed_at',
    ];

    protected $casts = [
        'closed_at' => 'datetime',
    ];

    // ─── Category Labels ────────────────────────────────────────

    public const CATEGORIES = [
        'saran'      => 'Saran',
        'keluhan'    => 'Keluhan',
        'pertanyaan' => 'Pertanyaan',
        'bug'        => 'Laporan Bug',
        'lainnya'    => 'Lainnya',
    ];

    public function getCategoryLabelAttribute(): string
    {
        return self::CATEGORIES[$this->category] ?? ucfirst($this->category);
    }

    // ─── Status Helpers ─────────────────────────────────────────

    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'open'     => 'bg-yellow-100 text-yellow-800 border-yellow-200',
            'answered' => 'bg-emerald-100 text-emerald-800 border-emerald-200',
            'closed'   => 'bg-gray-100 text-gray-600 border-gray-200',
            default    => 'bg-gray-100 text-gray-600 border-gray-200',
        };
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'open'     => 'Menunggu Jawaban',
            'answered' => 'Dijawab',
            'closed'   => 'Ditutup',
            default    => ucfirst($this->status),
        };
    }

    public function isOpen(): bool
    {
        return $this->status !== 'closed';
    }

    // ─── Relationships ──────────────────────────────────────────

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function closedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'closed_by');
    }

    public function replies(): HasMany
    {
        return $this->hasMany(FeedbackReply::class)->orderBy('created_at', 'asc');
    }

    // ─── Scopes ─────────────────────────────────────────────────

    public function scopeOpen($query)
    {
        return $query->where('status', 'open');
    }

    public function scopeAnswered($query)
    {
        return $query->where('status', 'answered');
    }

    public function scopeClosed($query)
    {
        return $query->where('status', 'closed');
    }

    public function scopeByUser($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }
}
