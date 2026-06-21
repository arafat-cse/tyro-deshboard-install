@extends('tyro-dashboard::layouts.admin')

@php
    $pageFields = [
        'eyebrow' => 'Hero Eyebrow',
        'title_line_one' => 'Hero Title Line One',
        'title_line_two' => 'Hero Gold Title',
        'hero_description' => 'Hero Description',
        'hero_image_path' => 'Hero Image Path',
        'mission_title' => 'Mission Title',
        'mission_description' => 'Mission Description',
        'creator_title' => 'Creator Title',
        'creator_intro' => 'Creator Intro',
        'creator_body_one' => 'Creator Body One',
        'creator_body_two' => 'Creator Body Two',
        'creator_signature' => 'Creator Signature',
        'creator_role' => 'Creator Role',
        'creator_image_path' => 'Creator Image Path',
        'credentials_title' => 'Credentials Title',
        'credentials_description' => 'Credentials Description',
        'social_title' => 'Social Title',
        'journey_title' => 'Journey Title',
        'journey_description' => 'Journey Description',
        'journey_button_text' => 'Journey Button Text',
        'journey_button_url' => 'Journey Button URL',
        'quote_text' => 'Quote Text',
        'quote_author' => 'Quote Author',
    ];

    $longFields = [
        'hero_description',
        'mission_description',
        'creator_intro',
        'creator_body_one',
        'creator_body_two',
        'credentials_description',
        'journey_description',
    ];

    $imageFields = [
        'hero_image_path' => ['input' => 'hero_image', 'label' => 'Replace Hero Image'],
        'creator_image_path' => ['input' => 'creator_image', 'label' => 'Replace Creator Image'],
    ];

    $sectionFields = [
        'about-hero' => ['eyebrow', 'title_line_one', 'title_line_two', 'hero_description', 'hero_image_path'],
        'our-mission' => ['mission_title', 'mission_description'],
        'the-creator' => ['creator_title', 'creator_intro', 'creator_body_one', 'creator_body_two', 'creator_signature', 'creator_role', 'creator_image_path'],
        'credentials-approach' => ['credentials_title', 'credentials_description'],
        'social-media' => ['social_title'],
        'our-journey' => ['journey_title', 'journey_description', 'journey_button_text', 'journey_button_url', 'quote_text', 'quote_author'],
    ];

    $groups = [
        'about-hero' => [
            'title' => 'Hero Metrics',
            'description' => 'Numbers below the about hero.',
            'items' => $aboutPage->metrics,
            'store' => route('dashboard.about-page.metrics.store'),
            'route' => 'dashboard.about-page.metrics.update',
            'destroy' => 'dashboard.about-page.metrics.destroy',
            'fields' => ['icon_text', 'value', 'label', 'sort_order', 'is_published'],
        ],
        'our-mission' => [
            'title' => 'Mission Cards',
            'description' => 'Cards shown under Our Mission.',
            'items' => $aboutPage->missionItems,
            'store' => route('dashboard.about-page.mission-items.store'),
            'route' => 'dashboard.about-page.mission-items.update',
            'destroy' => 'dashboard.about-page.mission-items.destroy',
            'fields' => ['icon_text', 'title', 'description', 'sort_order', 'is_gold', 'is_published'],
        ],
        'credentials-approach' => [
            'title' => 'Approach Items',
            'description' => 'Checklist rows and process cards.',
            'items' => $aboutPage->approachItems,
            'store' => route('dashboard.about-page.approach-items.store'),
            'route' => 'dashboard.about-page.approach-items.update',
            'destroy' => 'dashboard.about-page.approach-items.destroy',
            'fields' => ['type', 'icon_text', 'title', 'description', 'sort_order', 'is_published'],
        ],
        'social-media' => [
            'title' => 'Social Links',
            'description' => 'Platform cards with handles and links.',
            'items' => $aboutPage->socialLinks,
            'store' => route('dashboard.about-page.social-links.store'),
            'route' => 'dashboard.about-page.social-links.update',
            'destroy' => 'dashboard.about-page.social-links.destroy',
            'fields' => ['icon_text', 'platform', 'handle', 'url', 'sort_order', 'is_gold', 'is_published'],
        ],
        'our-journey' => [
            'title' => 'Journey Timeline',
            'description' => 'Timeline milestones shown near the bottom.',
            'items' => $aboutPage->journeyItems,
            'store' => route('dashboard.about-page.journey-items.store'),
            'route' => 'dashboard.about-page.journey-items.update',
            'destroy' => 'dashboard.about-page.journey-items.destroy',
            'fields' => ['icon_text', 'period', 'headline', 'description', 'sort_order', 'is_gold', 'is_published'],
        ],
    ];

    $fieldLabels = [
        'type' => 'Type',
        'icon_text' => 'Icon Text',
        'value' => 'Value',
        'label' => 'Label',
        'title' => 'Title',
        'description' => 'Description',
        'platform' => 'Platform',
        'handle' => 'Handle',
        'url' => 'URL',
        'period' => 'Period',
        'headline' => 'Headline',
        'sort_order' => 'Sort Order',
        'is_gold' => 'Gold Style',
        'is_published' => 'Published',
    ];

    $visiblePageFields = $sectionFields[$activeSection];
    $activeGroup = $groups[$activeSection] ?? null;
