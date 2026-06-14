@extends('life-decode.layout')

@section('title', 'Blog - Life Decode')

@section('content')
    @php
        $categoryIcons = [
            'all' => '<path d="M4 6h16M4 12h16M4 18h16" />',
            'Cognitive Biases' => '<path d="M12 3a7 7 0 0 0-7 7c0 5 7 11 7 11s7-6 7-11a7 7 0 0 0-7-7Z" /><path d="M9 10h6M10 13h4" />',
            'Mindset' => '<path d="M9 18h6M10 22h4M8.5 14a6 6 0 1 1 7 0c-.8.5-1.2 1.4-1.3 2.2H9.8c-.1-.8-.5-1.7-1.3-2.2Z" />',
            'Mental Models' => '<path d="M12 3 4 7v10l8 4 8-4V7l-8-4Z" /><path d="M4 7l8 4 8-4M12 11v10" />',
            'Productivity' => '<path d="M12 21a9 9 0 1 0-9-9" /><path d="M12 7v5l3 2" />',
            'Human Behavior' => '<path d="M16 11a4 4 0 1 0-8 0" /><path d="M4 21a8 8 0 0 1 16 0M20 8v4M22 10h-4" />',
            'Philosophy' => '<path d="M12 3c4 3 6 6 6 9a6 6 0 0 1-12 0c0-3 2-6 6-9Z" /><path d="M12 21V9" />',
            'Case Studies' => '<path d="M6 3h12v18H6z" /><path d="M9 7h6M9 11h6M9 15h4" />',
        ];
    @endphp

    <main>
        <section class="page-hero blog-hero">
            <div class="shell blog-hero-inner">
                <p class="eyebrow">Blog / Insights</p>
                <h1>Ideas. Insights. Decode Better.</h1>
                <p class="lead">Deep dives, frameworks, case studies, and practical lessons to help you understand the mind and live better.</p>
                <form class="search-box blog-search-form" data-blog-search>
                    <input type="search" placeholder="Search articles..." aria-label="Search blog articles">
                    <button type="submit" aria-label="Search articles" style="border:0;background:transparent;color:#fff;display:grid;place-items:center;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="m21 21-4.35-4.35M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </button>
                </form>
            </div>
        </section>

        <section class="section blog-index-section">
            <div class="shell">
                <nav class="blog-tabs" aria-label="Blog categories">
                    <a href="#" class="active" data-blog-filter="all">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">{!! $categoryIcons['all'] !!}</svg>
                        All Posts
                    </a>
                    @foreach ($categories as $category)
                        <a href="#" data-blog-filter="{{ $category }}">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">{!! $categoryIcons[$category] ?? $categoryIcons['all'] !!}</svg>
                            {{ $category }}
                        </a>
                    @endforeach
                </nav>

                <div class="blog-layout">
                    <section>
                        <h2 class="section-title">Featured Posts</h2>
                        @if ($featuredPost)
                            <article class="featured-post blog-article" data-category="{{ $featuredPost->category_name }}" data-title="{{ $featuredPost->title }}">
                                <a class="post-image {{ $featuredPost->smart_thumbnail_style }}" href="{{ route('life-decode.blog.show', $featuredPost) }}" aria-label="Read {{ $featuredPost->title }}" @if ($featuredPost->thumbnail_url) style="background-image: linear-gradient(90deg, rgba(6, 17, 31, .12), rgba(6, 17, 31, .45)), url('{{ $featuredPost->thumbnail_url }}');" @endif></a>
                                <div class="featured-copy">
                                    <span class="overline">{{ $featuredPost->category_name }}</span>
                                    <h2><a href="{{ route('life-decode.blog.show', $featuredPost) }}">{{ $featuredPost->title }}</a></h2>
                                    <p class="copy">{{ $featuredPost->excerpt }}</p>
                                    <small class="copy">{{ $featuredPost->display_date }} / {{ $featuredPost->read_minutes }} min read</small>
                                    <a class="link-blue" style="display:inline-flex;margin-top:10px;" href="{{ route('life-decode.blog.show', $featuredPost) }}">Read More -></a>
                                </div>
                            </article>
                        @else
                            <p class="copy">No blog posts are published yet.</p>
                        @endif

                        <div class="blog-section-title-row">
                            <h2 class="section-title">All Posts</h2>
                            <select class="blog-sort-select" data-blog-sort aria-label="Sort blog posts">
                                <option value="latest">Sort by: Latest</option>
                                <option value="oldest">Sort by: Oldest</option>
                                <option value="shortest">Sort by: Shortest</option>
                                <option value="longest">Sort by: Longest</option>
                            </select>
                        </div>

                        <div class="article-listing" data-blog-list>
                            @foreach ($posts as $post)
                                <article class="article-row blog-article" data-category="{{ $post->category_name }}" data-title="{{ $post->title }}" data-index="{{ $loop->index }}" data-minutes="{{ $post->read_minutes }}">
                                    <div class="article-thumb {{ $post->smart_thumbnail_style }}" @if ($post->thumbnail_url) style="background-image: linear-gradient(90deg, rgba(6, 17, 31, .14), rgba(6, 17, 31, .44)), url('{{ $post->thumbnail_url }}');" @endif></div>
                                    <div>
                                        <span class="overline">{{ $post->category_name }}</span>
                                        <h3><a href="{{ route('life-decode.blog.show', $post) }}">{{ $post->title }}</a></h3>
                                        <p>{{ $post->excerpt }}</p>
                                        <small>{{ $post->display_date }} / {{ $post->read_minutes }} min read</small>
                                    </div>
                                    <a class="bookmark-btn" href="{{ route('life-decode.blog.show', $post) }}" aria-label="Read {{ $post->title }}">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                        <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z" />
                                        </svg>
                                    </a>
                                </article>
                            @endforeach
                        </div>

                        <p class="copy blog-empty-state" style="display:none;margin-top:18px;">No articles match your search.</p>

                        <div class="pagination">
                            <span class="page-pill disabled">&lt; Prev</span>
                            <span class="page-pill active">1</span>
                            <span class="page-pill">2</span>
                            <span class="page-pill">3</span>
                            <span class="page-pill disabled">...</span>
                            <span class="page-pill">10</span>
                            <span class="page-pill">Next &gt;</span>
                        </div>
                    </section>

                    <aside class="blog-side">
                        <section class="side-card about-blog-card">
                            <h3>About Life Decode Blog</h3>
                            <p class="copy" style="font-size:13px;margin-top:16px;">Welcome to the official blog of Life Decode. Here we break down complex ideas into simple insights you can apply in real life.</p>
                            <p class="copy" style="font-size:13px;margin-top:14px;">New articles every week.</p>
                            <a class="btn btn-dark" style="width:100%;margin-top:18px;background:#06111f;" href="{{ route('life-decode.community') }}">Join the Community -></a>
                        </section>

                        <section class="side-card">
                            <h3>Popular Topics</h3>
                            <div class="topic-list" style="margin-top:16px;">
                                @foreach ($categories as $category)
                                    <a class="topic-line" href="#" data-topic-shortcut="{{ $category }}">
                                        <span>{{ $category }}</span>
                                        <span class="count-pill">{{ $categoryCounts->get($category, 0) }}</span>
                                    </a>
                                @endforeach
                            </div>
                            <a class="link-blue" style="display:inline-flex;margin-top:18px;" href="#">View all topics -></a>
                        </section>

                        <section class="side-card">
                            <h3>Popular Posts</h3>
                            <div style="display:grid;gap:14px;margin-top:16px;">
                                @foreach ($popularPosts as $post)
                                    <a class="mini-post" href="{{ route('life-decode.blog.show', $post) }}">
                                        <div class="mini-thumb {{ $post->smart_thumbnail_style }}" @if ($post->thumbnail_url) style="background-image: linear-gradient(90deg, rgba(6, 17, 31, .14), rgba(6, 17, 31, .44)), url('{{ $post->thumbnail_url }}');" @endif></div>
                                        <div>
                                            <b>{{ $post->title }}</b>
                                            <small class="copy">{{ $post->display_date }}</small>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </section>

                        <section class="side-card">
                            <h3>Newsletter</h3>
                            <p class="copy" style="font-size:13px;margin-top:8px;">Get weekly insights on psychology, mindset, and personal growth.</p>
                            <input style="width:100%;height:44px;margin-top:16px;border:1px solid #dbe4ee;border-radius:7px;padding:0 12px;" type="email" placeholder="Enter your email">
                            <button class="btn btn-primary" style="width:100%;margin-top:12px;" type="button">Subscribe</button>
                            <small class="copy" style="display:block;margin-top:14px;">Join 25,000+ readers</small>
                        </section>
                    </aside>
                </div>
            </div>
        </section>
    </main>

    <script>
        (() => {
            const articles = Array.from(document.querySelectorAll('.blog-article'));
            const list = document.querySelector('[data-blog-list]');
            const listArticles = Array.from(list.querySelectorAll('.article-row'));
            const tabs = Array.from(document.querySelectorAll('[data-blog-filter]'));
            const shortcuts = Array.from(document.querySelectorAll('[data-topic-shortcut]'));
            const searchInput = document.querySelector('[data-blog-search] input');
            const searchForm = document.querySelector('[data-blog-search]');
            const sortSelect = document.querySelector('[data-blog-sort]');
            const emptyState = document.querySelector('.blog-empty-state');
            let activeCategory = 'all';

            const sortPosts = () => {
                const mode = sortSelect.value;
                const sorted = [...listArticles].sort((a, b) => {
                    if (mode === 'oldest') return Number(b.dataset.index) - Number(a.dataset.index);
                    if (mode === 'shortest') return Number(a.dataset.minutes) - Number(b.dataset.minutes);
                    if (mode === 'longest') return Number(b.dataset.minutes) - Number(a.dataset.minutes);

                    return Number(a.dataset.index) - Number(b.dataset.index);
                });

                sorted.forEach(article => list.appendChild(article));
            };

            const filterArticles = () => {
                sortPosts();
                const query = searchInput.value.toLowerCase().trim();
                let visibleCount = 0;

                articles.forEach(article => {
                    const matchesCategory = activeCategory === 'all' || article.dataset.category === activeCategory;
                    const matchesSearch = article.dataset.title.toLowerCase().includes(query) || article.textContent.toLowerCase().includes(query);
                    const shouldShow = matchesCategory && matchesSearch;
                    article.style.display = shouldShow ? '' : 'none';
                    if (shouldShow) visibleCount++;
                });

                emptyState.style.display = visibleCount === 0 ? '' : 'none';
            };

            const setCategory = (category) => {
                activeCategory = category;
                tabs.forEach(tab => tab.classList.toggle('active', tab.dataset.blogFilter === category));
                filterArticles();
            };

            searchForm.addEventListener('submit', event => event.preventDefault());
            searchInput.addEventListener('input', filterArticles);
            sortSelect.addEventListener('change', filterArticles);

            tabs.forEach(tab => {
                tab.addEventListener('click', event => {
                    event.preventDefault();
                    setCategory(tab.dataset.blogFilter);
                });
            });

            shortcuts.forEach(shortcut => {
                shortcut.addEventListener('click', event => {
                    event.preventDefault();
                    setCategory(shortcut.dataset.topicShortcut);
                });
            });
        })();
    </script>
@endsection
