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
        Schema::create('system_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->default('Life Decode');
            $table->string('site_name_highlight')->default('Decode');
            $table->string('brand_mark')->default('LD');
            $table->string('tagline')->default('Decode life. Live amplified.');
            $table->string('default_meta_title')->default('Life Decode - Decode life. Live amplified.');
            $table->text('default_meta_description');
            $table->string('header_cta_text')->default('The Mental Toolkit');
            $table->string('header_cta_url')->default('/tools');
            $table->boolean('show_header_search')->default(true);
            $table->boolean('show_header_cta')->default(true);
            $table->boolean('show_login_link')->default(false);
            $table->string('newsletter_title')->default('Get weekly insights to decode life');
            $table->string('newsletter_subtitle')->default('and live it with more clarity.');
            $table->string('newsletter_placeholder')->default('Enter your email');
            $table->string('newsletter_button_text')->default('Subscribe');
            $table->boolean('show_newsletter')->default(true);
            $table->text('footer_description');
            $table->string('footer_quote_text')->default('The more you understand, the more freedom you gain.');
            $table->string('footer_quote_author')->default('Life Decode');
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_address')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('x_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->boolean('is_site_live')->default(true);
            $table->string('maintenance_message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_settings');
    }
};
