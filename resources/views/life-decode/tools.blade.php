@extends('life-decode.layout')

@section('title', 'Tools - Life Decode')

@section('content')
    <main>
        <section class="page-hero tools-hero">
            <div class="shell tools-hero-inner">
                <p class="eyebrow">Tools & Resources</p>
                <h1>Practical tools. <span class="gold">Real transformation.</span></h1>
                <p class="lead">Hand-picked frameworks, worksheets, and checklists to help you understand better, decide smarter, and live with more clarity and purpose.</p>

                <div class="tools-points">
                    <div class="tool-point"><span class="round-icon">F</span>Science-backed frameworks</div>
                    <div class="tool-point"><span class="round-icon">T</span>Simple & actionable tools</div>
                    <div class="tool-point"><span class="round-icon">D</span>Designed for daily application</div>
                    <div class="tool-point"><span class="round-icon">M</span>Improve your mind and behavior</div>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="shell">
                <div class="section-head" style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
                    <h2 class="section-title" style="margin-bottom:0;">Popular Tools</h2>
                    <a class="link-blue" href="#">View All Tools
                        <svg style="display:inline-block;vertical-align:-4px" width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M5 12h14m-6-6 6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                </div>

                <div class="soft-grid">
                    @foreach ([
                        ['Daily Mind Audit', 'Reflect on your thoughts, emotions, and actions every day.', 'A', 'gold-bg'],
                        ['Cognitive Bias Cheat Sheet', 'Identify and avoid the hidden biases that control your decisions.', 'B', ''],
                        ['Focus & Distract Tracker', 'Track your focus, eliminate distractions, and build deep work habits.', 'F', 'green-bg'],
                        ['Habit Building Template', 'Build better habits with this simple step-by-step tracking system.', 'H', 'purple-bg'],
                        ['Emotional Intelligence Worksheet', 'Improve self-awareness, empathy, and emotional control.', 'E', 'pink-bg'],
                        ['Life Direction Framework', 'Clarify your goals, values, and next steps in life.', 'L', 'gold-bg'],
                    ] as [$title, $copy, $icon, $class])
                        <article class="resource-card">
                            <span class="icon-tile {{ $class }}">{{ $icon }}</span>
                            <h3>{{ $title }}</h3>
                            <p>{{ $copy }}</p>
                            <a href="#">Download
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M12 3v12m0 0 4-4m-4 4-4-4M5 21h14" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </a>
                        </article>
                    @endforeach
                </div>

                <h2 class="section-title" style="margin-top:36px;">Browse by Category</h2>
                <div class="soft-grid">
                    @foreach ([
                        ['Cognitive Tools', '12 Tools', 'Understand your mind and thinking patterns.', 'C', ''],
                        ['Mindset & Growth', '15 Tools', 'Build a growth mindset and mental resilience.', 'M', 'green-bg'],
                        ['Focus & Productivity', '14 Tools', 'Improve focus, time management and productivity.', 'F', ''],
                        ['Behavior Change', '10 Tools', 'Tools to build better habits and break bad ones.', 'B', 'green-bg'],
                        ['Emotional Intelligence', '9 Tools', 'Develop emotional awareness and strong relationships.', 'E', 'pink-bg'],
                        ['Life Design', '8 Tools', 'Design a meaningful life aligned with your values.', 'L', 'gold-bg'],
                    ] as [$title, $count, $copy, $icon, $class])
                        <article class="resource-card category-soft">
                            <span class="icon-tile {{ $class }}">{{ $icon }}</span>
                            <h3>{{ $title }}</h3>
                            <p><strong style="color:#334155;">{{ $count }}</strong></p>
                            <p>{{ $copy }}</p>
                        </article>
                    @endforeach
                </div>
                <div style="margin-top:20px;text-align:center;">
                    <a class="btn btn-dark" style="background:#fff;color:#06111f;border-color:#dbe4ee;" href="#">View All Categories
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M5 12h14m-6-6 6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                </div>

                <div class="section-head" style="display:flex;justify-content:space-between;align-items:center;margin:34px 0 18px;">
                    <h2 class="section-title" style="margin-bottom:0;">Featured Toolkits</h2>
                    <a class="link-blue" href="#">View All Toolkits
                        <svg style="display:inline-block;vertical-align:-4px" width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M5 12h14m-6-6 6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                </div>

                <div class="toolkit-grid">
                    @foreach ([
                        ['The Mental Clarity Toolkit', 'A complete system to clear mental noise, reduce overthinking, and think with clarity.', '5 Frameworks', '8 Worksheets', '3 Checklists', ''],
                        ['The Self Improvement Toolkit', 'Practical tools to upgrade your habits, mindset, and daily actions.', '6 Frameworks', '10 Worksheets', '4 Checklists', 'green-img'],
                        ['The Life Design Toolkit', 'Align your goals, values, purpose and build a life you truly want.', '4 Frameworks', '6 Worksheets', '2 Checklists', 'purple-img'],
                    ] as [$title, $copy, $a, $b, $c, $imageClass])
                        <article class="toolkit-card">
                            <div class="toolkit-img {{ $imageClass }}"></div>
                            <div class="toolkit-body">
                                <h3>{{ $title }}</h3>
                                <p>{{ $copy }}</p>
                                <div class="mini-tags"><span>{{ $a }}</span><span>{{ $b }}</span><span>{{ $c }}</span></div>
                                <a class="toolkit-link" href="#">Explore Toolkit
                                    <svg style="display:inline-block;vertical-align:-4px" width="15" height="15" viewBox="0 0 24 24" fill="none"><path d="M5 12h14m-6-6 6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="how-strip">
                    @foreach ([
                        ['1', 'Choose a tool', 'Pick a tool that matches your current challenge or goal.', 'S'],
                        ['2', 'Download & review', 'Download the resource and go through the instructions.', 'D'],
                        ['3', 'Take action', 'Apply the framework in your daily life consistently.', 'A'],
                        ['4', 'Track & improve', 'Review your progress and refine your approach.', 'T'],
                    ] as [$num, $title, $copy, $icon])
                        <div class="how-step">
                            <span class="round-icon gold-icon" style="width:64px;height:64px;">{{ $icon }}</span>
                            <div><span class="step-num">{{ $num }}</span><b>{{ $title }}</b><p>{{ $copy }}</p></div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </main>
@endsection
