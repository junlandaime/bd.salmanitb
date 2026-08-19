<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaarufQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'asked_by_user_id',
        'question',
        'answer',
        'is_answered',
        'is_anonymous',
        'is_public',
        'answered_at',
    ];

    protected $casts = [
        'is_answered' => 'boolean',
        'is_anonymous' => 'boolean',
        'is_public' => 'boolean',
        'answered_at' => 'datetime',
    ];

    public function getAnsweredAtAttribute($value)
    {
        if ($value) {
            return \Carbon\Carbon::parse($value);
        }
        return $this->is_answered ? $this->updated_at : null;
    }

    /**
     * Get the taaruf profile that owns the question.
     */
    public function profile()
    {
        return $this->belongsTo(TaarufProfile::class, 'profile_id');
    }

    /**
     * Get the user who asked the question.
     */
    public function askedBy()
    {
        return $this->belongsTo(User::class, 'asked_by_user_id');
    }
}
