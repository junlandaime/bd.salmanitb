<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('spn_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activity_batch_id')->constrained()->cascadeOnDelete();
            $table->string('registration_code')->unique();

            // Step 1: Screening
            $table->enum('restu', ['sudah', 'akan']);
            $table->text('gambaran_awal');
            $table->text('alasan');
            $table->text('harapan');

            // Step 2: Data Diri
            $table->string('nama_lengkap');
            $table->string('nama_gelar')->nullable();
            $table->string('nama_panggilan');
            $table->enum('jenis_kelamin', ['pria', 'wanita']);
            $table->string('email');
            $table->string('whatsapp');
            $table->string('instagram')->nullable();
            $table->date('tanggal_lahir');
            $table->string('asal_daerah');
            $table->text('domisili');
            $table->enum('status_pernikahan', ['belum', 'menikah', 'pernah']);

            // Step 3: Pendidikan & Pekerjaan
            $table->enum('pendidikan', ['sma', 'd3', 's1', 's2', 's3']);
            $table->enum('status_diri', ['mahasiswa', 'karyawan', 'dosen', 'alumni_itb', 'umum']);
            $table->string('pekerjaan')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('instansi')->nullable();
            $table->string('lokasi_kerja')->nullable();
            $table->string('universitas')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('angkatan')->nullable();

            // Step 4: Paket & Pembayaran
            $table->string('paket');
            $table->foreignId('spn_pricing_package_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('spn_referral_code_id')->nullable()->constrained()->nullOnDelete();
            $table->enum('metode_bayar', ['qris', 'transfer']);
            $table->string('info_dari');
            $table->decimal('harga_dasar', 12, 2);
            $table->decimal('potongan_diskon', 12, 2)->default(0);
            $table->decimal('potongan_referal', 12, 2)->default(0);
            $table->decimal('total_bayar', 12, 2);

            // Step 5: Persetujuan
            $table->boolean('setuju')->default(false);

            // Status & Admin
            $table->enum('status', ['pending', 'terverifikasi', 'ditolak'])->default('pending');
            $table->text('catatan_admin')->nullable();
            $table->foreignId('verified_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('verified_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spn_registrations');
    }
};
