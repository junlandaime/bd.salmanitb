<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('activity_batches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activity_id')->constrained()->onDelete('cascade');
            $table->string('nama_batch');
            $table->integer('batch_ke');
            $table->integer('kuota');
            $table->decimal('harga', 12, 2);
            $table->string('featured_image')->nullable();
            $table->date('tanggal_mulai_pendaftaran');
            $table->date('tanggal_selesai_pendaftaran');
            $table->date('tanggal_mulai_kegiatan');
            $table->date('tanggal_selesai_kegiatan');
            $table->enum('status', ['aktif', 'nonaktif', 'selesai'])->default('aktif');
            $table->string('external_link')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('activity_batches');
    }
};
