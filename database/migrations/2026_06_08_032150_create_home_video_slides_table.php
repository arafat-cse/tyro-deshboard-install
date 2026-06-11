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
        Schema::create('home_video_slides', function (Blueprint $table) {
            $table->id();
            $table->string('badge')->default('Latest Video');
            $table->string('title');
            $table->string('highlight')->nullable();
            $table->text('description')->nullable();
            $table->string('duration')->nullable();
            $table->string('poster_path')->nullable();
            $table->string('video_path')->nullable();
            $table->string('video_url')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_video_slides');
    }
};
