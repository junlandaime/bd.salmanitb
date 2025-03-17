<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_id',
        'title',
        'day',
        'start_time',
        'end_time',
        'type', // regular, special
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}
