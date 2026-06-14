@extends('life-decode.layout')

@section('title', $post->title . ' - Life Decode Blog')

@section('content')
    <main>
        <section class="library-detail-hero">
            <div class="shell library-detail-top">
                <a class="detail-back-button" href="{{ route('life-decode.blog') }}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M19 12H5m0 0 6-6m-6 6 6 6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Back to Blog
                </a>
                <span class="type-label article-label">{{ $post->category_name }}</span>
            </div>

            <div class="shell library-detail-grid">
                <div class="post-image {{ $post->smart_thumbnail_style }}" @if ($post->thumbnail_url) style="min-height:520px;background-image: linear-gradient(90deg, rgba(6, 17, 31, .16), rgba(6, 17, 31, .48)), url('{{ $post->thumbnail_url }}');" @else style="min-height:520px;" @endif></div>

                <article class="library-detail-copy">
                    <p class="eyebrow">{{ $post->category_name }}</p>
                    <h1>{{ $post->title }}</h1>
                    <p class="lead">{{ $post->excerpt }}</p>

                    <div class="detail-facts">
                        <div>
                            <span>Category</span>
                            <b>{{ $post->category_name }}</b>
                        </div>
                        <div>
                            <span>Read Time</span>
                            <b>{{ $post->read_minutes }} min</b>
                        </div>
                        <div>
                            <span>Published</span>
                            <b>{{ $post->display_date ?: 'Not set' }}</b>
                        </div>
                    </div>
                </article>
            </div>
        </section>

        <section class="section">
            <div class="shell library-detail-body">
                <article class="detail-panel blog-content-panel">
                    <h2>Insight</h2>
                    @if ($post->content)
                        {!! nl2br(e($post->content)) !!}
                    @else
                        <p>{{ $post->excerpt }}</p>
                    @endif
                </article>

                <aside class="detail-panel">
                    <h2>Article Details</h2>
                    <div class="detail-list">
                        <span>Category</span><b>{{ $post->category_name }}</b>
                        <span>Read Time</span><b>{{ $post->read_minutes }} min</b>
                        <span>Published</span><b>{{ $post->display_date ?: 'Not set' }}</b>
                    </div>
                </aside>
            </div>
        </section>

        @if ($relatedPosts->isNotEmpty())
            <section class="section" style="padding-top:0;">
                <div class="shell">
                    <div class="library-main-head">
                        <span>Related Articles</span>
                    </div>
                    <div class="content-grid-library related-grid">
                        @foreach ($relatedPosts as $related)
                            <a href="{{ route('life-decode.blog.show', $related) }}" class="library-card">
                                <div class="library-thumb {{ $related->smart_thumbnail_style }}" @if ($related->thumbnail_url) style="background-image: linear-gradient(90deg, rgba(6, 17, 31, .10), rgba(6, 17, 31, .42)), url('{{ $related->thumbnail_url }}');" @endif></div>
                                <div class="library-card-body">
                                    <span class="type-label article-label">{{ $related->category_name }}</span>
                                    <h3>{{ $related->title }}</h3>
                                    <p class="library-card-desc">{{ $related->excerpt }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    </main>
@endsection
