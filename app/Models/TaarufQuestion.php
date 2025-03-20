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
    ];

    protected $casts = [
        'is_answered' => 'boolean',
        'is_anonymous' => 'boolean',
        'is_public' => 'boolean',
    ];

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
    public function askedByUser()
    {
        return $this->belongsTo(User::class, 'asked_by_user_id');
    }
}
