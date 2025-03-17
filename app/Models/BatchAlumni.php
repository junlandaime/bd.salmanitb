<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatchAlumni extends Model
{
    use HasFactory;

    protected $table = 'batch_alumni';

    protected $fillable = [
        'user_id',
        'activity_batch_id',
        'instagram_account',
        'gender',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function activityBatch()
    {
        return $this->belongsTo(ActivityBatch::class);
    }
}
