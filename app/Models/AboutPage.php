<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AboutPage extends Model
{
    protected $fillable = [
        'eyebrow',
        'title_line_one',
        'title_line_two',
        'hero_description',
        'hero_image_path',
        'mission_title',
        'mission_description',
        'creator_title',
        'creator_intro',
        'creator_body_one',
        'creator_body_two',
        'creator_signature',
        'creator_role',
        'creator_image_path',
        'credentials_title',
        'credentials_description',
        'social_title',
        'journey_title',
        'journey_description',
        'journey_button_text',
        'journey_button_url',
        'quote_text',
        'quote_author',
    ];

    public function metrics(): HasMany
    {
        return $this->hasMany(AboutMetric::class)->orderBy('sort_order');
    }

    public function missionItems(): HasMany
    {
        return $this->hasMany(AboutMissionItem::class)->orderBy('sort_order');
    }

    public function approachItems(): HasMany
    {
        return $this->hasMany(AboutApproachItem::class)->orderBy('sort_order');
    }

    public function socialLinks(): HasMany
    {
        return $this->hasMany(AboutSocialLink::class)->orderBy('sort_order');
    }

    public function journeyItems(): HasMany
    {
        return $this->hasMany(AboutJourneyItem::class)->orderBy('sort_order');
    }

    public function heroImageUrl(): string
    {
        return $this->imageUrl($this->hero_image_path);
    }

    public function creatorImageUrl(): string
    {
        return $this->imageUrl($this->creator_image_path);
    }

    private function imageUrl(?string $path): string
    {
        if (! $path) {
            return '';
        }

        if (Str::startsWith($path, ['http://', 'https://', '/'])) {
            return $path;
        }

        return Storage::disk('public')->url($path);
    }
}
