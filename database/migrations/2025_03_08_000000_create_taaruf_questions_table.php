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
        Schema::create('taaruf_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->constrained('taaruf_profiles')->onDelete('cascade');
            $table->foreignId('asked_by_user_id')->constrained('users')->onDelete('cascade');
            $table->text('question');
            $table->text('answer')->nullable();
            $table->boolean('is_answered')->default(false);
            $table->boolean('is_anonymous')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taaruf_questions');
    }
};
