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
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->string('category')->index();
            $table->string('title');
            $table->text('excerpt');
            $table->longText('content')->nullable();
            $table->date('published_on')->nullable()->index();
            $table->unsignedInteger('read_minutes')->default(1);
            $table->string('thumbnail_image_path')->nullable();
            $table->string('thumbnail_style', 40)->nullable();
            $table->boolean('is_featured')->default(false)->index();
            $table->boolean('is_popular')->default(false)->index();
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
        Schema::dropIfExists('blog_posts');
    }
};
