<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatchAlumniTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('batch_alumni', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('activity_batch_id')->constrained()->onDelete('cascade');
            $table->string('instagram_account')->nullable();
            $table->enum('gender', ['Pria', 'Wanita'])->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            
            // Ensure a user can only be in a batch once
            $table->unique(['user_id', 'activity_batch_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batch_alumni');
    }
}
