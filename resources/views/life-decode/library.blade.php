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
                    <div class="library-stat"><span class="round-icon">▶</span><div><b>112</b><span>Videos<br>In-depth lessons</span></div></div>
                    <div class="library-stat"><span class="round-icon">A</span><div><b>78</b><span>Articles<br>Deep dive insights</span></div></div>
                    <div class="library-stat"><span class="round-icon">↓</span><div><b>36</b><span>Resources<br>Worksheets & guides</span></div></div>
                    <div class="library-stat"><span class="round-icon">B</span><div><b>15</b><span>Topics<br>Areas to explore</span></div></div>
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
                    <button class="select-pill" type="button">↻ Reset</button>
                </div>

                <div class="library-layout">
                    <aside class="filter-panel">
                        <div class="filter-section">
                            <h3>Filter by Type</h3>
                            @foreach ([['All Content', 226, true], ['Videos', 112, false], ['Articles / Deep Dives', 78, false], ['Resources', 36, false]] as [$label, $count, $active])
                                <div class="filter-line {{ $active ? 'active' : '' }}"><span>{{ $label }}</span><span>{{ $count }}</span></div>
                            @endforeach
                        </div>

                        <div class="filter-section">
                            <h3>Duration (Videos)</h3>
                            @foreach (['All Durations', '0 - 10 min', '10 - 20 min', '20 - 40 min', '40+ min'] as $index => $duration)
                                <div class="filter-line"><span style="display:flex;align-items:center;gap:10px;"><span class="filter-dot" style="{{ $index === 0 ? 'border-color:#ffbb2e;background:#ffbb2e;' : '' }}"></span>{{ $duration }}</span><span>{{ $index === 0 ? '' : '0' }}</span></div>
                            @endforeach
                        </div>

                        <div class="filter-section">
                            <h3>Difficulty Level</h3>
                            @foreach (['Beginner', 'Intermediate', 'Advanced'] as $level)
                                <div class="filter-line"><span style="display:flex;align-items:center;gap:10px;"><span class="filter-check"></span>{{ $level }}</span><span>0</span></div>
                            @endforeach
                            <button class="btn btn-dark" style="width:100%;margin-top:18px;background:#fff;color:#06111f;border-color:#dbe4ee;" type="button">× Clear All Filters</button>
                        </div>
                    </aside>

                    <section>
                        <div class="library-main-head">
                            <span>226 Results Found</span>
                            <div class="view-toggle"><span>▦</span><span>☷</span></div>
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
                                <article class="library-card">
                                    <div class="library-thumb {{ $imageClass }}">
                                        @if ($duration)
                                            <span class="duration">{{ $duration }}</span>
                                            <span class="play-dot">▶</span>
                                        @endif
                                    </div>
                                    <div class="library-card-body">
                                        <span class="type-label {{ $labelClass }}">{{ $type }}</span>
                                        <h3>{{ $title }}</h3>
                                        <div class="mini-tags" style="margin-top:0;"><span>{{ $tagA }}</span><span>{{ $tagB }}</span></div>
                                        <div class="library-meta" style="margin-top:14px;"><span>{{ $date }}</span><span>•</span><span>{{ $meta }}</span><span style="margin-left:auto;">▱</span></div>
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
                                    ['Cognitive Biases', 24], ['Mindset', 18], ['Mental Models', 16], ['Productivity', 19],
                                    ['Human Behavior', 22], ['Philosophy', 15], ['Neuroscience', 12], ['Case Studies', 10],
                                    ['Emotional Intelligence', 8], ['Communication', 9], ['Habits', 12], ['Self Improvement', 14],
                                    ['Creativity', 7], ['Purpose & Meaning', 6], ['Relationships', 8],
                                ] as [$topic, $count])
                                    <div class="topic-mini"><span>{{ $topic }}</span><span class="count-pill">{{ $count }}</span></div>
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
                                <div class="resource-sketch"></div>
                            </div>
                        </section>

                        <section class="side-card">
                            <h3>Stay Updated</h3>
                            <p class="copy" style="font-size:13px;margin-top:8px;">Get new insights and resources straight to your inbox.</p>
                            <input style="width:100%;height:44px;margin-top:16px;border:1px solid #dbe4ee;border-radius:7px;padding:0 12px;" type="email" placeholder="Enter your email">
                            <button class="btn btn-primary" style="width:100%;margin-top:12px;" type="button">Subscribe</button>
                            <p class="copy" style="font-size:12px;margin-top:16px;">Join 25,000+ learners</p>
                        </section>
                    </aside>
                </div>
            </div>
        </section>
    </main>
@endsection
