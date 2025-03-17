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
        Schema::create('landing_pages', function (Blueprint $table) {

            $table->id();
            $table->string('hero_title');
            $table->text('hero_subtitle')->nullable();
            $table->string('hero_image')->nullable();

            $table->string('about_title');
            $table->text('about_content');

            $table->string('mission_title');
            $table->text('mission_content');

            $table->string('vision_title');
            $table->text('vision_content');

            $table->string('stats1')->nullable();
            $table->string('stats2')->nullable();
            $table->string('stats3')->nullable();
            $table->string('stats4')->nullable();
            $table->integer('stats_1')->default(0);
            $table->integer('stats_2')->default(0);
            $table->integer('stats_3')->default(0);
            $table->integer('stats_4')->default(0);

            $table->text('contact_address')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_whatsapp')->nullable();

            $table->string('social_facebook')->nullable();
            $table->string('social_twitter')->nullable();
            $table->string('social_instagram')->nullable();
            $table->string('social_linkedin')->nullable();
            $table->string('social_youtube')->nullable();

            $table->text('footer_description');

            $table->string('meta_title');
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('landing_pages');
    }
};
