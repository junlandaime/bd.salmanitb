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
        Schema::table('taaruf_profiles', function (Blueprint $table) {
            $table->string('education_level')->nullable()->after('last_education'); // SD, SMP, SMA, SMK, D3, D4, S1, S2, S3
            $table->string('university')->nullable()->after('education_level'); // Nama kampus dari API atau "Lainnya"
            $table->string('custom_university')->nullable()->after('university'); // Nama kampus manual jika pilih "Lainnya"
            $table->string('major')->nullable()->after('custom_university'); // Jurusan/Program Studi
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('taaruf_profiles', function (Blueprint $table) {
            $table->dropColumn([
                'education_level',
                'university',
                'custom_university',
                'major',
            ]);
        });
    }
};
