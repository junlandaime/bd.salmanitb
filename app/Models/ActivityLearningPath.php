<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLearningPath extends Model
{
    use HasFactory;

    protected $fillable = [
        'activity_id',
        'title',
        'description',
        'mentors',
        'order',
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}
