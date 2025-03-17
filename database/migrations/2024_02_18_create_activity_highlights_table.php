<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('activity_highlights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activity_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->longText('icon');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('activity_highlights');
    }
};
