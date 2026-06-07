@extends('life-decode.layout')

@section('title', 'Community - Life Decode')

@section('content')
    <main>
        <section class="page-hero community-hero">
            <div class="shell community-hero-inner">
                <div>
                    <p class="eyebrow">Community</p>
                    <h1>You're not alone on this <span class="gold">journey.</span></h1>
                    <p class="lead">A supportive space to learn, share, grow and become the best version of yourself.</p>

                    <div class="community-actions">
                        <a class="btn btn-primary" href="#new-post">Introduce Yourself
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M7 11v8a2 2 0 0 0 2 2h7a4 4 0 0 0 4-4v-4a2 2 0 0 0-2-2h-5l1-5a2 2 0 0 0-2-2l-5 7Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </a>
                        <a class="btn btn-dark" href="#guidelines">Community Guidelines
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/></svg>
                        </a>
                    </div>
                </div>

                <div class="community-stats" aria-label="Community stats">
                    <div class="community-stat">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2m14-10a4 4 0 1 0 0-8M9 11a4 4 0 1 0 0-8m13 18v-2a4 4 0 0 0-3-3.87" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                        <b>8,642</b><span>Members</span>
                    </div>
                    <div class="community-stat">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none"><path d="M21 15a4 4 0 0 1-4 4H8l-5 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4v8Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/></svg>
                        <b>1,245</b><span>Discussions</span>
                    </div>
                    <div class="community-stat">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20M4 4.5A2.5 2.5 0 0 1 6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/></svg>
                        <b>423</b><span>Resources Shared</span>
                    </div>
                    <div class="community-stat">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none"><path d="M12 20a8 8 0 1 0-8-8m8 4a4 4 0 1 0-4-4m4 0 8-8m-3 0h3v3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        <b>2,108</b><span>Goals Achieved</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="shell">
                <div class="community-nav">
                    <nav class="community-tabs" aria-label="Community sections">
                        <a class="community-tab active" href="#"><svg width="17" height="17" viewBox="0 0 24 24" fill="none"><path d="M4 5h16v12H5l-1 2V5Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/></svg>Community Feed</a>
                        <a class="community-tab" href="#"><svg width="17" height="17" viewBox="0 0 24 24" fill="none"><path d="M21 15a4 4 0 0 1-4 4H8l-5 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4v8Z" stroke="currentColor" stroke-width="2"/></svg>Discussions</a>
                        <a class="community-tab" href="#"><svg width="17" height="17" viewBox="0 0 24 24" fill="none"><path d="m12 2 2.8 6 6.2.7-4.6 4.4 1.2 6.2L12 16.2 6.4 19.3l1.2-6.2L3 8.7 9.2 8 12 2Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/></svg>Wins & Stories</a>
                        <a class="community-tab" href="#"><svg width="17" height="17" viewBox="0 0 24 24" fill="none"><path d="M8 19a4 4 0 0 1 8 0M2 19a4 4 0 0 1 6-3.46M16 15.54A4 4 0 0 1 22 19M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>Study Groups</a>
                        <a class="community-tab" href="#"><svg width="17" height="17" viewBox="0 0 24 24" fill="none"><path d="M8 2v4m8-4v4M3 10h18M5 4h14a2 2 0 0 1 2 2v13a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>Events</a>
                    </nav>
                    <a class="btn btn-dark" style="background:#06111f;" href="#new-post">+ New Post</a>
                </div>

                <div class="community-layout">
                    <div>
                        <section class="panel">
                            <div class="panel-head">
                                <div>
                                    <h2>Community Feed</h2>
                                    <p>Real conversations. Real people. Real growth.</p>
                                </div>
                                <button class="select-pill" type="button">Latest ˅</button>
                            </div>

                            @foreach ([
                                ['AM', 'Arjun Mehta', 'New Member', '2h ago', 'How understanding cognitive biases changed my decisions', 'After learning about confirmation bias, I started noticing how often I filtered information. It has completely changed the way I think and decide.', 'Cognitive Biases', '24', '89', ''],
                                ['PS', 'Priya Sharma', 'Member', '5h ago', 'Day 21 of my 30-day focus challenge 💪', 'Eliminated social media in the mornings and my productivity has never been better. Consistency is everything!', 'Focus & Productivity', '18', '76', 'green-badge'],
                                ['RV', 'Rohit Verma', 'Top Contributor', '1d ago', 'The one mindset shift that helped me overcome overthinking', 'Realized I can control every outcome. Focusing on what I can control brought me so much peace.', 'Mindset', '31', '104', 'gold-badge'],
                                ['SI', 'Sneha Iyer', 'New Member', '2d ago', 'Grateful for this community 🙏', 'This space is so inspiring. Reading everyone’s stories keeps me motivated to keep improving every day.', 'Community Love', '12', '58', 'pink-badge'],
                            ] as [$avatar, $name, $badge, $time, $title, $body, $tag, $comments, $likes, $badgeClass])
                                <article class="post">
                                    <span class="avatar-img">{{ $avatar }}</span>
                                    <div>
                                        <div class="post-meta">
                                            <b>{{ $name }}</b>
                                            <span class="badge {{ $badge === 'Top Contributor' ? 'gold-badge' : '' }}">{{ $badge }}</span>
                                            <span>{{ $time }}</span>
                                        </div>
                                        <h3>{{ $title }}</h3>
                                        <p>{{ $body }}</p>
                                        <div class="post-actions">
                                            <span class="badge {{ $badgeClass }}">{{ $tag }}</span>
                                            <div><span>♡ {{ $likes }}</span><span>◌ {{ $comments }}</span><span>▱</span></div>
                                        </div>
                                    </div>
                                </article>
                            @endforeach

                            <div class="share-box" id="new-post">
                                <div style="display:flex;align-items:center;gap:16px;">
                                    <span class="round-icon" style="background:#06111f;color:#fff;">✎</span>
                                    <strong>Share your thoughts, ask questions,<br>or start a meaningful discussion.</strong>
                                </div>
                                <button class="btn btn-dark" style="background:#06111f;" type="button">Create a Post</button>
                            </div>
                        </section>

                        <section class="category-row">
                            <h2 class="section-title">Explore Discussion Categories</h2>
                            <p class="copy">Browse topics and join conversations that matter.</p>
                            <div class="category-grid">
                                @foreach ([
                                    ['Cognitive Biases', 'Discuss how biases influence our daily decisions.', '324 discussions', 'B', ''],
                                    ['Mindset & Growth', 'Share mindset shifts, habits and personal growth journeys.', '278 discussions', 'M', 'green-badge'],
                                    ['Focus & Productivity', 'Tips, tools and systems to help you stay focused.', '262 discussions', 'F', ''],
                                    ['Wins & Stories', 'Celebrate wins and inspire others with your story.', '191 discussions', 'W', 'pink-badge'],
                                    ['General Talk', 'Connect, ask questions and have meaningful conversations.', '154 discussions', 'G', 'gold-badge'],
                                ] as [$title, $copy, $count, $icon, $class])
                                    <article class="category-card">
                                        <span class="round-icon {{ str_contains($class, 'gold') ? 'gold-icon' : '' }}">{{ $icon }}</span>
                                        <h3>{{ $title }}</h3>
                                        <p>{{ $copy }}</p>
                                        <a href="#">{{ $count }}</a>
                                    </article>
                                @endforeach
                            </div>
                            <div style="margin-top:20px;text-align:center;">
                                <a class="btn btn-dark" style="background:#fff;color:#06111f;border-color:#dbe4ee;" href="#">View All Categories
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M5 12h14m-6-6 6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </a>
                            </div>
                        </section>
                    </div>

                    <aside class="sidebar">
                        <section class="side-card">
                            <div class="side-head"><h3>Member Spotlight</h3><a class="link-blue" href="#">See all</a></div>
                            <div class="spotlight">
                                <span class="avatar-img">KP</span>
                                <div>
                                    <b>Karan Patel</b>
                                    <span class="badge gold-badge" style="margin-left:8px;">Top Contributor</span>
                                    <p class="copy" style="font-size:13px;margin-top:8px;">Helping others level up their mindset and build better habits.</p>
                                </div>
                            </div>
                            <div class="mini-stats">
                                <div><b>128</b><span>Posts</span></div>
                                <div><b>250</b><span>Helpful Replies</span></div>
                                <div><b>45</b><span>Resources Shared</span></div>
                            </div>
                        </section>

                        <section class="side-card">
                            <div class="side-head"><h3>Active Now</h3><a class="link-blue" href="#">See all</a></div>
                            <div class="online-row">
                                @foreach (['A', 'P', 'R', 'S', 'K', 'M'] as $member)
                                    <span class="avatar-img">{{ $member }}</span>
                                @endforeach
                            </div>
                            <p class="copy" style="font-size:13px;">156 members online</p>
                        </section>

                        <section class="side-card">
                            <div class="side-head"><h3>Upcoming Events</h3><a class="link-blue" href="#">See all</a></div>
                            <div class="event-list">
                                @foreach ([
                                    ['Live Q&A with Life Decode', 'May 18, 2024  ·  7:00 PM IST', 'Ask questions. Get clarity. Grow together.'],
                                    ['Focus & Deep Work Challenge', 'May 20 - May 26, 2024', 'Join the 7-day challenge and build unbreakable focus.'],
                                    ['Community Accountability Call', 'May 25, 2024  ·  7:00 PM IST', 'Weekly check-in and goal update.'],
                                ] as [$title, $date, $copy])
                                    <article class="event-item">
                                        <span class="round-icon">▣</span>
                                        <div><b>{{ $title }}</b><p>{{ $date }}</p><p>{{ $copy }}</p></div>
                                    </article>
                                @endforeach
                            </div>
                            <a class="link-blue" style="display:inline-block;margin-top:18px;" href="#">View All Events
                                <svg style="display:inline-block;vertical-align:-4px" width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M5 12h14m-6-6 6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </a>
                        </section>

                        <section class="side-card" id="guidelines">
                            <h3 style="margin-bottom:14px;">Community Guidelines</h3>
                            <ul class="guidelines">
                                <li>Be respectful and kind</li>
                                <li>Share with honesty and authenticity</li>
                                <li>No self-promotion or spam</li>
                                <li>Protect privacy and confidentiality</li>
                                <li>Help elevate and support others</li>
                            </ul>
                            <a class="link-blue" style="display:inline-block;margin-top:18px;" href="#">Read full guidelines
                                <svg style="display:inline-block;vertical-align:-4px" width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M5 12h14m-6-6 6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </a>
                        </section>
                    </aside>
                </div>
            </div>
        </section>
    </main>
@endsection
