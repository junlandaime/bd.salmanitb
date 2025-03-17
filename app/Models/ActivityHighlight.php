<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityHighlight extends Model
{
    use HasFactory;

    protected $fillable = [
        'activity_id',
        'title',
        'description',
        'icon',
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}
