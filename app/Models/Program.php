<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Program extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'overview',
        'featured_image',
        'status',
    ];

    public function topics()
    {
        return $this->hasMany(ProgramTopic::class);
    }

    public function schedules()
    {
        return $this->hasMany(ProgramSchedule::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
