<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Activity extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'program_id',
        'title',
        'slug',
        'description',
        'overview',
        'featured_image',
        'is_featured',
        'status',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function batches()
    {
        return $this->hasMany(ActivityBatch::class, 'activity_id');
    }

    public function getActiveBatch()
    {
        return $this->batches()
            ->where('status', 'aktif')
            ->where('tanggal_mulai_pendaftaran', '<=', Carbon::now())
            ->where('tanggal_selesai_pendaftaran', '>=', Carbon::now())
            ->first();
    }

    public function getUpcomingBatches()
    {
        return $this->batches()
            ->where('status', 'aktif')
            ->where('tanggal_mulai_pendaftaran', '>', Carbon::now())
            ->orderBy('tanggal_mulai_pendaftaran', 'asc')
            ->get();
    }

    public function learningPath()
    {
        return $this->hasMany(ActivityLearningPath::class);
    }

    public function highlights()
    {
        return $this->hasMany(ActivityHighlight::class);
    }

    public function testimonials()
    {
        return $this->hasMany(ActivityTestimonial::class);
    }

    public function gallery()
    {
        return $this->hasMany(ActivityGallery::class);
    }

    public function faqs()
    {
        return $this->hasMany(ActivityFaq::class);
    }
}
