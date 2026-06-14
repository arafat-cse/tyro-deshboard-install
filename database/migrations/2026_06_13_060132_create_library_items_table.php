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
        Schema::create('library_items', function (Blueprint $table) {
            $table->id();
            $table->string('type', 40)->default('VIDEO')->index();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('primary_topic')->index();
            $table->string('secondary_topic')->nullable()->index();
            $table->string('format')->nullable()->index();
            $table->string('difficulty', 40)->default('Beginner')->index();
            $table->date('published_on')->nullable()->index();
            $table->string('meta_label')->nullable();
            $table->unsignedInteger('duration_seconds')->default(0);
            $table->string('thumbnail_class')->nullable();
            $table->string('label_class')->nullable();
            $table->string('content_url')->nullable();
            $table->unsignedInteger('sort_order')->default(0)->index();
            $table->boolean('is_published')->default(true)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('library_items');
    }
};
