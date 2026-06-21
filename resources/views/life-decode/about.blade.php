@extends('life-decode.layout')

@section('title', 'About Life Decode - Decode life. Live amplified.')

@section('content')
    <main>
        <section class="page-hero">
            <div class="shell about-hero">
                <div>
                    <p class="eyebrow">{{ $aboutPage->eyebrow }}</p>
                    <h1>{{ $aboutPage->title_line_one }} <span class="gold">{{ $aboutPage->title_line_two }}</span></h1>
                    <p class="lead">{{ $aboutPage->hero_description }}</p>

                    <div class="hero-metrics">
                        @foreach ($aboutPage->metrics as $metric)
                            <div class="hero-metric">
                                <span class="round-icon gold-icon" style="margin-bottom:8px;">{{ $metric->icon_text }}</span>
                                <b>{{ $metric->value }}</b><span>{{ $metric->label }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="about-hero-art" style="background-image:url('{{ $aboutPage->heroImageUrl() }}');" role="img" aria-label="Life Decode creator portrait"></div>
            </div>
        </section>

        <section class="section">
            <div class="shell split">
                <div>
                    <h2 class="section-title">{{ $aboutPage->mission_title }}</h2>
                    <p class="copy">{{ $aboutPage->mission_description }}</p>

                    <div class="mission-grid">
                        @foreach ($aboutPage->missionItems as $item)
                            <div class="mini-card">
                                <span class="round-icon {{ $item->is_gold ? 'gold-icon' : '' }}">{{ $item->icon_text }}</span>
                                <div>
                                    <b>{{ $item->title }}</b>
                                    <p>{{ $item->description }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div>
                    <h2 class="section-title">{{ $aboutPage->creator_title }}</h2>
                    <p class="copy">{{ $aboutPage->creator_intro }}</p>
                    <p class="copy" style="margin-top:16px;">{{ $aboutPage->creator_body_one }}</p>
                    <p class="copy" style="margin-top:16px;">{{ $aboutPage->creator_body_two }}</p>
                    <div class="signature">{{ $aboutPage->creator_signature }}</div>
                    <p class="copy">{{ $aboutPage->creator_role }}</p>
                </div>

                <div class="creator-photo">
                    <img src="{{ $aboutPage->creatorImageUrl() }}" alt="{{ $aboutPage->creator_title }}">
                </div>
            </div>
        </section>

        <section class="section" style="padding-top:0;">
            <div class="shell approach">
                <div>
                    <h2 class="section-title">{{ $aboutPage->credentials_title }}</h2>
                    <p class="copy">{{ $aboutPage->credentials_description }}</p>
                    <div class="check-list">
                        @foreach ($aboutPage->approachItems->where('type', 'check') as $item)
                            <span>{{ $item->title }}</span>
                        @endforeach
                    </div>
                </div>

                <div class="process">
                    @foreach ($aboutPage->approachItems->where('type', 'process') as $item)
                        <article class="process-card">
                            <span class="round-icon">{{ $item->icon_text }}</span>
                            <h3>{{ $item->title }}</h3>
                            <p>{{ $item->description }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="section" style="padding-top:0;">
            <div class="shell">
                <div class="center-head">
                    <h2>{{ $aboutPage->social_title }}</h2>
                </div>

                <div class="social-grid">
                    @foreach ($aboutPage->socialLinks as $link)
                        <a class="social-card" href="{{ $link->url }}">
                            <span class="round-icon {{ $link->is_gold ? 'gold-icon' : '' }}">{{ $link->icon_text }}</span>
                            <span><b>{{ $link->platform }}</b>{{ $link->handle }}</span>
                        </a>
                    @endforeach
                </div>

                <div class="journey">
                    <div>
                        <h2 class="section-title">{{ $aboutPage->journey_title }}</h2>
                        <p class="copy">{{ $aboutPage->journey_description }}</p>
                        <a class="btn btn-dark" style="margin-top:22px;background:#06111f;" href="{{ $aboutPage->journey_button_url }}">{{ $aboutPage->journey_button_text }}</a>
                    </div>

                    <div class="timeline">
                        @foreach ($aboutPage->journeyItems as $item)
                            <div class="time-item">
                                <span class="round-icon {{ $item->is_gold ? 'gold-icon' : '' }}">{{ $item->icon_text }}</span>
                                <b>{{ $item->period }}@if ($item->headline)<br>{{ $item->headline }}@endif</b>
                                <p>{{ $item->description }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="quote-strip" style="margin-top:24px;">
                    <span><span class="gold">"</span> {{ $aboutPage->quote_text }}</span>
                    <small>- {{ $aboutPage->quote_author }}</small>
                </div>
            </div>
        </section>
    </main>
@endsection
