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
        Schema::table('spn_registrations', function (Blueprint $table) {
            $table->foreignId('spn_discount_id')->nullable()->after('spn_pricing_package_id')->constrained('spn_discounts')->nullOnDelete();
            $table->string('discount_label')->nullable()->after('potongan_diskon');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('spn_registrations', function (Blueprint $table) {
            $table->dropForeign(['spn_discount_id']);
            $table->dropColumn(['spn_discount_id', 'discount_label']);
        });
    }
};
