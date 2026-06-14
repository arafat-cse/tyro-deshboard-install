@extends('life-decode.layout')

@section('title', $item->title . ' - Life Decode Library')

@section('content')
    <main>
        <section class="library-detail-hero">
            <div class="shell library-detail-top">
                <a class="detail-back-button" href="{{ route('life-decode.library') }}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M19 12H5m0 0 6-6m-6 6 6 6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Back to Library
                </a>
                <span class="type-label {{ $item->smart_label_class }}">{{ $item->type }}</span>
            </div>
            <div class="shell library-detail-grid">
                <div class="library-player">
                    @if ($item->video_url)
                        <video controls preload="metadata" poster="{{ $item->thumbnail_image_url }}" playsinline>
                            <source src="{{ $item->video_url }}">
                            Your browser does not support the video tag.
                        </video>
                    @elseif ($item->youtube_embed_url)
                        <iframe src="{{ $item->youtube_embed_url }}" title="{{ $item->title }}" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    @else
                        <div class="library-detail-thumb {{ $item->smart_thumbnail_class }}" @if ($item->thumbnail_image_url) style="background-image: linear-gradient(90deg, rgba(6, 17, 31, .10), rgba(6, 17, 31, .42)), url('{{ $item->thumbnail_image_url }}');" @endif>
                            @if ($item->type === 'VIDEO')
                                <span class="detail-play-icon">
                                    <svg width="34" height="34" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
                                </span>
                            @endif
                        </div>
                    @endif
                </div>

                <article class="library-detail-copy">
                    <h1>{{ $item->title }}</h1>
                    <p class="lead">{{ $item->description }}</p>

                    <div class="detail-facts">
                        <div>
                            <span>Format</span>
                            <b>{{ $item->format ?: 'Library Item' }}</b>
                        </div>
                        <div>
                            <span>Topic</span>
                            <b>{{ $item->primary_topic }}</b>
                        </div>
                        <div>
                            <span>Level</span>
                            <b>{{ $item->difficulty }}</b>
                        </div>
                        @if ($item->duration_minutes > 0)
                            <div>
                                <span>Duration</span>
                                <b>{{ $item->duration_minutes }} min</b>
                            </div>
                        @endif
                    </div>

                    @if ($item->content_url && ! $item->youtube_embed_url)
                        <a class="btn btn-primary" href="{{ $item->content_url }}" target="_blank" rel="noopener">Open Resource</a>
                    @endif
                </article>
            </div>
        </section>

        <section class="section">
            <div class="shell library-detail-body">
                <article class="detail-panel">
                    <h2>About This {{ Str::title(strtolower($item->type)) }}</h2>
                    <p>{{ $item->description }}</p>
                    <div class="mini-tags">
                        <span>{{ $item->primary_topic }}</span>
                        @if ($item->secondary_topic)
                            <span>{{ $item->secondary_topic }}</span>
                        @endif
                        @if ($item->format)
                            <span>{{ $item->format }}</span>
                        @endif
                    </div>
                </article>

                <aside class="detail-panel">
                    <h2>Details</h2>
                    <div class="detail-list">
                        <span>Published</span><b>{{ $item->display_date ?: 'Not set' }}</b>
                        <span>Difficulty</span><b>{{ $item->difficulty }}</b>
                        <span>Format</span><b>{{ $item->format ?: 'Not set' }}</b>
                        <span>Primary Topic</span><b>{{ $item->primary_topic }}</b>
                        @if ($item->secondary_topic)
                            <span>Secondary Topic</span><b>{{ $item->secondary_topic }}</b>
                        @endif
                    </div>
                </aside>
            </div>
        </section>

        @if ($relatedItems->isNotEmpty())
            <section class="section" style="padding-top:0;">
                <div class="shell">
                    <div class="library-main-head">
                        <span>Related Content</span>
                    </div>
                    <div class="content-grid-library related-grid">
                        @foreach ($relatedItems as $related)
                            <a href="{{ route('life-decode.library.show', $related) }}" class="library-card">
                                <div class="library-thumb {{ $related->smart_thumbnail_class }}" @if ($related->thumbnail_image_url) style="background-image: linear-gradient(90deg, rgba(6, 17, 31, .10), rgba(6, 17, 31, .42)), url('{{ $related->thumbnail_image_url }}');" @endif></div>
                                <div class="library-card-body">
                                    <span class="type-label {{ $related->smart_label_class }}">{{ $related->type }}</span>
                                    <h3>{{ $related->title }}</h3>
                                    <p class="library-card-desc">{{ $related->description }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    </main>
@endsection
