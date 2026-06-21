@extends('life-decode.layout')

@section('title', 'Tool Categories - Life Decode')

@section('content')
    <main>
        <section class="section">
            <div class="shell">
                <div class="section-head" style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;">
                    <div>
                        <p class="eyebrow" style="margin-bottom:8px;">Tools & Resources</p>
                        <h1 class="section-title" style="margin-bottom:0;">{{ $categorySection?->title ?? 'Browse by Category' }}</h1>
                    </div>
                    <a class="link-blue" href="{{ route('life-decode.tools') }}#tool-categories">
                        Back to Tools
                        <svg style="display:inline-block;vertical-align:-4px" width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M19 12H5m6-6-6 6 6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                </div>

                <div class="soft-grid">
                    @forelse ($categorySection?->items ?? collect() as $item)
                        <article class="resource-card category-soft">
                            <span class="icon-tile {{ $item->style_class }}">{{ $item->icon_text }}</span>
                            <h3>{{ $item->title }}</h3>
                            @if ($item->meta_one)
                                <p><strong class="cat-count">{{ $item->meta_one }}</strong></p>
                            @endif
                            <p>{{ $item->description }}</p>
                        </article>
                    @empty
                        <article class="resource-card">
                            <h3>No categories found</h3>
                            <p>Tool categories will appear here after they are added from the dashboard.</p>
                        </article>
                    @endforelse
                </div>
            </div>
        </section>
    </main>
@endsection
