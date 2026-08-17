<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Support\Carbon;

class SpnRegistration extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'user_id',
        'activity_batch_id',
        'registration_code',
        'restu',
        'gambaran_awal',
        'alasan',
        'harapan',
        'nama_lengkap',
        'nama_gelar',
        'nama_panggilan',
        'jenis_kelamin',
        'email',
        'whatsapp',
        'instagram',
        'tanggal_lahir',
        'asal_daerah',
        'domisili',
        'status_pernikahan',
        'pendidikan',
        'status_diri',
        'pekerjaan',
        'jabatan',
        'instansi',
        'lokasi_kerja',
        'universitas',
        'jurusan',
        'angkatan',
        'paket',
        'spn_pricing_package_id',
        'spn_discount_id',
        'spn_referral_code_id',
        'metode_bayar',
        'info_dari',
        'harga_dasar',
        'potongan_diskon',
        'discount_label',
        'potongan_referal',
        'total_bayar',
        'setuju',
        'status',
        'pending_changes',
        'catatan_admin',
        'verified_by',
        'verified_at',
    ];

    protected $casts = [
        'pending_changes' => 'array',
        'tanggal_lahir' => 'date',
        'harga_dasar' => 'decimal:2',
        'potongan_diskon' => 'decimal:2',
        'potongan_referal' => 'decimal:2',
        'total_bayar' => 'decimal:2',
        'setuju' => 'boolean',
        'verified_at' => 'datetime',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('bukti_bayar')->singleFile();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function activityBatch(): BelongsTo
    {
        return $this->belongsTo(ActivityBatch::class);
    }

    public function pricingPackage(): BelongsTo
    {
        return $this->belongsTo(SpnPricingPackage::class, 'spn_pricing_package_id');
    }

    public function discount(): BelongsTo
    {
        return $this->belongsTo(SpnDiscount::class, 'spn_discount_id');
    }

    public function referralCode(): BelongsTo
    {
        return $this->belongsTo(SpnReferralCode::class, 'spn_referral_code_id');
    }

    public function verifiedByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function getUsiaAttribute(): int
    {
        return $this->tanggal_lahir ? Carbon::parse($this->tanggal_lahir)->age : 0;
    }

    public function getDiscountPercentageAttribute(): int
    {
        if ($this->harga_dasar > 0 && $this->potongan_diskon > 0) {
            return (int) round(($this->potongan_diskon / $this->harga_dasar) * 100);
        }
        return 0;
    }

    public function getDiscountCategoryLabelAttribute(): string
    {
        if (!empty($this->discount_label)) {
            return $this->discount_label;
        }

        if ($this->discount) {
            return $this->discount->label;
        }

        // 1. Cari label resmi berdasarkan persentase diskon batch yang tersimpan
        if ($this->discount_percentage > 0) {
            $discount = SpnDiscount::where('activity_batch_id', $this->activity_batch_id)
                ->where('discount_percent', $this->discount_percentage)
                ->first();

            if ($discount) {
                return $discount->label;
            }
        }

        // 2. Cari berdasarkan relasi status diri
        $discount = SpnDiscount::where('activity_batch_id', $this->activity_batch_id)
            ->where('applies_to_status_diri', $this->status_diri)
            ->first();

        if ($discount) {
            return $discount->label;
        }

        return match ($this->status_diri) {
            'mahasiswa' => 'Mahasiswa ITB',
            'alumni_itb' => 'Alumni ITB',
            'dosen' => 'Karyawan / Dosen ITB',
            'staff_salman' => 'Staff Salman',
            'alumni_ssc' => 'Alumni SSC / LMD / SPECTRA',
            'umum' => 'Peserta Umum',
            default => ucwords(str_replace('_', ' ', $this->status_diri ?? 'Umum')),
        };
    }

    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'terverifikasi' => 'bg-green-100 text-green-800',
            'ditolak' => 'bg-red-100 text-red-800',
            default => 'bg-yellow-100 text-yellow-800',
        };
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeVerified($query)
    {
        return $query->where('status', 'terverifikasi');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'ditolak');
    }

    public function scopeForBatch($query, $batchId)
    {
        return $query->where('activity_batch_id', $batchId);
    }
}
