<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaarufProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taaruf_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->boolean('is_active')->default(false);
            $table->string('gender');
            $table->string('full_name');
            $table->string('nickname');
            $table->string('birth_place_date');
            $table->string('current_residence');
            $table->string('last_education');
            $table->string('occupation');
            $table->integer('marriage_target_year')->nullable();
            $table->string('personality')->nullable();
            $table->text('expectation')->nullable();
            $table->text('ideal_partner_criteria')->nullable();
            $table->string('photo_url')->nullable();
            $table->string('instagram')->nullable();
            $table->string('informed_consent_url')->nullable();
            $table->boolean('is_in_taaruf_process')->default(false);
            $table->boolean('is_smoker')->default(false);
            $table->boolean('is_polygamy_intended')->default(false);
            $table->boolean('has_debt')->default(false);
            $table->boolean('has_dependents')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taaruf_profiles');
    }
}
