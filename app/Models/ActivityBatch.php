<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ActivityBatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'activity_id',
        'nama_batch',
        'batch_ke',
        'kuota',
        'harga',
        'featured_image',
        'tanggal_mulai_pendaftaran',
        'tanggal_selesai_pendaftaran',
        'tanggal_mulai_kegiatan',
        'tanggal_selesai_kegiatan',
        'status',
        'external_link',
        'catatan'
    ];

    protected $casts = [
        'tanggal_mulai_pendaftaran' => 'date',
        'tanggal_selesai_pendaftaran' => 'date',
        'tanggal_mulai_kegiatan' => 'date',
        'tanggal_selesai_kegiatan' => 'date',
        'harga' => 'decimal:2'
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function isRegistrationOpen()
    {
        $now = Carbon::now();
        return $this->status === 'aktif'
            && $now->between($this->tanggal_mulai_pendaftaran, $this->tanggal_selesai_pendaftaran);
    }

    public function getRegistrationStatus()
    {
        $now = Carbon::now();

        if ($this->status !== 'aktif') {
            return 'nonaktif';
        }

        if ($now->isBefore($this->tanggal_mulai_pendaftaran)) {
            return 'belum_dibuka';
        }

        if ($now->isAfter($this->tanggal_selesai_pendaftaran)) {
            return 'ditutup';
        }

        return 'dibuka';
    }

    public function getDurationInWeeks()
    {
        return $this->tanggal_mulai_kegiatan->diffInWeeks($this->tanggal_selesai_kegiatan) + 1;
    }

    public function materials()
    {
        return $this->hasMany(BatchMaterial::class, 'activity_batch_id');
    }

    public function isOpenForRegistration(): bool
    {
        $now = now();
        return $this->status === 'aktif' &&
            $now->between($this->tanggal_mulai_pendaftaran, $this->tanggal_selesai_pendaftaran);
    }

    public function getStatusPendaftaranAttribute(): string
    {
        if ($this->status !== 'aktif') {
            return 'Tidak Aktif';
        }

        $now = now();
        if ($now->lt($this->tanggal_mulai_pendaftaran)) {
            return 'Akan Dibuka';
        } elseif ($now->between($this->tanggal_mulai_pendaftaran, $this->tanggal_selesai_pendaftaran)) {
            return 'Sedang Dibuka';
        } else {
            return 'Sudah Ditutup';
        }
    }
}
