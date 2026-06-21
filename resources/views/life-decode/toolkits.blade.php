@extends('life-decode.layout')

@section('title', 'Toolkits - Life Decode')

@section('content')
    <main>
        <section class="section">
            <div class="shell">
                <div class="section-head" style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;">
                    <div>
                        <p class="eyebrow" style="margin-bottom:8px;">Tools & Resources</p>
                        <h1 class="section-title" style="margin-bottom:0;">{{ $toolkitSection?->title ?? 'Featured Toolkits' }}</h1>
                    </div>
                    <a class="link-blue" href="{{ route('life-decode.tools') }}#toolkits">
                        Back to Tools
                        <svg style="display:inline-block;vertical-align:-4px" width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M19 12H5m6-6-6 6 6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                </div>

                <div class="toolkit-grid">
                    @forelse ($toolkitSection?->items ?? collect() as $item)
                        <article class="toolkit-card">
                            <div class="toolkit-img {{ $item->image_url ? 'uploaded-img' : $item->style_class }}" @if ($item->image_url) style="background-image: linear-gradient(90deg, rgba(6, 17, 31, .34), rgba(6, 17, 31, .08)), url('{{ $item->image_url }}');" @endif></div>
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
                    @empty
                        <article class="toolkit-card">
                            <div class="toolkit-body">
                                <h3>No toolkits found</h3>
                                <p>Toolkits will appear here after they are added from the dashboard.</p>
                            </div>
                        </article>
                    @endforelse
                </div>
            </div>
        </section>
    </main>
@endsection
