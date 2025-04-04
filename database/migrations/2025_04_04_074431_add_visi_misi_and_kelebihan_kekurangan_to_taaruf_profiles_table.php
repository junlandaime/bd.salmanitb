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
            $table->text('visi_misi')->nullable()->after('ideal_partner_criteria');
            $table->text('kelebihan_kekurangan')->nullable()->after('visi_misi');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('taaruf_profiles', function (Blueprint $table) {
            $table->dropColumn(['visi_misi', 'kelebihan_kekurangan']);
        });
    }
};
