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
        Schema::create('home_pages', function (Blueprint $table) {
            $table->id();
            $table->string('eyebrow')->default('UNDERSTAND THE HIDDEN PATTERNS');
            $table->string('title_line_one')->default('Decode Life.');
            $table->string('title_line_two')->default('Live Amplified.');
            $table->text('description');
            $table->string('primary_button_text')->default('Explore Library');
            $table->string('primary_button_url')->default('/library');
            $table->string('secondary_button_text')->default('Download Free Toolkit');
            $table->string('secondary_button_url')->default('/tools');
            $table->string('community_text')->default('Join 25,000+ learners decoding life together every week.');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_pages');
    }
};
