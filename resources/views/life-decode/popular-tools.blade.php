@extends('life-decode.layout')

@section('title', 'Popular Tools - Life Decode')

@section('content')
    <main>
        <section class="section">
            <div class="shell">
                <div class="section-head" style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;">
                    <div>
                        <p class="eyebrow" style="margin-bottom:8px;">Tools & Resources</p>
                        <h1 class="section-title" style="margin-bottom:0;">{{ $popularSection?->title ?? 'Popular Tools' }}</h1>
                    </div>
                    <a class="link-blue" href="{{ route('life-decode.tools') }}#popular-tools">
                        Back to Tools
                        <svg style="display:inline-block;vertical-align:-4px" width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M19 12H5m6-6-6 6 6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                </div>

                <div class="soft-grid">
                    @forelse ($popularSection?->items ?? collect() as $item)
                        <article class="resource-card">
                            <span class="icon-tile {{ $item->style_class }}">{{ $item->icon_text }}</span>
                            <h3>{{ $item->title }}</h3>
                            <p>{{ $item->description }}</p>
                            @if ($item->button_text)
                                <a href="{{ $item->button_url ?? '#' }}">{{ $item->button_text }}
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M12 3v12m0 0 4-4m-4 4-4-4M5 21h14" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </a>
                            @endif
                        </article>
                    @empty
                        <article class="resource-card">
                            <h3>No tools found</h3>
                            <p>Popular tools will appear here after they are added from the dashboard.</p>
                        </article>
                    @endforelse
                </div>
            </div>
        </section>
    </main>
@endsection
