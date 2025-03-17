<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('program_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('day');
            $table->time('start_time');
            $table->time('end_time');
            $table->enum('type', ['regular', 'special'])->default('regular');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('program_schedules');
    }
};
