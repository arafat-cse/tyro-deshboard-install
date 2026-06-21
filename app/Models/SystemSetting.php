<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    protected $fillable = [
        'site_name',
        'site_name_highlight',
        'brand_mark',
        'tagline',
        'default_meta_title',
        'default_meta_description',
        'header_cta_text',
        'header_cta_url',
        'show_header_search',
        'show_header_cta',
        'show_login_link',
        'newsletter_title',
        'newsletter_subtitle',
        'newsletter_placeholder',
        'newsletter_button_text',
        'show_newsletter',
        'footer_description',
        'footer_quote_text',
        'footer_quote_author',
        'contact_email',
        'contact_phone',
        'contact_address',
        'youtube_url',
        'facebook_url',
        'instagram_url',
        'x_url',
        'linkedin_url',
        'is_site_live',
        'maintenance_message',
    ];

    protected function casts(): array
    {
        return [
            'show_header_search' => 'boolean',
            'show_header_cta' => 'boolean',
            'show_login_link' => 'boolean',
            'show_newsletter' => 'boolean',
            'is_site_live' => 'boolean',
        ];
    }

    public static function current(): self
    {
        return self::firstOrCreate([], self::defaults());
    }

    /**
     * @return array<string, mixed>
     */
    public static function defaults(): array
    {
        return [
            'default_meta_description' => 'A knowledge hub for understanding psychology, behavior, and life systems to help you think clearly and live intentionally.',
            'footer_description' => 'A knowledge hub for understanding psychology, behavior, and life systems to help you think clearly and live intentionally.',
        ];
    }
}
