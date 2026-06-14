<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogPost extends Model
{
    protected $fillable = [
        'blog_category_id',
        'category',
        'title',
        'slug',
        'excerpt',
        'content',
        'published_on',
        'read_minutes',
        'thumbnail_image_path',
        'thumbnail_style',
        'is_featured',
        'is_popular',
        'sort_order',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'published_on' => 'date',
            'read_minutes' => 'integer',
            'is_featured' => 'boolean',
            'is_popular' => 'boolean',
            'sort_order' => 'integer',
            'is_published' => 'boolean',
        ];
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true)
            ->orderBy('sort_order')
            ->latest('published_on')
            ->latest();
    }

    protected static function booted(): void
    {
        static::saving(function (BlogPost $post): void {
            if (! $post->slug) {
                $post->slug = Str::slug($post->title);
            }

            if (! $post->category && $post->blogCategory) {
                $post->category = $post->blogCategory->name;
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function blogCategory(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class);
    }

    public function getCategoryNameAttribute(): string
    {
        return $this->blogCategory?->name ?: $this->category;
    }

    public function getDisplayDateAttribute(): string
    {
        return $this->published_on instanceof Carbon
            ? $this->published_on->format('M j, Y')
            : '';
    }

    public function getThumbnailUrlAttribute(): ?string
    {
        return $this->thumbnail_image_path
            ? Storage::disk('public')->url($this->thumbnail_image_path)
            : null;
    }

    public function getSmartThumbnailStyleAttribute(): string
    {
        if ($this->thumbnail_url) {
            return 'uploaded-img';
        }

        if ($this->thumbnail_style) {
            return $this->thumbnail_style;
        }

        return match ($this->category_name) {
            'Cognitive Biases' => 'bias-img',
            'Mindset' => 'mindset-img',
            'Human Behavior' => 'human-img',
            'Productivity' => 'desk-img',
            'Philosophy' => 'philosophy-img',
            'Case Studies' => 'case-img',
            default => '',
        };
    }
}
