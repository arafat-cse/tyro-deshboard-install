<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class LibraryItem extends Model
{
    protected $fillable = [
        'type',
        'title',
        'description',
        'primary_topic',
        'secondary_topic',
        'format',
        'difficulty',
        'published_on',
        'meta_label',
        'duration_seconds',
        'duration_minutes',
        'thumbnail_image_path',
        'video_path',
        'thumbnail_class',
        'label_class',
        'content_url',
        'sort_order',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'published_on' => 'date',
            'duration_seconds' => 'integer',
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

    public function getDisplayDateAttribute(): string
    {
        return $this->published_on instanceof Carbon
            ? $this->published_on->format('M j, Y')
            : '';
    }

    public function getSmartThumbnailClassAttribute(): string
    {
        if ($this->thumbnail_image_url) {
            return 'uploaded-thumb';
        }

        return match ($this->type) {
            'ARTICLE' => match ($this->primary_topic) {
                'Philosophy' => 'philosophy-thumb',
                'Self Awareness' => 'case-thumb',
                default => 'case-thumb',
            },
            'RESOURCE' => match ($this->primary_topic) {
                'Framework' => 'diagram-thumb',
                default => 'desk-thumb',
            },
            default => match ($this->primary_topic) {
                'Mindset' => 'mindset-thumb',
                default => $this->sort_order <= 10 ? 'creator-thumb' : 'hero-thumb',
            },
        };
    }

    public function getSmartLabelClassAttribute(): string
    {
        return match ($this->type) {
            'ARTICLE' => 'article-label',
            'RESOURCE' => 'resource-label',
            default => '',
        };
    }

    public function getThumbnailImageUrlAttribute(): ?string
    {
        if ($this->thumbnail_image_path) {
            return Storage::disk('public')->url($this->thumbnail_image_path);
        }

        return $this->youtube_thumbnail_url;
    }

    public function getVideoUrlAttribute(): ?string
    {
        return $this->video_path
            ? Storage::disk('public')->url($this->video_path)
            : null;
    }

    public function getYoutubeEmbedUrlAttribute(): ?string
    {
        $videoId = $this->youtube_video_id;

        return $videoId ? "https://www.youtube.com/embed/{$videoId}" : null;
    }

    public function getYoutubeThumbnailUrlAttribute(): ?string
    {
        $videoId = $this->youtube_video_id;

        return $videoId ? "https://img.youtube.com/vi/{$videoId}/hqdefault.jpg" : null;
    }

    public function getYoutubeVideoIdAttribute(): ?string
    {
        if (! $this->content_url) {
            return null;
        }

        $parts = parse_url($this->content_url);
        $host = strtolower($parts['host'] ?? '');
        $host = preg_replace('/^(www\.|m\.)/', '', $host);
        $path = trim($parts['path'] ?? '', '/');

        if ($host === 'youtu.be') {
            return $this->normalizeYoutubeVideoId(strtok($path, '/'));
        }

        if (! in_array($host, ['youtube.com', 'youtube-nocookie.com'], true)) {
            return null;
        }

        if ($path === 'watch') {
            parse_str($parts['query'] ?? '', $query);

            return $this->normalizeYoutubeVideoId($query['v'] ?? null);
        }

        $segments = explode('/', $path);

        if (in_array($segments[0] ?? '', ['embed', 'shorts', 'live'], true)) {
            return $this->normalizeYoutubeVideoId($segments[1] ?? null);
        }

        return null;
    }

    public function getDurationLabelAttribute(): string
    {
        if ($this->duration_seconds <= 0) {
            return '';
        }

        $minutes = intdiv($this->duration_seconds, 60);
        $seconds = $this->duration_seconds % 60;

        return sprintf('%d:%02d', $minutes, $seconds);
    }

    public function getDurationMinutesAttribute(): int
    {
        return (int) ceil($this->duration_seconds / 60);
    }

    public function setDurationMinutesAttribute(mixed $value): void
    {
        $this->attributes['duration_seconds'] = max(0, (int) $value) * 60;
    }

    private function normalizeYoutubeVideoId(mixed $value): ?string
    {
        if (! is_string($value) || $value === '') {
            return null;
        }

        return preg_match('/^[A-Za-z0-9_-]{11}$/', $value) === 1 ? $value : null;
    }
}
