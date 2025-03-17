<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityTestimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'activity_id',
        'name',
        'role',
        'content',
        'image',
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}
