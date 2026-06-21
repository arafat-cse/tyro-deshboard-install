<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AboutMissionItem extends Model
{
    protected $fillable = [
        'about_page_id',
        'icon_text',
        'title',
        'description',
        'is_gold',
        'sort_order',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'is_gold' => 'boolean',
            'sort_order' => 'integer',
            'is_published' => 'boolean',
        ];
    }

    public function page(): BelongsTo
    {
        return $this->belongsTo(AboutPage::class, 'about_page_id');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true)->orderBy('sort_order');
    }
}
