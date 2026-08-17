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

    /**
     * Auto update batches that have passed the registration end date to 'selesai'.
     */
    public static function updateExpiredBatches(): void
    {
        static::where('status', 'aktif')
            ->whereNotNull('tanggal_selesai_pendaftaran')
            ->whereDate('tanggal_selesai_pendaftaran', '<', Carbon::today())
            ->update(['status' => 'selesai']);
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function isRegistrationOpen(): bool
    {
        $today = Carbon::today();
        return $this->status === 'aktif'
            && $this->tanggal_mulai_pendaftaran
            && $this->tanggal_selesai_pendaftaran
            && $today->gte($this->tanggal_mulai_pendaftaran)
            && $today->lte($this->tanggal_selesai_pendaftaran);
    }

    public function getRegistrationStatus(): string
    {
        $today = Carbon::today();

        if ($this->status !== 'aktif') {
            return $this->status; // 'selesai' or 'nonaktif'
        }

        if ($this->tanggal_mulai_pendaftaran && $today->lt($this->tanggal_mulai_pendaftaran)) {
            return 'belum_dibuka';
        }

        if ($this->tanggal_selesai_pendaftaran && $today->gt($this->tanggal_selesai_pendaftaran)) {
            return 'ditutup';
        }

        return 'dibuka';
    }

    public function getDurationInWeeks(): int
    {
        if (!$this->tanggal_mulai_kegiatan || !$this->tanggal_selesai_kegiatan) {
            return 0;
        }
        return $this->tanggal_mulai_kegiatan->diffInWeeks($this->tanggal_selesai_kegiatan) + 1;
    }

    public function materials()
    {
        return $this->hasMany(BatchMaterial::class, 'activity_batch_id');
    }

    public function alumni()
    {
        return $this->hasMany(BatchAlumni::class, 'activity_batch_id');
    }

    public function isOpenForRegistration(): bool
    {
        return $this->isRegistrationOpen();
    }

    public function getStatusPendaftaranAttribute(): string
    {
        if ($this->status === 'selesai') {
            return 'Selesai';
        }

        if ($this->status !== 'aktif') {
            return 'Tidak Aktif';
        }

        $today = Carbon::today();
        if ($this->tanggal_mulai_pendaftaran && $today->lt($this->tanggal_mulai_pendaftaran)) {
            return 'Akan Dibuka';
        } elseif ($this->tanggal_selesai_pendaftaran && $today->gt($this->tanggal_selesai_pendaftaran)) {
            return 'Sudah Ditutup';
        } else {
            return 'Sedang Dibuka';
        }
    }
}
