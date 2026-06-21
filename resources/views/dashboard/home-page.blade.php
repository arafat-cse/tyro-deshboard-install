@extends('tyro-dashboard::layouts.admin')

@section('title', $sections[$activeSection] . ' - Home Management')

@section('breadcrumb')
<a href="{{ route($dashboardRoute::name('index')) }}">Dashboard</a>
<span class="breadcrumb-separator">/</span>
<span>Resources</span>
<span class="breadcrumb-separator">/</span>
<span>Home Management</span>
<span class="breadcrumb-separator">/</span>
<span>{{ $sections[$activeSection] }}</span>
@endsection

@push('styles')
<style>
    .cms-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1rem;
    }

    .home-section-tabs {
        display: flex;
        flex-wrap: wrap;
        gap: .5rem;
        margin-bottom: 1rem;
    }

    .home-section-tabs a {
        border: 1px solid color-mix(in srgb, var(--border) 75%, transparent);
        border-radius: .5rem;
        padding: .5rem .72rem;
        background: var(--background);
        color: var(--muted-foreground);
        font-size: .8125rem;
        font-weight: 700;
    }

    .home-section-tabs a.active {
        border-color: var(--primary);
        background: var(--primary);
        color: var(--primary-foreground);
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
    .cms-field textarea {
        width: 100%;
        border: 1px solid var(--border);
        border-radius: .5rem;
        padding: .7rem .85rem;
        background: var(--background);
        color: var(--foreground);
    }

    .cms-field textarea {
        min-height: 110px;
        resize: vertical;
    }

    .content-row {
        overflow: hidden;
        border: 1px solid color-mix(in srgb, var(--border) 72%, transparent);
        border-radius: .55rem;
        background: var(--background);
    }

    .row-main {
        display: grid;
        grid-template-columns: 1fr 130px 110px auto;
        gap: .85rem;
        align-items: center;
        padding: .8rem 1rem;
    }

    .row-title {
        display: grid;
        gap: .2rem;
        min-width: 0;
    }

    .row-title strong,
    .row-title span {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .muted-text {
        color: var(--muted-foreground);
        font-size: .8125rem;
    }

    .row-panel {
        display: none;
        padding: 1rem;
        border-top: 1px solid color-mix(in srgb, var(--border) 72%, transparent);
        background: color-mix(in srgb, var(--background) 98%, var(--foreground));
    }

    .row-panel:target {
        display: block;
    }

    .panel-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: .75rem;
    }

    .panel-box {
        padding: .8rem;
        border: 1px solid color-mix(in srgb, var(--border) 72%, transparent);
        border-radius: .55rem;
        background: var(--background);
    }

    .panel-box.full {
        grid-column: 1 / -1;
    }

    .panel-box b {
        display: block;
        margin-bottom: .25rem;
        font-size: .8rem;
    }

    .pill {
        display: inline-flex;
        width: fit-content;
        min-height: 26px;
        align-items: center;
        border: 1px solid color-mix(in srgb, var(--border) 75%, transparent);
        border-radius: 999px;
        padding: 0 .6rem;
        background: rgba(148, 163, 184, .08);
        color: #64748b;
        font-size: .75rem;
        font-weight: 700;
    }

    .pill.success {
        border-color: rgba(34, 197, 94, .24);
        background: rgba(34, 197, 94, .1);
        color: #15803d;
    }

    .row-actions {
        display: flex;
        flex-wrap: wrap;
        gap: .6rem;
        align-items: center;
    }

    .icon-action {
        display: inline-grid;
        width: 36px;
        height: 36px;
        place-items: center;
        border: 1px solid color-mix(in srgb, var(--border) 75%, transparent);
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

    .icon-action.danger:hover {
        border-color: rgba(220, 38, 38, .35);
        background: rgba(220, 38, 38, .08);
    }

    .icon-action svg {
        width: 17px;
        height: 17px;
    }

    .slide-card {
        display: grid;
        grid-template-columns: 180px 1fr;
        gap: 1rem;
        align-items: start;
        border: 1px solid color-mix(in srgb, var(--border) 72%, transparent);
        border-radius: .75rem;
        padding: 1rem;
    }

    .slide-preview {
        overflow: hidden;
        min-height: 110px;
        border-radius: .6rem;
        background: linear-gradient(135deg, #06111f, #334155);
    }

    .slide-preview img {
        width: 100%;
        height: 130px;
        object-fit: cover;
    }

    .cms-actions {
        display: flex;
        flex-wrap: wrap;
        gap: .75rem;
        align-items: center;
        margin-top: 1rem;
    }

    @media (max-width: 768px) {
        .cms-form-grid,
        .row-main,
        .panel-grid,
        .slide-card {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<div class="page-header">
    <div class="page-header-row">
        <div>
            <h1 class="page-title">Home Page Content</h1>
            <p class="page-description" style="font-size: 1rem;">Home Management / {{ $sections[$activeSection] }}</p>
        </div>
        <a href="{{ url('/') }}" target="_blank" class="btn btn-secondary" style="box-shadow:none;">View Frontend</a>
    </div>
</div>

<div class="home-section-tabs">
    @foreach ($sections as $sectionKey => $sectionLabel)
        <a class="{{ $activeSection === $sectionKey ? 'active' : '' }}" href="{{ route('dashboard.home-management.edit', $sectionKey) }}">{{ $sectionLabel }}</a>
    @endforeach
</div>

@if ($errors->any())
    <div class="alert alert-danger" style="margin-bottom: 1rem;">
        <ul style="margin-left: 1rem;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="cms-grid">
    @if ($activeSection === 'hero')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title" style="font-size: 1.0625rem;">Hero Text</h3>
        </div>
        <div class="card-body">
            <div class="content-row">
                <div class="row-main">
                    <div class="row-title">
                        <strong>{{ $homePage->title_line_one }} {{ $homePage->title_line_two }}</strong>
                        <span class="muted-text">{{ \Illuminate\Support\Str::limit($homePage->description, 115) }}</span>
                    </div>
                    <span class="pill">{{ $homePage->eyebrow }}</span>
                    <span class="pill success">Active</span>
                    <div class="row-actions">
                        <a href="#hero-view" class="icon-action" title="View hero content" aria-label="View hero content">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.5 12s3.5-7 9.5-7 9.5 7 9.5 7-3.5 7-9.5 7-9.5-7-9.5-7Z" /><circle cx="12" cy="12" r="3" /></svg>
                        </a>
                        <a href="#hero-edit" class="icon-action primary" title="Edit hero content" aria-label="Edit hero content">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 20h9" /><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5Z" /></svg>
                        </a>
                    </div>
                </div>

                <div class="row-panel" id="hero-view">
                    <div class="panel-grid">
                        <div class="panel-box">
                            <b>Eyebrow</b>
                            <span>{{ $homePage->eyebrow }}</span>
                        </div>
                        <div class="panel-box">
                            <b>Title</b>
                            <span>{{ $homePage->title_line_one }} {{ $homePage->title_line_two }}</span>
                        </div>
                        <div class="panel-box full">
                            <b>Description</b>
                            <span>{{ $homePage->description }}</span>
                        </div>
                        <div class="panel-box">
                            <b>Primary Button</b>
                            <span>{{ $homePage->primary_button_text }} - {{ $homePage->primary_button_url }}</span>
                        </div>
                        <div class="panel-box">
                            <b>Secondary Button</b>
                            <span>{{ $homePage->secondary_button_text }} - {{ $homePage->secondary_button_url }}</span>
                        </div>
                    </div>
                    <div class="cms-actions">
                        <a href="#hero-edit" class="icon-action primary" title="Edit hero content" aria-label="Edit hero content">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 20h9" /><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5Z" /></svg>
                        </a>
                        <a href="#" class="icon-action" title="Close" aria-label="Close">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                        </a>
                    </div>
                </div>

                <div class="row-panel" id="hero-edit">
                    <form method="POST" action="{{ route('dashboard.home-page.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="cms-form-grid">
                            <div class="cms-field">
                                <label for="eyebrow">Eyebrow</label>
                                <input id="eyebrow" name="eyebrow" value="{{ old('eyebrow', $homePage->eyebrow) }}" required>
                            </div>
                            <div class="cms-field">
                                <label for="title_line_one">Title Line One</label>
                                <input id="title_line_one" name="title_line_one" value="{{ old('title_line_one', $homePage->title_line_one) }}" required>
                            </div>
                            <div class="cms-field">
                                <label for="title_line_two">Title Line Two</label>
                                <input id="title_line_two" name="title_line_two" value="{{ old('title_line_two', $homePage->title_line_two) }}" required>
                            </div>
                            <div class="cms-field full">
                                <label for="description">Description</label>
                                <textarea id="description" name="description" required>{{ old('description', $homePage->description) }}</textarea>
                            </div>
                            <div class="cms-field">
                                <label for="primary_button_text">Primary Button Text</label>
                                <input id="primary_button_text" name="primary_button_text" value="{{ old('primary_button_text', $homePage->primary_button_text) }}" required>
                            </div>
                            <div class="cms-field">
                                <label for="primary_button_url">Primary Button URL</label>
                                <input id="primary_button_url" name="primary_button_url" value="{{ old('primary_button_url', $homePage->primary_button_url) }}" required>
                            </div>
                            <div class="cms-field">
                                <label for="secondary_button_text">Secondary Button Text</label>
                                <input id="secondary_button_text" name="secondary_button_text" value="{{ old('secondary_button_text', $homePage->secondary_button_text) }}" required>
                            </div>
                            <div class="cms-field">
                                <label for="secondary_button_url">Secondary Button URL</label>
                                <input id="secondary_button_url" name="secondary_button_url" value="{{ old('secondary_button_url', $homePage->secondary_button_url) }}" required>
                            </div>
                        </div>

                        <div class="cms-actions">
                            <button type="submit" class="btn btn-primary">Save Hero Content</button>
                            <a href="#" class="icon-action" title="Cancel" aria-label="Cancel">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if ($activeSection === 'video-slider')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title" style="font-size: 1.0625rem;">Video Slider Items</h3>
        </div>
        <div class="card-body" style="display:grid;gap:.75rem;">
            <div class="content-row">
                <div class="row-main">
                    <div class="row-title">
                        <strong>Add new slide</strong>
                        <span class="muted-text">Create a new video slider item for the home hero.</span>
                    </div>
                    <span class="pill">New</span>
                    <span class="pill success">Ready</span>
                    <div class="row-actions">
                        <a href="#slide-create" class="icon-action primary" title="Add slide" aria-label="Add slide">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14" /></svg>
                        </a>
                    </div>
                </div>

                <div class="row-panel" id="slide-create">
                    <form method="POST" action="{{ route('dashboard.home-page.slides.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="cms-form-grid">
                            <div class="cms-field">
                                <label for="badge">Badge</label>
                                <input id="badge" name="badge" value="{{ old('badge', 'Latest Video') }}" required>
                            </div>
                            <div class="cms-field">
                                <label for="sort_order">Sort Order</label>
                                <input id="sort_order" name="sort_order" type="number" min="0" value="{{ old('sort_order', 0) }}" required>
                            </div>
                            <div class="cms-field">
                                <label for="title">Title</label>
                                <input id="title" name="title" value="{{ old('title') }}" required>
                            </div>
                            <div class="cms-field">
                                <label for="highlight">Highlighted Text</label>
                                <input id="highlight" name="highlight" value="{{ old('highlight') }}">
                            </div>
                            <div class="cms-field full">
                                <label for="slide_description">Description</label>
                                <textarea id="slide_description" name="description">{{ old('description') }}</textarea>
                            </div>
                            <div class="cms-field">
                                <label for="duration">Duration</label>
                                <input id="duration" name="duration" value="{{ old('duration') }}" placeholder="18:45">
                            </div>
                            <div class="cms-field">
                                <label for="video_url">Video URL</label>
                                <input id="video_url" name="video_url" value="{{ old('video_url') }}" placeholder="https://youtube.com/...">
                            </div>
                            <div class="cms-field">
                                <label for="poster">Poster Image</label>
                                <input id="poster" name="poster" type="file" accept="image/*">
                            </div>
                            <div class="cms-field">
                                <label for="video">Video File</label>
                                <input id="video" name="video" type="file" accept="video/mp4,video/webm,video/ogg">
                            </div>
                            <label class="cms-field full" style="display:flex;gap:.5rem;align-items:center;">
                                <input type="checkbox" name="is_published" value="1" checked style="width:auto;">
                                Published
                            </label>
                        </div>
                        <div class="cms-actions">
                            <button type="submit" class="btn btn-primary">Add Slide</button>
                            <a href="#" class="icon-action" title="Cancel" aria-label="Cancel">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            @forelse ($slides as $slide)
                <div class="content-row">
                    <div class="row-main">
                        <div class="row-title">
                            <strong>{{ $slide->title }} @if($slide->highlight)<span class="muted-text">{{ $slide->highlight }}</span>@endif</strong>
                            <span class="muted-text">{{ $slide->description ? \Illuminate\Support\Str::limit($slide->description, 115) : 'No description' }}</span>
                        </div>
                        <span class="pill">{{ $slide->badge }}</span>
                        <span class="pill {{ $slide->is_published ? 'success' : '' }}">{{ $slide->is_published ? 'Published' : 'Draft' }}</span>
                        <div class="row-actions">
                            <a href="#slide-view-{{ $slide->id }}" class="icon-action" title="View slide" aria-label="View slide">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.5 12s3.5-7 9.5-7 9.5 7 9.5 7-3.5 7-9.5 7-9.5-7-9.5-7Z" /><circle cx="12" cy="12" r="3" /></svg>
                            </a>
                            <a href="#slide-edit-{{ $slide->id }}" class="icon-action primary" title="Edit slide" aria-label="Edit slide">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 20h9" /><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5Z" /></svg>
                            </a>
                            <form id="delete-slide-{{ $slide->id }}" method="POST" action="{{ route('dashboard.home-page.slides.destroy', $slide) }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="icon-action danger" title="Delete slide" aria-label="Delete slide" data-confirm-delete data-delete-form="delete-slide-{{ $slide->id }}" data-delete-title="Delete Slide" data-delete-message="Delete &quot;{{ $slide->title }}&quot;? This action cannot be undone." data-delete-confirm="Delete Slide">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 6h18M8 6V4h8v2m-9 0 1 14h8l1-14M10 11v6M14 11v6" /></svg>
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="row-panel" id="slide-view-{{ $slide->id }}">
                        <div class="panel-grid">
                            <div class="panel-box">
                                <b>Badge</b>
                                <span>{{ $slide->badge }}</span>
                            </div>
                            <div class="panel-box">
                                <b>Sort Order</b>
                                <span>{{ $slide->sort_order }}</span>
                            </div>
                            <div class="panel-box">
                                <b>Title</b>
                                <span>{{ $slide->title }}</span>
                            </div>
                            <div class="panel-box">
                                <b>Highlight</b>
                                <span>{{ $slide->highlight ?: 'No highlight' }}</span>
                            </div>
                            <div class="panel-box full">
                                <b>Description</b>
                                <span>{{ $slide->description ?: 'No description' }}</span>
                            </div>
                            <div class="panel-box">
                                <b>Duration</b>
                                <span>{{ $slide->duration ?: 'No duration' }}</span>
                            </div>
                            <div class="panel-box">
                                <b>Video URL</b>
                                <span>{{ $slide->video_url ?: 'No external URL' }}</span>
                            </div>
                        </div>
                        <div class="cms-actions">
                            <a href="#slide-edit-{{ $slide->id }}" class="icon-action primary" title="Edit slide" aria-label="Edit slide">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 20h9" /><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5Z" /></svg>
                            </a>
                            <a href="#" class="icon-action" title="Close" aria-label="Close">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                            </a>
                        </div>
                    </div>

                    <div class="row-panel" id="slide-edit-{{ $slide->id }}">
                        <form method="POST" action="{{ route('dashboard.home-page.slides.update', $slide) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="cms-form-grid">
                                <div class="cms-field">
                                    <label>Badge</label>
                                    <input name="badge" value="{{ old('badge', $slide->badge) }}" required>
                                </div>
                                <div class="cms-field">
                                    <label>Sort Order</label>
                                    <input name="sort_order" type="number" min="0" value="{{ old('sort_order', $slide->sort_order) }}" required>
                                </div>
                                <div class="cms-field">
                                    <label>Title</label>
                                    <input name="title" value="{{ old('title', $slide->title) }}" required>
                                </div>
                                <div class="cms-field">
                                    <label>Highlighted Text</label>
                                    <input name="highlight" value="{{ old('highlight', $slide->highlight) }}">
                                </div>
                                <div class="cms-field full">
                                    <label>Description</label>
                                    <textarea name="description">{{ old('description', $slide->description) }}</textarea>
                                </div>
                                <div class="cms-field">
                                    <label>Duration</label>
                                    <input name="duration" value="{{ old('duration', $slide->duration) }}">
                                </div>
                                <div class="cms-field">
                                    <label>Video URL</label>
                                    <input name="video_url" value="{{ old('video_url', $slide->video_url) }}">
                                </div>
                                <div class="cms-field">
                                    <label>Replace Poster</label>
                                    <input name="poster" type="file" accept="image/*">
                                </div>
                                <div class="cms-field">
                                    <label>Replace Video File</label>
                                    <input name="video" type="file" accept="video/mp4,video/webm,video/ogg">
                                </div>
                                <label class="cms-field full" style="display:flex;gap:.5rem;align-items:center;">
                                    <input type="checkbox" name="is_published" value="1" @checked($slide->is_published) style="width:auto;">
                                    Published
                                </label>
                            </div>
                            <div class="cms-actions">
                                <button type="submit" class="btn btn-primary">Update Slide</button>
                                <a href="#" class="icon-action" title="Cancel" aria-label="Cancel">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            @empty
                <p class="muted-text">No video slider items yet. Add one above.</p>
            @endforelse
        </div>
    </div>
    @endif
</div>
@endsection
