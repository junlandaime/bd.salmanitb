<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('taaruf_profiles', function (Blueprint $table) {
            // Asal Daerah (Detail)
            $table->string('origin_province')->nullable()->after('birth_place_date');
            $table->string('origin_city')->nullable()->after('origin_province');
            $table->string('origin_district')->nullable()->after('origin_city');
            $table->string('origin_village')->nullable()->after('origin_district');

            // Domisili (Detail)
            $table->string('residence_province')->nullable()->after('current_residence');
            $table->string('residence_city')->nullable()->after('residence_province');
            $table->string('residence_district')->nullable()->after('residence_city');
            $table->string('residence_village')->nullable()->after('residence_district');
        });
    }

    public function down()
    {
        Schema::table('taaruf_profiles', function (Blueprint $table) {
            $table->dropColumn([
                'origin_province',
                'origin_city',
                'origin_district',
                'origin_village',
                'residence_province',
                'residence_city',
                'residence_district',
                'residence_village'
            ]);
        });
    }
};
