<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatchMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        'activity_batch_id',
        'title',
        'description',
        'slide_url',
        'notes_url',
        'video_url',
        'order',
    ];

    public function activityBatch()
    {
        return $this->belongsTo(ActivityBatch::class);
    }
}
