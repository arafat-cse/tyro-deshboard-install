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
        Schema::create('about_approach_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('about_page_id')->constrained()->cascadeOnDelete();
            $table->string('type')->default('check');
            $table->string('icon_text', 10)->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_published')->default(true);
            $table->timestamps();

            $table->index(['about_page_id', 'type', 'is_published', 'sort_order'], 'about_approach_lookup_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_approach_items');
    }
};
