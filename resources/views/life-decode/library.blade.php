@extends('life-decode.layout')

@section('title', 'Library - Life Decode')

@section('content')
    <main>
        <section class="page-hero library-hero">
            <div class="shell library-hero-inner">
                <div>
                    <p class="eyebrow">Library / Episodes</p>
                    <h1>Your Knowledge Library</h1>
                    <p class="lead">Explore all episodes, deep dives, and resources to understand the mind, decode behavior, and upgrade your life.</p>
                </div>

                <div class="library-stats">
                    <div class="library-stat">
                        <div class="library-stat-top">
                            <span class="round-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
                            </span>
                            <div>
                                <b>{{ $typeCounts->get('VIDEO', 0) }}</b>
                                <div class="stat-label">Videos</div>
                            </div>
                        </div>
                        <div class="library-stat-desc">In-depth lessons</div>
                    </div>
                    <div class="library-stat">
                        <div class="library-stat-top">
                            <span class="round-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><line x1="10" y1="9" x2="8" y2="9"/></svg>
                            </span>
                            <div>
                                <b>{{ $typeCounts->get('ARTICLE', 0) }}</b>
                                <div class="stat-label">Articles</div>
                            </div>
                        </div>
                        <div class="library-stat-desc">Deep dive insights</div>
                    </div>
                    <div class="library-stat">
                        <div class="library-stat-top">
                            <span class="round-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                            </span>
                            <div>
                                <b>{{ $typeCounts->get('RESOURCE', 0) }}</b>
                                <div class="stat-label">Resources</div>
                            </div>
                        </div>
                        <div class="library-stat-desc">Worksheets & guides</div>
                    </div>
                    <div class="library-stat">
                        <div class="library-stat-top">
                            <span class="round-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M9 4a4 4 0 0 0-4 4v1a4 4 0 0 0 0 6v1a4 4 0 0 0 4 4m6-16a4 4 0 0 1 4 4v1a4 4 0 0 1 0 6v1a4 4 0 0 1-4 4M9 4v16m6-16v16M7 9h4m2 0h4M7 15h4m2 0h4"/></svg>
                            </span>
                            <div>
                                <b>{{ $topicCounts->count() }}</b>
                                <div class="stat-label">Topics</div>
                            </div>
                        </div>
                        <div class="library-stat-desc">Areas to explore</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section" style="padding-top:22px;">
            <div class="shell">
                @php
                    $topicOptions = $topicCounts->keys();
                    $formatOptions = $libraryItems->pluck('format')->filter()->unique()->sort()->values();
                @endphp
                <div class="library-controls">
                    <form class="library-search">
                        <input type="search" placeholder="Search episodes, topics, or keywords..." aria-label="Search library">
                        <button type="button" aria-label="Search">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="m21 21-4.35-4.35M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15Z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                        </button>
                    </form>
                    <select class="select-pill" data-control-type aria-label="Filter by content type">
                        <option value="all">All Content</option>
                        <option value="VIDEO">Videos</option>
                        <option value="ARTICLE">Articles</option>
                        <option value="RESOURCE">Resources</option>
                    </select>
                    <select class="select-pill" data-control-topic aria-label="Filter by topic">
                        <option value="all">All Topics</option>
                        @foreach ($topicOptions as $topic)
                            <option value="{{ $topic }}">{{ $topic }}</option>
                        @endforeach
                    </select>
                    <select class="select-pill" data-control-format aria-label="Filter by format">
                        <option value="all">All Formats</option>
                        @foreach ($formatOptions as $format)
                            <option value="{{ $format }}">{{ $format }}</option>
                        @endforeach
                    </select>
                    <select class="select-pill" data-control-sort aria-label="Sort library items">
                        <option value="newest">Sort: Newest</option>
                        <option value="oldest">Sort: Oldest</option>
                        <option value="title">Sort: A-Z</option>
                        <option value="duration">Sort: Duration</option>
                    </select>
                    <button class="select-pill reset-filters-btn" type="button">↻ Reset</button>
                </div>

                <div class="library-layout">
                    <aside class="filter-panel">
                        <div class="filter-section">
                            <h3>Filter by Type</h3>
                            @foreach ([
                                ['All Content', $totalLibraryItems, true, '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:8px;display:inline-block;vertical-align:middle;"><polygon points="12 2 2 7 12 12 22 7 12 2"/><polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/></svg>', 'all'],
                                ['Videos', $typeCounts->get('VIDEO', 0), false, '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:8px;display:inline-block;vertical-align:middle;"><path d="M23 7l-7 5 7 5V7z"/><rect x="1" y="5" width="15" height="14" rx="2" ry="2"/></svg>', 'VIDEO'],
                                ['Articles / Deep Dives', $typeCounts->get('ARTICLE', 0), false, '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:8px;display:inline-block;vertical-align:middle;"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>', 'ARTICLE'],
                                ['Resources', $typeCounts->get('RESOURCE', 0), false, '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:8px;display:inline-block;vertical-align:middle;"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"/></svg>', 'RESOURCE']
                            ] as [$label, $count, $active, $iconHtml, $typeKey])
                                <div class="filter-line {{ $active ? 'active' : '' }}" data-filter-type="{{ $typeKey }}" style="cursor:pointer;">
                                    <span style="display:flex;align-items:center;">{!! $iconHtml !!}{{ $label }}</span>
                                    <span>{{ $count }}</span>
                                </div>
                            @endforeach
                        </div>

                        <div class="filter-section">
                            <h3>Duration (Videos)</h3>
                            @foreach (['All Durations', '0 - 10 min', '10 - 20 min', '20 - 40 min', '40+ min'] as $index => $duration)
                                <div class="filter-line" data-filter-duration="{{ $index }}" style="cursor:pointer;">
                                    <span style="display:flex;align-items:center;gap:10px;">
                                        <span class="filter-dot" style="{{ $index === 0 ? 'border-color:#d97706;background:#d97706;box-shadow:inset 0 0 0 3px #fff;' : '' }}"></span>
                                        {{ $duration }}
                                    </span>
                                    <span>{{ $index === 0 ? '' : '0' }}</span>
                                </div>
                            @endforeach
                        </div>

                        <div class="filter-section">
                            <h3>Difficulty Level</h3>
                            @foreach (['Beginner', 'Intermediate', 'Advanced'] as $level)
                                <div class="filter-line" data-filter-difficulty="{{ $level }}" style="cursor:pointer;">
                                    <span style="display:flex;align-items:center;gap:10px;">
                                        <span class="filter-check"></span>
                                        {{ $level }}
                                    </span>
                                    <span>0</span>
                                </div>
                            @endforeach
                            <button class="btn btn-dark clear-filters-btn" style="width:100%;margin-top:18px;background:#fff;color:#06111f;border-color:#dbe4ee;" type="button">× Clear All Filters</button>
                        </div>
                    </aside>

                    <section>
                        <div class="library-main-head">
                            <span>{{ $totalLibraryItems }} Results Found</span>
                            <div class="view-toggle">
                                <span class="grid-toggle active" style="cursor:pointer;">▦</span>
                                <span class="list-toggle" style="cursor:pointer;">☷</span>
                            </div>
                        </div>

                        <div class="content-grid-library">
                            @forelse ($libraryItems as $item)
                                <a href="{{ route('life-decode.library.show', $item) }}" class="library-card" data-type="{{ $item->type }}" data-duration="{{ $item->duration_minutes }}" data-difficulty="{{ $item->difficulty }}" data-title="{{ strtolower($item->title) }}" data-title-raw="{{ $item->title }}" data-primary-topic="{{ $item->primary_topic }}" data-secondary-topic="{{ $item->secondary_topic ?? '' }}" data-format="{{ $item->format ?? '' }}" data-published="{{ $item->published_on?->timestamp ?? 0 }}" data-sort-order="{{ $item->sort_order }}" data-tags="{{ strtolower($item->primary_topic) }},{{ strtolower($item->secondary_topic ?? '') }},{{ strtolower($item->format ?? '') }}">
                                    <div class="library-thumb {{ $item->smart_thumbnail_class }}" @if ($item->thumbnail_image_url) style="background-image: linear-gradient(90deg, rgba(6, 17, 31, .10), rgba(6, 17, 31, .42)), url('{{ $item->thumbnail_image_url }}');" @endif>
                                        @if ($item->duration_label)
                                            <span class="duration">{{ $item->duration_label }}</span>
                                            <span class="play-dot">
                                                <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor" style="margin-left:2px;"><path d="M8 5v14l11-7z"/></svg>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="library-card-body">
                                        <span class="type-label {{ $item->smart_label_class }}">{{ $item->type }}</span>
                                        <h3>{{ $item->title }}</h3>
                                        <p class="library-card-desc">{{ $item->description }}</p>
                                        <div class="mini-tags" style="margin-top:0;">
                                            <span>{{ $item->primary_topic }}</span>
                                            @if ($item->secondary_topic)
                                                <span>{{ $item->secondary_topic }}</span>
                                            @endif
                                        </div>
                                        <div class="library-meta" style="margin-top:14px;">
                                            <span>{{ $item->display_date }}</span>
                                            <span>•</span>
                                            @if ($item->format)
                                                <span>{{ $item->format }}</span>
                                            @endif
                                            @if ($item->duration_label)
                                                <span>|</span>
                                                <span>{{ $item->duration_minutes }} min</span>
                                            @endif
                                            @if ($item->type === 'RESOURCE')
                                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" style="margin-left:auto;color:#9aa6b2;cursor:pointer;"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                                            @else
                                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" style="margin-left:auto;color:#9aa6b2;cursor:pointer;"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/></svg>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <p class="copy">No library content is published yet.</p>
                            @endforelse
                        </div>

                        <div class="help-strip">
                            <div style="display:flex;align-items:center;gap:14px;">
                                <span class="round-icon" style="background:#0b1d32;color:#fff;">?</span>
                                <div><b>Can't find what you're looking for?</b><p style="color:rgba(255,255,255,.72);font-size:13px;">Use search or browse topics to explore more insights.</p></div>
                            </div>
                            <button class="btn btn-dark" type="button">Suggest a Topic</button>
                        </div>
                    </section>

                    <aside class="library-right">
                        <section class="side-card">
                            <div class="side-head"><h3>Browse by Topic</h3><a class="link-blue" href="#">View All Topics</a></div>
                            <div class="browse-topic">
                                @foreach ($topicCounts as $topic => $count)
                                    <div class="topic-mini">
                                        <span style="display:flex;align-items:center;">
                                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color:#0b63ce;margin-right:8px;display:inline-block;vertical-align:middle;"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M4 4.5A2.5 2.5 0 0 1 6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5z"/></svg>
                                            {{ $topic }}
                                        </span>
                                        <span class="count-pill">{{ $count }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </section>

                        <section class="side-card">
                            <div class="resource-center">
                                <div>
                                    <h3>Resource Center</h3>
                                    <p class="copy" style="font-size:13px;margin-top:8px;">Download practical tools and worksheets to apply what you learn.</p>
                                    <a class="btn btn-dark" style="margin-top:14px;background:#fff;color:#d97706;border-color:#f6c766;" href="{{ route('life-decode.tools') }}">Explore Resources
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none"><path d="M5 12h14m-6-6 6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    </a>
                                </div>
                                <div class="resource-sketch" style="display:flex;align-items:center;justify-content:center;padding:8px;">
                                    <svg width="60" height="70" viewBox="0 0 60 70" fill="none" style="filter: drop-shadow(0 4px 10px rgba(15,23,42,0.06));">
                                        <!-- Back sheet -->
                                        <rect x="8" y="12" width="40" height="50" rx="3" fill="#fff" stroke="#d1d5db" stroke-width="1.5"/>
                                        <line x1="14" y1="24" x2="34" y2="24" stroke="#e5e7eb" stroke-width="2" stroke-linecap="round"/>
                                        <line x1="14" y1="32" x2="42" y2="32" stroke="#e5e7eb" stroke-width="2" stroke-linecap="round"/>
                                        <line x1="14" y1="40" x2="38" y2="40" stroke="#e5e7eb" stroke-width="2" stroke-linecap="round"/>
                                        <!-- Front sheet -->
                                        <rect x="14" y="6" width="40" height="50" rx="3" fill="#fff" stroke="#93c5fd" stroke-width="1.8"/>
                                        <line x1="20" y1="18" x2="40" y2="18" stroke="#3b82f6" stroke-width="2.5" stroke-linecap="round"/>
                                        <line x1="20" y1="26" x2="48" y2="26" stroke="#93c5fd" stroke-width="2" stroke-linecap="round"/>
                                        <line x1="20" y1="34" x2="44" y2="34" stroke="#e2e8f0" stroke-width="2" stroke-linecap="round"/>
                                        <line x1="20" y1="42" x2="36" y2="42" stroke="#e2e8f0" stroke-width="2" stroke-linecap="round"/>
                                        <!-- Floating page decoration -->
                                        <path d="M42 48l12-4M46 54l6-2" stroke="#fbbf24" stroke-width="2" stroke-linecap="round"/>
                                    </svg>
                                </div>
                            </div>
                        </section>

                        <section class="side-card">
                            <h3>Stay Updated</h3>
                            <p class="copy" style="font-size:13px;margin-top:8px;">Get new insights and resources straight to your inbox.</p>
                            <input style="width:100%;height:44px;margin-top:16px;border:1px solid #dbe4ee;border-radius:7px;padding:0 12px;" type="email" placeholder="Enter your email">
                            <button class="btn btn-primary" style="width:100%;margin-top:12px;" type="button">Subscribe</button>
                            <div style="display:flex;align-items:center;gap:12px;margin-top:16px;">
                                <div class="user-avatars" style="display:flex;">
                                    <span class="user-avatar" style="width:28px;height:28px;border-radius:50%;border:2px solid #fff;background:#fef3c7;color:#d97706;font-size:10px;font-weight:800;display:grid;place-items:center;margin-right:-8px;box-shadow:0 2px 4px rgba(0,0,0,0.08);">JD</span>
                                    <span class="user-avatar" style="width:28px;height:28px;border-radius:50%;border:2px solid #fff;background:#dbeafe;color:#2563eb;font-size:10px;font-weight:800;display:grid;place-items:center;margin-right:-8px;box-shadow:0 2px 4px rgba(0,0,0,0.08);">AR</span>
                                    <span class="user-avatar" style="width:28px;height:28px;border-radius:50%;border:2px solid #fff;background:#dcfce7;color:#15803d;font-size:10px;font-weight:800;display:grid;place-items:center;margin-right:-8px;box-shadow:0 2px 4px rgba(0,0,0,0.08);">MK</span>
                                    <span class="user-avatar" style="width:28px;height:28px;border-radius:50%;border:2px solid #fff;background:#f3e8ff;color:#7e22ce;font-size:10px;font-weight:800;display:grid;place-items:center;margin-right:-8px;box-shadow:0 2px 4px rgba(0,0,0,0.08);">SL</span>
                                    <span class="user-avatar" style="width:28px;height:28px;border-radius:50%;border:2px solid #fff;background:#ffe4e6;color:#e11d48;font-size:10px;font-weight:800;display:grid;place-items:center;box-shadow:0 2px 4px rgba(0,0,0,0.08);">TH</span>
                                </div>
                                <span class="copy" style="font-size:12px;font-weight:700;color:#5c6675;">Join 25,000+ learners</span>
                            </div>
                        </section>
                    </aside>
                </div>
            </div>
        </section>
    </main>

    <script>
        (() => {
            const cards = Array.from(document.querySelectorAll('.library-card'));
            const cardsContainer = document.querySelector('.content-grid-library');
            const searchInput = document.querySelector('.library-search input');
            const searchForm = document.querySelector('.library-search');
            const typeSelect = document.querySelector('[data-control-type]');
            const topicSelect = document.querySelector('[data-control-topic]');
            const formatSelect = document.querySelector('[data-control-format]');
            const sortSelect = document.querySelector('[data-control-sort]');
            const typeFilters = document.querySelectorAll('[data-filter-type]');
            const durationFilters = document.querySelectorAll('[data-filter-duration]');
            const difficultyFilters = document.querySelectorAll('[data-filter-difficulty]');
            const resetBtn = document.querySelector('.reset-filters-btn');
            const clearFiltersBtn = document.querySelector('.clear-filters-btn');
            const resultsCounter = document.querySelector('.library-main-head span');

            let activeType = 'all';
            let activeTopic = 'all';
            let activeFormat = 'all';
            let activeDuration = '0';
            let activeDifficulties = [];
            let searchQuery = '';
            let sortMode = 'newest';

            const sortCards = () => {
                const sortedCards = [...cards].sort((a, b) => {
                    if (sortMode === 'oldest') {
                        return (parseInt(a.dataset.published) || 0) - (parseInt(b.dataset.published) || 0);
                    }

                    if (sortMode === 'title') {
                        return a.dataset.titleRaw.localeCompare(b.dataset.titleRaw);
                    }

                    if (sortMode === 'duration') {
                        return (parseInt(b.dataset.duration) || 0) - (parseInt(a.dataset.duration) || 0);
                    }

                    const publishedDiff = (parseInt(b.dataset.published) || 0) - (parseInt(a.dataset.published) || 0);

                    return publishedDiff || ((parseInt(a.dataset.sortOrder) || 0) - (parseInt(b.dataset.sortOrder) || 0));
                });

                sortedCards.forEach(card => cardsContainer.appendChild(card));
            };

            const setActiveType = (type) => {
                activeType = type;
                if (typeSelect) typeSelect.value = type;
                typeFilters.forEach(filter => {
                    filter.classList.toggle('active', filter.dataset.filterType === type);
                });
            };

            const updateFilters = () => {
                sortCards();
                let visibleCount = 0;

                cards.forEach(card => {
                    const type = card.dataset.type;
                    const duration = parseInt(card.dataset.duration) || 0;
                    const difficulty = card.dataset.difficulty;
                    const title = card.dataset.title;
                    const tags = card.dataset.tags;
                    const format = card.dataset.format;
                    const primaryTopic = card.dataset.primaryTopic;
                    const secondaryTopic = card.dataset.secondaryTopic;

                    const matchesType = (activeType === 'all') || (type === activeType);
                    const matchesTopic = (activeTopic === 'all') || (primaryTopic === activeTopic) || (secondaryTopic === activeTopic);
                    const matchesFormat = (activeFormat === 'all') || (format === activeFormat);

                    let matchesDuration = true;
                    if (activeDuration === '1') {
                        matchesDuration = duration > 0 && duration <= 10;
                    } else if (activeDuration === '2') {
                        matchesDuration = duration > 10 && duration <= 20;
                    } else if (activeDuration === '3') {
                        matchesDuration = duration > 20 && duration <= 40;
                    } else if (activeDuration === '4') {
                        matchesDuration = duration > 40;
                    }

                    const matchesDifficulty = (activeDifficulties.length === 0) || activeDifficulties.includes(difficulty);
                    const matchesSearch = title.includes(searchQuery) || tags.includes(searchQuery);

                    const show = matchesType && matchesTopic && matchesFormat && matchesDuration && matchesDifficulty && matchesSearch;
                    card.style.display = show ? '' : 'none';

                    if (show) visibleCount++;
                });

                resultsCounter.textContent = `${visibleCount} Results Found`;

                // Update type filter counts dynamically
                typeFilters.forEach(btn => {
                    const filterType = btn.dataset.filterType;
                    let count = 0;
                    cards.forEach(c => {
                        const type = c.dataset.type;
                        const duration = parseInt(c.dataset.duration) || 0;
                        const difficulty = c.dataset.difficulty;
                        const title = c.dataset.title;
                        const tags = c.dataset.tags;
                        const format = c.dataset.format;
                        const primaryTopic = c.dataset.primaryTopic;
                        const secondaryTopic = c.dataset.secondaryTopic;

                        const matchesDuration = (activeDuration === '0') || 
                            (activeDuration === '1' && duration > 0 && duration <= 10) ||
                            (activeDuration === '2' && duration > 10 && duration <= 20) ||
                            (activeDuration === '3' && duration > 20 && duration <= 40) ||
                            (activeDuration === '4' && duration > 40);

                        const matchesTopic = (activeTopic === 'all') || (primaryTopic === activeTopic) || (secondaryTopic === activeTopic);
                        const matchesFormat = (activeFormat === 'all') || (format === activeFormat);
                        const matchesDifficulty = (activeDifficulties.length === 0) || activeDifficulties.includes(difficulty);
                        const matchesSearch = title.includes(searchQuery) || tags.includes(searchQuery);

                        if (matchesTopic && matchesFormat && matchesDuration && matchesDifficulty && matchesSearch) {
                            if (filterType === 'all' || type === filterType) count++;
                        }
                    });
                    btn.querySelector('span:last-child').textContent = count;
                });

                // Update difficulty counts dynamically
                difficultyFilters.forEach(btn => {
                    const diffType = btn.dataset.filterDifficulty;
                    let count = 0;
                    cards.forEach(c => {
                        const type = c.dataset.type;
                        const duration = parseInt(c.dataset.duration) || 0;
                        const title = c.dataset.title;
                        const tags = c.dataset.tags;
                        const format = c.dataset.format;
                        const primaryTopic = c.dataset.primaryTopic;
                        const secondaryTopic = c.dataset.secondaryTopic;

                        const matchesType = (activeType === 'all') || (type === activeType);
                        const matchesTopic = (activeTopic === 'all') || (primaryTopic === activeTopic) || (secondaryTopic === activeTopic);
                        const matchesFormat = (activeFormat === 'all') || (format === activeFormat);
                        const matchesDuration = (activeDuration === '0') || 
                            (activeDuration === '1' && duration > 0 && duration <= 10) ||
                            (activeDuration === '2' && duration > 10 && duration <= 20) ||
                            (activeDuration === '3' && duration > 20 && duration <= 40) ||
                            (activeDuration === '4' && duration > 40);
                        const matchesSearch = title.includes(searchQuery) || tags.includes(searchQuery);

                        if (matchesType && matchesTopic && matchesFormat && matchesDuration && matchesSearch) {
                            if (c.dataset.difficulty === diffType) count++;
                        }
                    });
                    btn.querySelector('span:last-child').textContent = count;
                });

                // Update duration counts dynamically
                durationFilters.forEach(btn => {
                    const durIdx = btn.dataset.filterDuration;
                    let count = 0;
                    cards.forEach(c => {
                        const type = c.dataset.type;
                        const duration = parseInt(c.dataset.duration) || 0;
                        const difficulty = c.dataset.difficulty;
                        const title = c.dataset.title;
                        const tags = c.dataset.tags;
                        const format = c.dataset.format;
                        const primaryTopic = c.dataset.primaryTopic;
                        const secondaryTopic = c.dataset.secondaryTopic;

                        const matchesType = (activeType === 'all') || (type === activeType);
                        const matchesTopic = (activeTopic === 'all') || (primaryTopic === activeTopic) || (secondaryTopic === activeTopic);
                        const matchesFormat = (activeFormat === 'all') || (format === activeFormat);
                        const matchesDifficulty = (activeDifficulties.length === 0) || activeDifficulties.includes(difficulty);
                        const matchesSearch = title.includes(searchQuery) || tags.includes(searchQuery);

                        if (matchesType && matchesTopic && matchesFormat && matchesDifficulty && matchesSearch) {
                            if (durIdx === '0') count++;
                            else if (durIdx === '1' && duration > 0 && duration <= 10) count++;
                            else if (durIdx === '2' && duration > 10 && duration <= 20) count++;
                            else if (durIdx === '3' && duration > 20 && duration <= 40) count++;
                            else if (durIdx === '4' && duration > 40) count++;
                        }
                    });
                    if (durIdx !== '0') {
                        btn.querySelector('span:last-child').textContent = count;
                    }
                });
            };

            searchForm.addEventListener('submit', (e) => e.preventDefault());

            searchInput.addEventListener('input', (e) => {
                searchQuery = e.target.value.toLowerCase().trim();
                updateFilters();
            });

            typeFilters.forEach(btn => {
                btn.addEventListener('click', () => {
                    setActiveType(btn.dataset.filterType);
                    updateFilters();
                });
            });

            if (typeSelect) {
                typeSelect.addEventListener('change', (event) => {
                    setActiveType(event.target.value);
                    updateFilters();
                });
            }

            if (topicSelect) {
                topicSelect.addEventListener('change', (event) => {
                    activeTopic = event.target.value;
                    updateFilters();
                });
            }

            if (formatSelect) {
                formatSelect.addEventListener('change', (event) => {
                    activeFormat = event.target.value;
                    updateFilters();
                });
            }

            if (sortSelect) {
                sortSelect.addEventListener('change', (event) => {
                    sortMode = event.target.value;
                    updateFilters();
                });
            }

            durationFilters.forEach(btn => {
                btn.addEventListener('click', () => {
                    durationFilters.forEach(f => {
                        const dot = f.querySelector('.filter-dot');
                        dot.style.background = '';
                        dot.style.borderColor = '';
                        dot.style.boxShadow = '';
                    });
                    const activeDot = btn.querySelector('.filter-dot');
                    activeDot.style.borderColor = '#d97706';
                    activeDot.style.background = '#d97706';
                    activeDot.style.boxShadow = 'inset 0 0 0 3px #fff';

                    activeDuration = btn.dataset.filterDuration;
                    updateFilters();
                });
            });

            difficultyFilters.forEach(btn => {
                btn.addEventListener('click', () => {
                    const check = btn.querySelector('.filter-check');
                    const isChecked = check.classList.toggle('checked');
                    const difficulty = btn.dataset.filterDifficulty;

                    if (isChecked) {
                        activeDifficulties.push(difficulty);
                    } else {
                        activeDifficulties = activeDifficulties.filter(d => d !== difficulty);
                    }
                    updateFilters();
                });
            });

            const resetAll = () => {
                searchInput.value = '';
                searchQuery = '';

                setActiveType('all');
                activeTopic = 'all';
                activeFormat = 'all';
                sortMode = 'newest';
                if (topicSelect) topicSelect.value = 'all';
                if (formatSelect) formatSelect.value = 'all';
                if (sortSelect) sortSelect.value = 'newest';

                durationFilters.forEach((f, idx) => {
                    const dot = f.querySelector('.filter-dot');
                    dot.style.background = idx === 0 ? '#d97706' : '';
                    dot.style.borderColor = idx === 0 ? '#d97706' : '';
                    dot.style.boxShadow = idx === 0 ? 'inset 0 0 0 3px #fff' : '';
                });
                activeDuration = '0';

                difficultyFilters.forEach(f => {
                    f.querySelector('.filter-check').classList.remove('checked');
                });
                activeDifficulties = [];

                updateFilters();
            };

            resetBtn.addEventListener('click', resetAll);
            clearFiltersBtn.addEventListener('click', resetAll);

            // View Mode Toggles
            const gridToggle = document.querySelector('.grid-toggle');
            const listToggle = document.querySelector('.list-toggle');

            gridToggle.addEventListener('click', () => {
                gridToggle.classList.add('active');
                listToggle.classList.remove('active');
                cardsContainer.classList.remove('list-view');
            });

            listToggle.addEventListener('click', () => {
                listToggle.classList.add('active');
                gridToggle.classList.remove('active');
                cardsContainer.classList.add('list-view');
            });

            // Initialize counts
            updateFilters();
        })();

        // Theme is handled globally by layout.blade.php

    </script>
@endsection
