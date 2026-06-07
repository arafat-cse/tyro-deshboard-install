@extends('life-decode.layout')

@section('title', 'Library - Life Decode')

@section('content')
    <main>
        <section class="placeholder-hero">
            <div class="shell">
                <p class="eyebrow">Life Decode Library</p>
                <h1 style="font-size:clamp(42px,5vw,70px);line-height:1.08;font-weight:900;">Explore psychology, mindset, and life systems.</h1>
                <p class="lead">A growing library of practical guides for clearer thinking, better decisions, and more intentional living.</p>
            </div>
        </section>

        <section class="section">
            <div class="shell placeholder-grid">
                @foreach ([
                    ['Cognitive Biases', 'Mental shortcuts that shape decisions.'],
                    ['Mindset', 'Build resilience, confidence, and clarity.'],
                    ['Mental Models', 'Frameworks for smarter thinking.'],
                    ['Human Behavior', 'Decode emotions, habits, and social patterns.'],
                    ['Productivity', 'Focus systems for deep work and progress.'],
                    ['Philosophy', 'Timeless wisdom for modern life.'],
                ] as [$title, $copy])
                    <article class="placeholder-card">
                        <span class="round-icon gold-icon">{{ substr($title, 0, 1) }}</span>
                        <h3 style="margin-top:18px;">{{ $title }}</h3>
                        <p>{{ $copy }}</p>
                    </article>
                @endforeach
            </div>
        </section>
    </main>
@endsection
