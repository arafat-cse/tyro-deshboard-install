@extends('tyro-dashboard::layouts.admin')

@section('title', 'Home Page')

@section('breadcrumb')
<a href="{{ route($dashboardRoute::name('index')) }}">Dashboard</a>
<span class="breadcrumb-separator">/</span>
<span>Home Page</span>
@endsection

@push('styles')
<style>
    .cms-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1rem;
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

    .slide-card {
        display: grid;
        grid-template-columns: 180px 1fr;
        gap: 1rem;
        align-items: start;
        border: 1px solid var(--border);
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
            <p class="page-description" style="font-size: 1rem;">Control the frontend hero and video slider from the dashboard.</p>
        </div>
        <a href="{{ url('/') }}" target="_blank" class="btn btn-secondary">View Frontend</a>
    </div>
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
    <div class="card">
        <div class="card-header">
            <h3 class="card-title" style="font-size: 1.0625rem;">Hero Text</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('dashboard.home-page.update') }}">
                @csrf
                @method('PUT')

                <div class="cms-form-grid">
                    <div class="cms-field">
                        <label for="eyebrow">Eyebrow</label>
                        <input id="eyebrow" name="eyebrow" value="{{ old('eyebrow', $homePage->eyebrow) }}" required>
                    </div>
                    <div class="cms-field">
                        <label for="community_text">Community Text</label>
                        <input id="community_text" name="community_text" value="{{ old('community_text', $homePage->community_text) }}" required>
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
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title" style="font-size: 1.0625rem;">Add Video Slider Item</h3>
        </div>
        <div class="card-body">
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
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title" style="font-size: 1.0625rem;">Video Slider Items</h3>
        </div>
        <div class="card-body" style="display:grid;gap:1rem;">
            @forelse ($slides as $slide)
                <div class="slide-card">
                    <div class="slide-preview">
                        @if ($slide->poster_path)
                            <img src="{{ Storage::url($slide->poster_path) }}" alt="{{ $slide->title }}">
                        @endif
                    </div>
                    <div>
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
                            </div>
                        </form>
                        <form method="POST" action="{{ route('dashboard.home-page.slides.destroy', $slide) }}" onsubmit="return confirm('Delete this slide?')" style="margin-top:.75rem;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete Slide</button>
                        </form>
                    </div>
                </div>
            @empty
                <p>No video slider items yet. Add one above.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
