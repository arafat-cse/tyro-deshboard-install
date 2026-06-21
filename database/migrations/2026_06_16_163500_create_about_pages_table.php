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
        Schema::create('about_pages', function (Blueprint $table) {
            $table->id();
            $table->string('eyebrow')->default('About Life Decode');
            $table->string('title_line_one')->default('Decode life.');
            $table->string('title_line_two')->default('Live amplified.');
            $table->text('hero_description');
            $table->string('hero_image_path')->default('/images/about-creator.png');
            $table->string('mission_title')->default('Our Mission');
            $table->text('mission_description');
            $table->string('creator_title')->default('The Creator');
            $table->text('creator_intro');
            $table->text('creator_body_one');
            $table->text('creator_body_two');
            $table->string('creator_signature')->default('Life Decode');
            $table->string('creator_role')->default('Creator & Educator');
            $table->string('creator_image_path')->default('/images/about-desk.png');
            $table->string('credentials_title')->default('Credentials & Approach');
            $table->text('credentials_description');
            $table->string('social_title')->default('Find Life Decode Everywhere');
            $table->string('journey_title')->default('Our Journey So Far');
            $table->text('journey_description');
            $table->string('journey_button_text')->default('Join the Community');
            $table->string('journey_button_url')->default('/community');
            $table->string('quote_text')->default('The more you understand, the more freedom you gain.');
            $table->string('quote_author')->default('Life Decode');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_pages');
    }
};
