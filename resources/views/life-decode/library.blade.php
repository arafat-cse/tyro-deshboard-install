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
                                <b>112</b>
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
                                <b>78</b>
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
                                <b>36</b>
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
                                <b>15</b>
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
                <div class="library-controls">
                    <form class="library-search">
                        <input type="search" placeholder="Search episodes, topics, or keywords..." aria-label="Search library">
                        <button type="button" aria-label="Search">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="m21 21-4.35-4.35M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15Z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                        </button>
                    </form>
                    <button class="select-pill" type="button">All Content ˅</button>
                    <button class="select-pill" type="button">All Topics ˅</button>
                    <button class="select-pill" type="button">All Formats ˅</button>
                    <button class="select-pill" type="button">Sort: Newest ˅</button>
                    <button class="select-pill reset-filters-btn" type="button">↻ Reset</button>
                </div>

                <div class="library-layout">
                    <aside class="filter-panel">
                        <div class="filter-section">
                            <h3>Filter by Type</h3>
                            @foreach ([
                                ['All Content', 226, true, '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:8px;display:inline-block;vertical-align:middle;"><polygon points="12 2 2 7 12 12 22 7 12 2"/><polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/></svg>', 'all'],
                                ['Videos', 112, false, '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:8px;display:inline-block;vertical-align:middle;"><path d="M23 7l-7 5 7 5V7z"/><rect x="1" y="5" width="15" height="14" rx="2" ry="2"/></svg>', 'VIDEO'],
                                ['Articles / Deep Dives', 78, false, '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:8px;display:inline-block;vertical-align:middle;"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>', 'ARTICLE'],
                                ['Resources', 36, false, '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:8px;display:inline-block;vertical-align:middle;"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"/></svg>', 'RESOURCE']
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
                            <span>226 Results Found</span>
                            <div class="view-toggle">
                                <span class="grid-toggle active" style="cursor:pointer;">▦</span>
                                <span class="list-toggle" style="cursor:pointer;">☷</span>
                            </div>
                        </div>

                        <div class="content-grid-library">
                            @foreach ([
                                ['VIDEO', '10 Cognitive Biases That Control Your Decisions', 'Cognitive Biases', 'Psychology', 'May 15, 2024', '18 min', '18:45', 'creator-thumb', ''],
                                ['VIDEO', 'The Reticular Activating System (RAS) Explained Simply', 'Mindset', 'Neuroscience', 'May 12, 2024', '22 min', '22:10', 'hero-thumb', ''],
                                ['ARTICLE', 'The Halo Effect: How It Affects Every Decision You Make', 'Cognitive Biases', 'Behavior', 'May 10, 2024', '12 min read', '16:33', '', 'article-label'],
                                ['VIDEO', 'Why Most People Never Achieve Their Goals', 'Mindset', 'Self Improvement', 'May 8, 2024', '21 min', '21:47', 'mindset-thumb', ''],
                                ['RESOURCE', 'Life Audit Worksheet (PDF)', 'Worksheet', 'Personal Growth', 'May 6, 2024', 'PDF', '', 'desk-thumb', 'resource-label'],
                                ['ARTICLE', 'Stoicism in Daily Life: Ancient Wisdom for Modern Problems', 'Philosophy', 'Mindset', 'May 5, 2024', '10 min read', '', 'philosophy-thumb', 'article-label'],
                                ['VIDEO', 'How Your Mind Builds Reality', 'Mental Models', 'Neuroscience', 'May 4, 2024', '19 min', '19:31', 'hero-thumb', ''],
                                ['ARTICLE', 'The Missing Piece: Understanding Yourself Better', 'Self Awareness', 'Behavior', 'May 3, 2024', '8 min read', '', 'case-thumb', 'article-label'],
                                ['RESOURCE', 'Decision Making Framework Cheat Sheet', 'Framework', 'Decision Making', 'May 2, 2024', 'PDF', '', 'diagram-thumb', 'resource-label'],
                            ] as [$type, $title, $tagA, $tagB, $date, $meta, $duration, $imageClass, $labelClass])
                                <article class="library-card" data-type="{{ $type }}" data-duration="{{ $duration ? intval($duration) : 0 }}" data-difficulty="{{ ['Beginner', 'Intermediate', 'Advanced'][$loop->index % 3] }}" data-title="{{ strtolower($title) }}" data-tags="{{ strtolower($tagA) }},{{ strtolower($tagB) }}">
                                    <div class="library-thumb {{ $imageClass }}">
                                        @if ($duration)
                                            <span class="duration">{{ $duration }}</span>
                                            <span class="play-dot">
                                                <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor" style="margin-left:2px;"><path d="M8 5v14l11-7z"/></svg>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="library-card-body">
                                        <span class="type-label {{ $labelClass }}">{{ $type }}</span>
                                        <h3>{{ $title }}</h3>
                                        <div class="mini-tags" style="margin-top:0;"><span>{{ $tagA }}</span><span>{{ $tagB }}</span></div>
                                        <div class="library-meta" style="margin-top:14px;">
                                            <span>{{ $date }}</span>
                                            <span>•</span>
                                            <span>{{ $meta }}</span>
                                            @if ($type === 'RESOURCE')
                                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" style="margin-left:auto;color:#9aa6b2;cursor:pointer;"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                                            @else
                                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" style="margin-left:auto;color:#9aa6b2;cursor:pointer;"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/></svg>
                                            @endif
                                        </div>
                                    </div>
                                </article>
                            @endforeach
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
                                @foreach ([
                                    ['Cognitive Biases', 24, '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color:#eab308;margin-right:8px;display:inline-block;vertical-align:middle;"><path d="M9.5 2A2.5 2.5 0 0 1 12 4.5v15a2.5 2.5 0 0 1-4.96-.44 2.5 2.5 0 0 1 0-3.12 3 3 0 0 1 0-4.88 2.5 2.5 0 0 1 0-3.12A2.5 2.5 0 0 1 9.5 2Z"/><path d="M14.5 2A2.5 2.5 0 0 0 12 4.5v15a2.5 2.5 0 0 0 4.96-.44 2.5 2.5 0 0 0 0-3.12 3 3 0 0 0 0-4.88 2.5 2.5 0 0 0 0-3.12A2.5 2.5 0 0 0 14.5 2Z"/></svg>'],
                                    ['Mindset', 18, '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color:#2563eb;margin-right:8px;display:inline-block;vertical-align:middle;"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>'],
                                    ['Mental Models', 16, '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color:#8b5cf6;margin-right:8px;display:inline-block;vertical-align:middle;"><path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"/></svg>'],
                                    ['Productivity', 19, '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color:#10b981;margin-right:8px;display:inline-block;vertical-align:middle;"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>'],
                                    ['Human Behavior', 22, '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color:#ec4899;margin-right:8px;display:inline-block;vertical-align:middle;"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>'],
                                    ['Philosophy', 15, '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color:#f97316;margin-right:8px;display:inline-block;vertical-align:middle;"><line x1="4" y1="21" x2="20" y2="21"/><line x1="4" y1="18" x2="20" y2="18"/><line x1="6" y1="6" x2="6" y2="18"/><line x1="12" y1="6" x2="12" y2="18"/><line x1="18" y1="6" x2="18" y2="18"/><path d="M3 6l9-4 9 4"/></svg>'],
                                    ['Neuroscience', 12, '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color:#06b6d4;margin-right:8px;display:inline-block;vertical-align:middle;"><path d="M9.5 2A2.5 2.5 0 0 1 12 4.5v15a2.5 2.5 0 0 1-4.96-.44 2.5 2.5 0 0 1 0-3.12 3 3 0 0 1 0-4.88 2.5 2.5 0 0 1 0-3.12A2.5 2.5 0 0 1 9.5 2Z"/><path d="M14.5 2A2.5 2.5 0 0 0 12 4.5v15a2.5 2.5 0 0 0 4.96-.44 2.5 2.5 0 0 0 0-3.12 3 3 0 0 0 0-4.88 2.5 2.5 0 0 0 0-3.12A2.5 2.5 0 0 0 14.5 2Z"/></svg>'],
                                    ['Case Studies', 10, '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color:#84cc16;margin-right:8px;display:inline-block;vertical-align:middle;"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>'],
                                    ['Emotional Intelligence', 8, '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color:#ef4444;margin-right:8px;display:inline-block;vertical-align:middle;"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>'],
                                    ['Communication', 9, '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color:#0d9488;margin-right:8px;display:inline-block;vertical-align:middle;"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>'],
                                    ['Habits', 12, '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color:#6366f1;margin-right:8px;display:inline-block;vertical-align:middle;"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>'],
                                    ['Self Improvement', 14, '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color:#f59e0b;margin-right:8px;display:inline-block;vertical-align:middle;"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>'],
                                    ['Creativity', 7, '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color:#ea580c;margin-right:8px;display:inline-block;vertical-align:middle;"><path d="M15 14c.2-1 .7-1.7 1.5-2.5 1-.9 1.5-2.2 1.5-3.5A5 5 0 0 0 8 8c0 1 .6 2.2 1.5 3.5.7.7 1.3 1.5 1.5 2.5M9 18h6M10 22h4"/></svg>'],
                                    ['Purpose & Meaning', 6, '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color:#dc2626;margin-right:8px;display:inline-block;vertical-align:middle;"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>'],
                                    ['Relationships', 8, '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color:#f472b6;margin-right:8px;display:inline-block;vertical-align:middle;"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>']
                                ] as [$topic, $count, $iconHtml])
                                    <div class="topic-mini">
                                        <span style="display:flex;align-items:center;">
                                            {!! $iconHtml !!}
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
            const searchInput = document.querySelector('.library-search input');
            const searchForm = document.querySelector('.library-search');
            const typeFilters = document.querySelectorAll('[data-filter-type]');
            const durationFilters = document.querySelectorAll('[data-filter-duration]');
            const difficultyFilters = document.querySelectorAll('[data-filter-difficulty]');
            const resetBtn = document.querySelector('.reset-filters-btn');
            const clearFiltersBtn = document.querySelector('.clear-filters-btn');
            const resultsCounter = document.querySelector('.library-main-head span');

            let activeType = 'all';
            let activeDuration = '0';
            let activeDifficulties = [];
            let searchQuery = '';

            const updateFilters = () => {
                let visibleCount = 0;

                cards.forEach(card => {
                    const type = card.dataset.type;
                    const duration = parseInt(card.dataset.duration) || 0;
                    const difficulty = card.dataset.difficulty;
                    const title = card.dataset.title;
                    const tags = card.dataset.tags;

                    const matchesType = (activeType === 'all') || (type === activeType);

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

                    const show = matchesType && matchesDuration && matchesDifficulty && matchesSearch;
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

                        const matchesDuration = (activeDuration === '0') || 
                            (activeDuration === '1' && duration > 0 && duration <= 10) ||
                            (activeDuration === '2' && duration > 10 && duration <= 20) ||
                            (activeDuration === '3' && duration > 20 && duration <= 40) ||
                            (activeDuration === '4' && duration > 40);

                        const matchesDifficulty = (activeDifficulties.length === 0) || activeDifficulties.includes(difficulty);
                        const matchesSearch = title.includes(searchQuery) || tags.includes(searchQuery);

                        if (matchesDuration && matchesDifficulty && matchesSearch) {
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

                        const matchesType = (activeType === 'all') || (type === activeType);
                        const matchesDuration = (activeDuration === '0') || 
                            (activeDuration === '1' && duration > 0 && duration <= 10) ||
                            (activeDuration === '2' && duration > 10 && duration <= 20) ||
                            (activeDuration === '3' && duration > 20 && duration <= 40) ||
                            (activeDuration === '4' && duration > 40);
                        const matchesSearch = title.includes(searchQuery) || tags.includes(searchQuery);

                        if (matchesType && matchesDuration && matchesSearch) {
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

                        const matchesType = (activeType === 'all') || (type === activeType);
                        const matchesDifficulty = (activeDifficulties.length === 0) || activeDifficulties.includes(difficulty);
                        const matchesSearch = title.includes(searchQuery) || tags.includes(searchQuery);

                        if (matchesType && matchesDifficulty && matchesSearch) {
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
                    typeFilters.forEach(f => f.classList.remove('active'));
                    btn.classList.add('active');
                    activeType = btn.dataset.filterType;
                    updateFilters();
                });
            });

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

                typeFilters.forEach(f => f.classList.remove('active'));
                const defaultType = document.querySelector('[data-filter-type="all"]');
                if (defaultType) defaultType.classList.add('active');
                activeType = 'all';

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
            const gridContainer = document.querySelector('.content-grid-library');

            gridToggle.addEventListener('click', () => {
                gridToggle.classList.add('active');
                listToggle.classList.remove('active');
                gridContainer.classList.remove('list-view');
            });

            listToggle.addEventListener('click', () => {
                listToggle.classList.add('active');
                gridToggle.classList.remove('active');
                gridContainer.classList.add('list-view');
            });

            // Initialize counts
            updateFilters();
        })();

        // Theme is handled globally by layout.blade.php

    </script>
@endsection