@endphp

@section('title', $sections[$activeSection])

@section('breadcrumb')
<a href="{{ route($dashboardRoute::name('index')) }}">Dashboard</a>
<span class="breadcrumb-separator">/</span>
<span>Resources</span>
<span class="breadcrumb-separator">/</span>
<span>About Management</span>
<span class="breadcrumb-separator">/</span>
<span>{{ $sections[$activeSection] }}</span>
@endsection

@push('styles')
<style>
    .about-admin-wrap {
        display: grid;
        gap: 1rem;
    }

    .about-topbar,
    .about-row {
        border: 1px solid var(--border);
        background: var(--background);
    }

    .about-topbar {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        padding: 1rem;
        border-radius: .75rem;
        background: linear-gradient(135deg, color-mix(in srgb, var(--primary) 6%, var(--background)), var(--background));
    }

    .about-section-tabs {
        display: flex;
        flex-wrap: wrap;
        gap: .5rem;
    }

    .about-section-tabs a {
        border: 1px solid var(--border);
        border-radius: .5rem;
        padding: .55rem .75rem;
        font-size: .8125rem;
        font-weight: 700;
    }

    .about-section-tabs a.active {
        border-color: var(--primary);
        background: var(--primary);
        color: var(--primary-foreground);
    }

    .muted-text {
        color: var(--muted-foreground);
        font-size: .8125rem;
    }

    .cms-form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 1rem;
    }

    .cms-field {
        display: grid;
        gap: .4rem;
    }

    .cms-field.full {
        grid-column: 1 / -1;
    }

    .cms-field label {
        font-size: .875rem;
        font-weight: 600;
    }

    .cms-field input,
    .cms-field select,
    .cms-field textarea {
        width: 100%;
        border: 1px solid var(--border);
        border-radius: .5rem;
        padding: .7rem .85rem;
        background: var(--background);
        color: var(--foreground);
    }

    .cms-field textarea {
        min-height: 104px;
        resize: vertical;
    }

    .cms-image-preview {
        overflow: hidden;
        width: min(100%, 280px);
        aspect-ratio: 16 / 10;
        border: 1px solid var(--border);
        border-radius: .5rem;
        background: rgba(148, 163, 184, .12);
    }

    .cms-image-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .cms-check {
        display: flex;
        gap: .5rem;
        align-items: center;
        min-height: 42px;
        font-weight: 600;
    }

    .cms-check input {
        width: auto;
    }

    .cms-actions,
    .row-actions {
        display: flex;
        flex-wrap: wrap;
        gap: .6rem;
        align-items: center;
    }

    .cms-actions {
        margin-top: 1rem;
    }

    .about-list {
        display: grid;
        gap: .65rem;
    }

    .about-row {
        overflow: hidden;
        border-radius: .65rem;
    }

    .about-row-main {
        display: grid;
        grid-template-columns: 1fr 130px 110px auto;
        gap: .85rem;
        align-items: center;
        padding: .9rem 1rem;
    }

    .about-row-title {
        display: grid;
        gap: .2rem;
        min-width: 0;
    }

    .about-row-title strong,
    .about-row-title span {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .about-panel {
        display: none;
        padding: 1rem;
        border-top: 1px solid var(--border);
        background: color-mix(in srgb, var(--background) 97%, var(--foreground));
    }

    .about-panel:target {
        display: block;
    }

    .pill {
        display: inline-flex;
        width: fit-content;
        min-height: 26px;
        align-items: center;
        border: 1px solid var(--border);
        border-radius: 999px;
        padding: 0 .6rem;
        background: rgba(148, 163, 184, .12);
        color: #64748b;
        font-size: .75rem;
        font-weight: 700;
    }

    .pill.success {
        border-color: rgba(34, 197, 94, .24);
        background: rgba(34, 197, 94, .1);
        color: #15803d;
    }

    .icon-action {
        display: inline-grid;
        width: 36px;
        height: 36px;
        place-items: center;
        border: 1px solid var(--border);
        border-radius: .5rem;
        background: var(--background);
        color: var(--foreground);
        cursor: pointer;
    }

    .icon-action.primary {
        border-color: var(--primary);
        background: var(--primary);
        color: var(--primary-foreground);
    }

    .icon-action.danger {
        color: #dc2626;
    }

    .icon-action svg {
        width: 17px;
        height: 17px;
    }

    @media (max-width: 960px) {
        .about-row-main,
        .cms-form-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<div class="about-admin-wrap">
    <div class="about-topbar">
        <div>
            <h1 class="page-title">{{ $sections[$activeSection] }}</h1>
            <p class="page-description" style="font-size:.95rem;">About Management section control.</p>
        </div>
        <a href="{{ route('life-decode.about') }}" target="_blank" class="btn btn-secondary">View Frontend</a>
    </div>

    <div class="about-section-tabs">
        @foreach ($sections as $sectionKey => $sectionLabel)
            <a class="{{ $activeSection === $sectionKey ? 'active' : '' }}" href="{{ route('dashboard.about-management.edit', $sectionKey) }}">{{ $sectionLabel }}</a>
        @endforeach
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul style="margin-left: 1rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title" style="font-size:1.0625rem;">{{ $sections[$activeSection] }} Content</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('dashboard.about-page.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @foreach ($pageFields as $name => $label)
                    @if (! in_array($name, $visiblePageFields, true))
                        <input type="hidden" name="{{ $name }}" value="{{ old($name, $aboutPage->{$name}) }}">
                    @endif
                @endforeach

                <div class="cms-form-grid">
                    @foreach ($visiblePageFields as $name)
                        <div class="cms-field {{ in_array($name, $longFields, true) ? 'full' : '' }}">
                            <label for="{{ $name }}">{{ $pageFields[$name] }}</label>
                            @if (array_key_exists($name, $imageFields))
                                <input type="hidden" name="{{ $name }}" value="{{ old($name, $aboutPage->{$name}) }}">
                                <div class="cms-image-preview">
                                    <img src="{{ $name === 'hero_image_path' ? $aboutPage->heroImageUrl() : $aboutPage->creatorImageUrl() }}" alt="{{ $pageFields[$name] }}">
                                </div>
                                <input id="{{ $imageFields[$name]['input'] }}" name="{{ $imageFields[$name]['input'] }}" type="file" accept="image/*">
                            @elseif (in_array($name, $longFields, true))
                                <textarea id="{{ $name }}" name="{{ $name }}" required>{{ old($name, $aboutPage->{$name}) }}</textarea>
                            @else
                                <input id="{{ $name }}" name="{{ $name }}" value="{{ old($name, $aboutPage->{$name}) }}" required>
                            @endif
                        </div>
                    @endforeach
                </div>

                <div class="cms-actions">
                    <button type="submit" class="btn btn-primary">Save {{ $sections[$activeSection] }}</button>
                </div>
            </form>
        </div>
    </div>

    @if ($activeGroup)
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="font-size:1.0625rem;">{{ $activeGroup['title'] }}</h3>
                <p class="muted-text">{{ $activeGroup['description'] }}</p>
            </div>
            <div class="card-body">
                <div class="about-row" style="margin-bottom:.75rem;">
                    <div class="about-row-main">
                        <div class="about-row-title">
                            <strong>Add new item</strong>
                            <span class="muted-text">{{ $activeGroup['description'] }}</span>
                        </div>
                        <span class="pill">New</span>
                        <span class="pill success">Ready</span>
                        <div class="row-actions">
                            <a href="#item-create" class="icon-action primary" title="Add item" aria-label="Add item">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14" /></svg>
                            </a>
                        </div>
                    </div>
                    <div class="about-panel" id="item-create">
                        <form method="POST" action="{{ $activeGroup['store'] }}">
                            @csrf
                            <div class="cms-form-grid">
                                @foreach ($activeGroup['fields'] as $field)
                                    @include('dashboard.partials.about-field', ['field' => $field, 'label' => $fieldLabels[$field], 'item' => null])
                                @endforeach
                            </div>
                            <div class="cms-actions">
                                <button type="submit" class="btn btn-primary">Create Item</button>
                                <a href="#" class="icon-action" title="Cancel" aria-label="Cancel">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="about-list">
                    @forelse ($activeGroup['items'] as $item)
                        <div class="about-row">
                            <div class="about-row-main">
                                <div class="about-row-title">
                                    <strong>{{ $item->title ?? $item->platform ?? $item->value ?? $item->period }}</strong>
                                    <span class="muted-text">{{ $item->description ?? $item->handle ?? $item->label ?? $item->headline ?? 'No extra text' }}</span>
                                </div>
                                <span class="pill">{{ $item->sort_order }}</span>
                                <span class="pill {{ $item->is_published ? 'success' : '' }}">{{ $item->is_published ? 'Published' : 'Draft' }}</span>
                                <div class="row-actions">
                                    <a href="#item-edit-{{ $item->id }}" class="icon-action primary" title="Edit item" aria-label="Edit item">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 20h9" /><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5Z" /></svg>
                                    </a>
                                    <form id="delete-item-{{ $item->id }}" method="POST" action="{{ route($activeGroup['destroy'], $item) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="icon-action danger" title="Delete item" aria-label="Delete item" data-confirm-delete data-delete-form="delete-item-{{ $item->id }}" data-delete-title="Delete Item" data-delete-message="Delete this item? This action cannot be undone." data-delete-confirm="Delete Item">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 6h18M8 6V4h8v2m-9 0 1 14h8l1-14M10 11v6M14 11v6" /></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <div class="about-panel" id="item-edit-{{ $item->id }}">
                                <form method="POST" action="{{ route($activeGroup['route'], $item) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="cms-form-grid">
                                        @foreach ($activeGroup['fields'] as $field)
                                            @include('dashboard.partials.about-field', ['field' => $field, 'label' => $fieldLabels[$field], 'item' => $item])
                                        @endforeach
                                    </div>
                                    <div class="cms-actions">
                                        <button type="submit" class="btn btn-primary">Update Item</button>
                                        <a href="#" class="icon-action" title="Cancel" aria-label="Cancel">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="muted-text">No items yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
