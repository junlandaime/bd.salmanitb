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
        Schema::create('spn_referral_codes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activity_batch_id')->constrained()->cascadeOnDelete();
            $table->string('code')->unique();
            $table->string('owner_name');
            $table->decimal('discount_amount', 12, 2)->default(25000);
            $table->integer('max_usage')->nullable();
            $table->integer('used_count')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spn_referral_codes');
    }
};
