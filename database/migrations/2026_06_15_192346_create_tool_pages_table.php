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
        Schema::create('tool_pages', function (Blueprint $table) {
            $table->id();
            $table->string('eyebrow')->default('Tools & Resources');
            $table->string('title_line_one')->default('Practical tools.');
            $table->string('title_line_two')->default('Real transformation.');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tool_pages');
    }
};
