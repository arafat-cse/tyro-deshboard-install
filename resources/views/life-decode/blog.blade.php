@extends('life-decode.layout')

@section('title', 'Blog - Life Decode')

@section('content')
    <main>
        <section class="page-hero blog-hero">
            <div class="shell blog-hero-inner">
                <p class="eyebrow">Blog / Insights</p>
                <h1>Ideas. Insights. Decode Better.</h1>
                <p class="lead">Deep dives, frameworks, case studies, and practical lessons to help you understand the mind and live better.</p>
                <form class="search-box">
                    <input type="search" placeholder="Search articles..." aria-label="Search articles">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="m21 21-4.35-4.35M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15Z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                </form>
            </div>
        </section>

        <section class="section">
            <div class="shell">
                <nav class="blog-tabs" aria-label="Blog categories">
                    @foreach (['All Posts', 'Cognitive Biases', 'Mindset', 'Mental Models', 'Productivity', 'Human Behavior', 'Philosophy', 'Case Studies'] as $index => $tab)
                        <a class="{{ $index === 0 ? 'active' : '' }}" href="#"><span>{{ $index === 0 ? '' : substr($tab, 0, 1) }}</span>{{ $tab }}</a>
                    @endforeach
                </nav>

                <div class="blog-layout">
                    <div>
                        <h2 class="section-title">Featured Posts</h2>
                        <article class="featured-post">
                            <div class="post-image"></div>
                            <div class="featured-copy">
                                <span class="overline">Mental Models</span>
                                <h2>The Mental Models That Will Change the Way You Make Decisions</h2>
                                <p class="copy">A collection of timeless mental models to help you think clearer, decide better, and avoid common traps.</p>
                                <p class="copy" style="margin-top:14px;">May 16, 2024  ·  10 min read</p>
                                <a class="link-blue" style="display:inline-block;margin-top:10px;" href="#">Read More
                                    <svg style="display:inline-block;vertical-align:-4px" width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M5 12h14m-6-6 6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </a>
                            </div>
                        </article>

                        <div class="section-head" style="display:flex;align-items:center;justify-content:space-between;margin:30px 0 14px;">
                            <h2 class="section-title" style="margin-bottom:0;">All Posts</h2>
                            <button class="select-pill" type="button">Sort by: Latest ˅</button>
                        </div>

                        <div class="article-listing">
                            @foreach ([
                                ['Cognitive Biases', '10 Cognitive Biases That Are Secretly Controlling Your Decisions', 'Understand the hidden mental shortcuts that shape your choices, beliefs, and actions every single day.', 'May 15, 2024  ·  8 min read', 'bias-img'],
                                ['Mindset', 'Why Most People Never Achieve Their Goals (And How to Break the Cycle)', 'It is not about motivation. It is about identity, systems, and understanding how your mind really works.', 'May 12, 2024  ·  7 min read', 'mindset-img'],
                                ['Human Behavior', 'The Psychology of First Impressions: Why You Judge in Seconds', 'The science behind snap judgments and how to make better decisions about people and situations.', 'May 10, 2024  ·  6 min read', 'human-img'],
                                ['Productivity', 'Deep Work in a Distracted World: A Practical Guide', 'How to protect your focus, do meaningful work, and get more done in less time.', 'May 8, 2024  ·  9 min read', 'desk-img'],
                                ['Philosophy', 'Stoicism in Daily Life: Ancient Wisdom for Modern Problems', 'Timeless Stoic principles to help you stay calm, resilient, and focused no matter what.', 'May 5, 2024  ·  7 min read', 'philosophy-img'],
                                ['Case Study', 'How One Simple Habit Transformed My Thinking (A Real Case Study)', 'A personal experiment in changing one tiny habit that led to massive changes.', 'May 2, 2024  ·  6 min read', 'case-img'],
                            ] as [$category, $title, $copy, $meta, $imageClass])
                                <article class="article-row">
                                    <div class="article-thumb {{ $imageClass }}"></div>
                                    <div>
                                        <span class="overline" style="color:{{ $category === 'Mindset' ? '#d97706' : ($category === 'Human Behavior' ? '#059669' : ($category === 'Productivity' ? '#7e22ce' : ($category === 'Philosophy' ? '#ea580c' : 'var(--blue)'))) }};">{{ $category }}</span>
                                        <h3>{{ $title }}</h3>
                                        <p>{{ $copy }}</p>
                                        <small>{{ $meta }}</small>
                                    </div>
                                    <span style="color:#64748b;">▱</span>
                                </article>
                            @endforeach
                        </div>

                        <div class="pagination">
                            <a class="page-pill" href="#">‹ Prev</a>
                            <a class="page-pill active" href="#">1</a>
                            <a class="page-pill" href="#">2</a>
                            <a class="page-pill" href="#">3</a>
                            <a class="page-pill" href="#">...</a>
                            <a class="page-pill" href="#">10</a>
                            <a class="page-pill" href="#">Next ›</a>
                        </div>
                    </div>

                    <aside class="blog-side">
                        <section class="side-card">
                            <h3 class="section-title">About Life Decode Blog</h3>
                            <p class="copy">Welcome to the official blog of Life Decode. Here we break down complex ideas into simple insights you can apply in real life.</p>
                            <p class="copy" style="margin-top:16px;">New articles every week.</p>
                            <a class="btn btn-dark" style="width:100%;margin-top:20px;background:#06111f;" href="{{ route('life-decode.community') }}">Join the Community
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M5 12h14m-6-6 6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </a>
                        </section>

                        <section class="side-card">
                            <h3 class="section-title">Popular Topics</h3>
                            <div class="topic-list">
                                @foreach ([
                                    ['Cognitive Biases', 24],
                                    ['Mindset', 31],
                                    ['Mental Models', 18],
                                    ['Productivity', 22],
                                    ['Human Behavior', 26],
                                    ['Philosophy', 15],
                                    ['Case Studies', 12],
                                ] as [$topic, $count])
                                    <div class="topic-line"><span>{{ $topic }}</span><span class="count-pill">{{ $count }}</span></div>
                                @endforeach
                            </div>
                            <a class="link-blue" style="display:inline-block;margin-top:20px;" href="#">View all topics
                                <svg style="display:inline-block;vertical-align:-4px" width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M5 12h14m-6-6 6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </a>
                        </section>

                        <section class="side-card">
                            <h3 class="section-title">Popular Posts</h3>
                            <div class="event-list">
                                @foreach ([
                                    ['The Halo Effect: How It Affects Every Decision You Make', 'May 1, 2024'],
                                    ['The Reticular Activating System (RAS) Explained Simply', 'Apr 28, 2024'],
                                    ['Why Overthinking Is Destroying Your Peace', 'Apr 25, 2024'],
                                ] as [$title, $date])
                                    <article class="mini-post">
                                        <div class="mini-thumb"></div>
                                        <div><b>{{ $title }}</b><p class="copy" style="font-size:12px;">{{ $date }}</p></div>
                                    </article>
                                @endforeach
                            </div>
                        </section>

                        <section class="side-card">
                            <h3 class="section-title">Newsletter</h3>
                            <p class="copy">Get weekly insights on psychology, mindset, and personal growth.</p>
                            <input style="width:100%;height:44px;margin-top:16px;border:1px solid #dbe4ee;border-radius:7px;padding:0 12px;" type="email" placeholder="Enter your email">
                            <button class="btn btn-primary" style="width:100%;margin-top:12px;" type="button">Subscribe</button>
                            <p class="copy" style="font-size:12px;margin-top:16px;">Join 25,000+ readers</p>
                        </section>
                    </aside>
                </div>
            </div>
        </section>
    </main>
@endsection
