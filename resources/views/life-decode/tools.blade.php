@extends('life-decode.layout')

@section('title', 'Tools - Life Decode')

@section('content')
    <main>
        <section class="page-hero tools-hero">
            <div class="shell tools-hero-inner">
                <p class="eyebrow">{{ $toolPage?->eyebrow ?? 'Tools & Resources' }}</p>
                <h1>{{ $toolPage?->title_line_one ?? 'Practical tools.' }} <span class="gold">{{ $toolPage?->title_line_two ?? 'Real transformation.' }}</span></h1>
                <p class="lead">{{ $toolPage?->description ?? 'Hand-picked frameworks, worksheets, and checklists to help you understand better, decide smarter, and live with more clarity and purpose.' }}</p>

                <div class="tools-points">
                    @foreach ($heroPoints as $point)
                        <div class="tool-point"><span class="round-icon">{{ $point->icon_text }}</span>{{ $point->title }}</div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="section">
            <div class="shell">
                @foreach ($contentSections as $section)
                    @if ($section->type === 'tool_cards')
                        <div class="section-head" style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
                            <h2 class="section-title" style="margin-bottom:0;">{{ $section->title }}</h2>
                            @if ($section->button_text)
                                <a class="link-blue" href="{{ $section->button_url ?? '#' }}">{{ $section->button_text }}
                                    <svg style="display:inline-block;vertical-align:-4px" width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M5 12h14m-6-6 6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </a>
                            @endif
                        </div>

                        <div class="soft-grid">
                            @foreach ($section->items as $item)
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
                            @endforeach
                        </div>
                    @elseif ($section->type === 'categories')
                        <h2 class="section-title" style="margin-top:36px;">{{ $section->title }}</h2>
                        <div class="soft-grid">
                            @foreach ($section->items as $item)
                                <article class="resource-card category-soft">
                                    <span class="icon-tile {{ $item->style_class }}">{{ $item->icon_text }}</span>
                                    <h3>{{ $item->title }}</h3>
                                    @if ($item->meta_one)
                                        <p><strong class="cat-count">{{ $item->meta_one }}</strong></p>
                                    @endif
                                    <p>{{ $item->description }}</p>
                                </article>
                            @endforeach
                        </div>
                        @if ($section->button_text)
                            <div style="margin-top:20px;text-align:center;">
                                <a class="btn btn-dark tools-view-all-btn" href="{{ $section->button_url ?? '#' }}">{{ $section->button_text }}
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M5 12h14m-6-6 6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </a>
                            </div>
                        @endif
                    @elseif ($section->type === 'toolkits')
                        <div class="section-head" style="display:flex;justify-content:space-between;align-items:center;margin:34px 0 18px;">
                            <h2 class="section-title" style="margin-bottom:0;">{{ $section->title }}</h2>
                            @if ($section->button_text)
                                <a class="link-blue" href="{{ $section->button_url ?? '#' }}">{{ $section->button_text }}
                                    <svg style="display:inline-block;vertical-align:-4px" width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M5 12h14m-6-6 6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </a>
                            @endif
                        </div>

                        <div class="toolkit-grid">
                            @foreach ($section->items as $item)
                                <article class="toolkit-card">
                                    <div class="toolkit-img {{ $item->style_class }}"></div>
                                    <div class="toolkit-body">
                                        <h3>{{ $item->title }}</h3>
                                        <p>{{ $item->description }}</p>
                                        <div class="mini-tags">
                                            @foreach ([$item->meta_one, $item->meta_two, $item->meta_three] as $tag)
                                                @if ($tag)
                                                    <span>{{ $tag }}</span>
                                                @endif
                                            @endforeach
                                        </div>
                                        @if ($item->button_text)
                                            <a class="toolkit-link" href="{{ $item->button_url ?? '#' }}">{{ $item->button_text }}
                                                <svg style="display:inline-block;vertical-align:-4px" width="15" height="15" viewBox="0 0 24 24" fill="none"><path d="M5 12h14m-6-6 6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                            </a>
                                        @endif
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    @elseif ($section->type === 'how_steps')
                        <div class="how-strip">
                            @foreach ($section->items as $item)
                                <div class="how-step">
                                    <span class="round-icon gold-icon" style="width:64px;height:64px;">{{ $item->icon_text }}</span>
                                    <div><span class="step-num">{{ $item->meta_one }}</span><b>{{ $item->title }}</b><p>{{ $item->description }}</p></div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                @endforeach
            </div>
        </section>
    </main>
@endsection
