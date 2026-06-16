@extends('tyro-dashboard::layouts.admin')

@section('title', 'Tools Page')

@section('breadcrumb')
<a href="{{ route($dashboardRoute::name('index')) }}">Dashboard</a>
<span class="breadcrumb-separator">/</span>
<span>Tools Page</span>
@endsection

@push('styles')
<style>
    .tools-page-wrap {
        display: grid;
        gap: 1rem;
    }

    .tools-topbar {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        padding: 1rem;
        border: 1px solid var(--border);
        border-radius: .75rem;
        background: linear-gradient(135deg, color-mix(in srgb, var(--primary) 6%, var(--background)), var(--background));
    }

    .tools-topbar h1 {
        margin: 0;
    }

    .tools-summary {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: .75rem;
    }

    .tools-stat {
        padding: .85rem;
        border: 1px solid var(--border);
        border-radius: .65rem;
        background: var(--background);
    }

    .tools-stat strong {
        display: block;
        font-size: 1.45rem;
        line-height: 1;
    }

    .tools-stat span,
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
        min-height: 100px;
        resize: vertical;
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
        transition: background .15s ease, border-color .15s ease, color .15s ease;
    }

    .icon-action:hover {
        border-color: color-mix(in srgb, var(--primary) 42%, var(--border));
        background: color-mix(in srgb, var(--primary) 8%, var(--background));
    }

    .icon-action.primary {
        background: var(--primary);
        color: var(--primary-foreground);
        border-color: var(--primary);
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

    .list-stack {
        display: grid;
        gap: .65rem;
    }

    .list-row {
        border: 1px solid var(--border);
        border-radius: .65rem;
        background: var(--background);
        overflow: hidden;
        transition: border-color .15s ease, box-shadow .15s ease;
    }

    .list-row:hover {
        border-color: color-mix(in srgb, var(--primary) 34%, var(--border));
        box-shadow: 0 10px 28px rgba(15, 23, 42, .05);
    }

    .row-main {
        display: grid;
        grid-template-columns: 1fr 150px 110px auto;
        gap: .85rem;
        align-items: center;
        padding: .9rem 1rem;
    }

    .row-title {
        display: grid;
        gap: .2rem;
        min-width: 0;
    }

    .row-title strong {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .row-panel {
        display: none;
        padding: 1rem;
        border-top: 1px solid var(--border);
        background: color-mix(in srgb, var(--background) 97%, var(--foreground));
    }

    .row-panel:target {
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
        text-transform: capitalize;
    }

    .pill.success {
        border-color: rgba(34, 197, 94, .24);
        background: rgba(34, 197, 94, .1);
        color: #15803d;
    }

    .panel-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: .8rem;
    }

    .panel-box {
        padding: .85rem;
        border: 1px solid var(--border);
        border-radius: .55rem;
        background: var(--background);
    }

    .panel-box b {
        display: block;
        margin-bottom: .25rem;
        font-size: .8rem;
    }

    .filter-row {
        display: flex;
        flex-wrap: wrap;
        gap: .75rem;
        align-items: end;
        justify-content: space-between;
        margin-bottom: 1rem;
    }

    .filter-row .cms-field {
        min-width: min(320px, 100%);
    }

    .items-table-wrap {
        overflow-x: auto;
        border: 1px solid var(--border);
        border-radius: .65rem;
    }

    .items-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 820px;
    }

    .items-table th,
    .items-table td {
        padding: .75rem .85rem;
        border-bottom: 1px solid var(--border);
        text-align: left;
        vertical-align: middle;
        font-size: .875rem;
    }

    .items-table th {
        color: var(--muted-foreground);
        background: color-mix(in srgb, var(--background) 94%, var(--foreground));
        font-size: .75rem;
        font-weight: 800;
        text-transform: uppercase;
    }

    .items-table tr:last-child td {
        border-bottom: 0;
    }

    .items-table .row-actions {
        justify-content: flex-end;
        flex-wrap: nowrap;
    }

    .item-title-cell {
        display: grid;
        gap: .15rem;
        min-width: 220px;
    }

    .item-title-cell span {
        color: var(--muted-foreground);
        font-size: .78rem;
    }

    @media (max-width: 900px) {
        .tools-summary,
        .row-main,
        .panel-grid,
        .cms-form-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<div class="tools-page-wrap">
    <div class="tools-topbar">
        <div>
            <h1 class="page-title">Tools Page</h1>
            <p class="page-description" style="font-size: .95rem;">Frontend content control, section order, and quick section editing.</p>
        </div>
        <a href="{{ route('life-decode.tools') }}" target="_blank" class="btn btn-secondary">View Frontend</a>
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

    <div class="tools-summary">
        <div class="tools-stat">
            <strong>1</strong>
            <span>Hero content block</span>
        </div>
        <div class="tools-stat">
            <strong>{{ $sections->count() }}</strong>
            <span>Total sections</span>
        </div>
        <div class="tools-stat">
            <strong>{{ $sections->sum(fn ($section) => $section->items->count()) }}</strong>
            <span>Total section items</span>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title" style="font-size: 1.0625rem;">Hero Content</h3>
        </div>
        <div class="card-body">
            <div class="list-row">
                <div class="row-main">
                    <div class="row-title">
                        <strong>{{ $toolPage->title_line_one }} {{ $toolPage->title_line_two }}</strong>
                        <span class="muted-text">{{ \Illuminate\Support\Str::limit($toolPage->description, 110) }}</span>
                    </div>
                    <span class="pill">{{ $toolPage->eyebrow }}</span>
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
                            <span>{{ $toolPage->eyebrow }}</span>
                        </div>
                        <div class="panel-box">
                            <b>Title</b>
                            <span>{{ $toolPage->title_line_one }} {{ $toolPage->title_line_two }}</span>
                        </div>
                        <div class="panel-box" style="grid-column:1 / -1;">
                            <b>Description</b>
                            <span>{{ $toolPage->description }}</span>
                        </div>
                    </div>
                    <div class="cms-actions">
                        <a href="#" class="icon-action" title="Close" aria-label="Close">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                        </a>
                        <a href="#hero-edit" class="icon-action primary" title="Edit hero content" aria-label="Edit hero content">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 20h9" /><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5Z" /></svg>
                        </a>
                    </div>
                </div>
                <div class="row-panel" id="hero-edit">
                    <form method="POST" action="{{ route('dashboard.tools-page.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="cms-form-grid">
                            <div class="cms-field">
                                <label for="eyebrow">Eyebrow</label>
                                <input id="eyebrow" name="eyebrow" value="{{ old('eyebrow', $toolPage->eyebrow) }}" required>
                            </div>
                            <div class="cms-field">
                                <label for="title_line_one">Title Line One</label>
                                <input id="title_line_one" name="title_line_one" value="{{ old('title_line_one', $toolPage->title_line_one) }}" required>
                            </div>
                            <div class="cms-field">
                                <label for="title_line_two">Gold Title Text</label>
                                <input id="title_line_two" name="title_line_two" value="{{ old('title_line_two', $toolPage->title_line_two) }}" required>
                            </div>
                            <div class="cms-field full">
                                <label for="description">Description</label>
                                <textarea id="description" name="description" required>{{ old('description', $toolPage->description) }}</textarea>
                            </div>
                        </div>

                        <div class="cms-actions">
                            <button type="submit" class="btn btn-primary">Save Hero</button>
                            <a href="#" class="icon-action" title="Cancel" aria-label="Cancel">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title" style="font-size: 1.0625rem;">Add Section</h3>
        </div>
        <div class="card-body">
            <div class="list-row">
                <div class="row-main">
                    <div class="row-title">
                        <strong>Create a new section</strong>
                        <span class="muted-text">Add another frontend section and place it with sort order.</span>
                    </div>
                    <span class="pill">New</span>
                    <span class="pill success">Ready</span>
                    <div class="row-actions">
                        <a href="#section-create" class="icon-action primary" title="Add section" aria-label="Add section">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14" /></svg>
                        </a>
                    </div>
                </div>
                <div class="row-panel" id="section-create">
                    <form method="POST" action="{{ route('dashboard.tools-page.sections.store') }}">
                        @csrf
                        <div class="cms-form-grid">
                            <div class="cms-field">
                                <label for="type">Section Type</label>
                                <select id="type" name="type" required>
                                    <option value="tool_cards">Popular tool cards</option>
                                    <option value="categories">Categories</option>
                                    <option value="toolkits">Toolkits</option>
                                    <option value="how_steps">How steps</option>
                                    <option value="hero_points">Hero points</option>
                                </select>
                            </div>
                            <div class="cms-field">
                                <label for="sort_order">Sort Order</label>
                                <input id="sort_order" name="sort_order" type="number" min="0" value="{{ old('sort_order', 60) }}" required>
                            </div>
                            <div class="cms-field">
                                <label for="title">Title</label>
                                <input id="title" name="title" value="{{ old('title') }}" required>
                            </div>
                            <div class="cms-field">
                                <label for="button_text">Button Text</label>
                                <input id="button_text" name="button_text" value="{{ old('button_text') }}">
                            </div>
                            <div class="cms-field">
                                <label for="button_url">Button URL</label>
                                <input id="button_url" name="button_url" value="{{ old('button_url', '#') }}">
                            </div>
                            <label class="cms-field" style="display:flex;gap:.5rem;align-items:center;">
                                <input type="checkbox" name="is_published" value="1" checked style="width:auto;">
                                Published
                            </label>
                        </div>
                        <div class="cms-actions">
                            <button type="submit" class="btn btn-primary">Create Section</button>
                            <a href="#" class="icon-action" title="Cancel" aria-label="Cancel">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title" style="font-size: 1.0625rem;">Section Items</h3>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('dashboard.tools-page.edit') }}" class="filter-row">
                <div class="cms-field">
                    <label for="section-filter">Filter by Section</label>
                    <select id="section-filter" name="section" onchange="this.form.submit()">
                        <option value="">All Sections</option>
                        @foreach ($sections as $section)
                            <option value="{{ $section->id }}" @selected($selectedSectionId === $section->id)>{{ $section->title }}</option>
                        @endforeach
                    </select>
                </div>
                @if ($selectedSectionId)
                    <a href="{{ route('dashboard.tools-page.edit') }}" class="btn btn-secondary">Clear Filter</a>
                @endif
            </form>

            <div class="items-table-wrap">
                <table class="items-table">
                    <thead>
                        <tr>
                            <th>Section</th>
                            <th>Title</th>
                            <th>Icon Text</th>
                            <th>Sort Order</th>
                            <th>Published</th>
                            <th style="text-align:right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($toolItems as $item)
                            <tr>
                                <td><span class="pill">{{ $item->section?->title }}</span></td>
                                <td>
                                    <div class="item-title-cell">
                                        <strong>{{ $item->title }}</strong>
                                        <span>{{ $item->description ? \Illuminate\Support\Str::limit($item->description, 70) : 'No description' }}</span>
                                    </div>
                                </td>
                                <td>{{ $item->icon_text ?: '-' }}</td>
                                <td>{{ $item->sort_order }}</td>
                                <td><span class="pill {{ $item->is_published ? 'success' : '' }}">{{ $item->is_published ? 'Published' : 'Draft' }}</span></td>
                                <td>
                                    <div class="row-actions">
                                        <a href="#item-view-{{ $item->id }}" class="icon-action" title="View item" aria-label="View item">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.5 12s3.5-7 9.5-7 9.5 7 9.5 7-3.5 7-9.5 7-9.5-7-9.5-7Z" /><circle cx="12" cy="12" r="3" /></svg>
                                        </a>
                                        <a href="#item-edit-{{ $item->id }}" class="icon-action primary" title="Edit item" aria-label="Edit item">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 20h9" /><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5Z" /></svg>
                                        </a>
                                        <form id="delete-item-{{ $item->id }}" method="POST" action="{{ route('dashboard.tools-page.items.destroy', $item) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="icon-action danger" title="Delete item" aria-label="Delete item" data-confirm-delete data-delete-form="delete-item-{{ $item->id }}" data-delete-title="Delete Item" data-delete-message="Are you sure you want to delete &quot;{{ $item->title }}&quot;? This action cannot be undone." data-delete-confirm="Delete Item">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 6h18M8 6V4h8v2m-9 0 1 14h8l1-14M10 11v6M14 11v6" /></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="6" style="padding:0;border-bottom:0;">
                                    <div class="row-panel" id="item-view-{{ $item->id }}">
                                        <div class="panel-grid">
                                            <div class="panel-box">
                                                <b>Section</b>
                                                <span>{{ $item->section?->title }}</span>
                                            </div>
                                            <div class="panel-box">
                                                <b>Title</b>
                                                <span>{{ $item->title }}</span>
                                            </div>
                                            <div class="panel-box">
                                                <b>Meta</b>
                                                <span>{{ collect([$item->meta_one, $item->meta_two, $item->meta_three])->filter()->implode(', ') ?: 'No meta' }}</span>
                                            </div>
                                            <div class="panel-box">
                                                <b>Button</b>
                                                <span>{{ $item->button_text ?: 'No button' }}</span>
                                            </div>
                                            <div class="panel-box" style="grid-column:1 / -1;">
                                                <b>Description</b>
                                                <span>{{ $item->description ?: 'No description' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-panel" id="item-edit-{{ $item->id }}">
                                        <form method="POST" action="{{ route('dashboard.tools-page.items.update', $item) }}">
                                            @csrf
                                            @method('PUT')
                                            @include('dashboard.partials.tool-item-fields', ['item' => $item])
                                            <div class="cms-actions">
                                                <button type="submit" class="btn btn-primary">Update Item</button>
                                                <a href="#" class="icon-action" title="Cancel" aria-label="Cancel">
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                                                </a>
                                            </div>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align:center;color:var(--muted-foreground);">No items found for this section.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title" style="font-size: 1.0625rem;">Manage Sections</h3>
        </div>
        <div class="card-body">
            <div class="list-stack">
                @forelse ($sections as $section)
                    <div class="list-row">
                        <div class="row-main">
                            <div class="row-title">
                                <strong>{{ $section->title }}</strong>
                                <span class="muted-text">{{ $section->items->count() }} items, sort order {{ $section->sort_order }}</span>
                            </div>
                            <span class="pill">{{ str_replace('_', ' ', $section->type) }}</span>
                            <span class="pill {{ $section->is_published ? 'success' : '' }}">{{ $section->is_published ? 'Published' : 'Draft' }}</span>
                            <div class="row-actions">
                                <a href="#section-view-{{ $section->id }}" class="icon-action" title="View section" aria-label="View section">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.5 12s3.5-7 9.5-7 9.5 7 9.5 7-3.5 7-9.5 7-9.5-7-9.5-7Z" /><circle cx="12" cy="12" r="3" /></svg>
                                </a>
                                <a href="#section-edit-{{ $section->id }}" class="icon-action primary" title="Edit section" aria-label="Edit section">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 20h9" /><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5Z" /></svg>
                                </a>
                                <a href="#section-item-{{ $section->id }}" class="icon-action" title="Add item" aria-label="Add item">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14" /></svg>
                                </a>
                            </div>
                        </div>

                        <div class="row-panel" id="section-view-{{ $section->id }}">
                            <div class="panel-grid">
                                <div class="panel-box">
                                    <b>Section Type</b>
                                    <span>{{ str_replace('_', ' ', $section->type) }}</span>
                                </div>
                                <div class="panel-box">
                                    <b>Status</b>
                                    <span>{{ $section->is_published ? 'Published' : 'Draft' }}</span>
                                </div>
                                <div class="panel-box">
                                    <b>Button</b>
                                    <span>{{ $section->button_text ?: 'No button' }}</span>
                                </div>
                                <div class="panel-box">
                                    <b>Items</b>
                                    <span>{{ $section->items->pluck('title')->implode(', ') ?: 'No items yet' }}</span>
                                </div>
                            </div>
                            <div class="cms-actions">
                                <a href="#" class="icon-action" title="Close" aria-label="Close">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                                </a>
                                <a href="#section-edit-{{ $section->id }}" class="icon-action primary" title="Edit section" aria-label="Edit section">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 20h9" /><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5Z" /></svg>
                                </a>
                            </div>
                        </div>

                        <div class="row-panel" id="section-edit-{{ $section->id }}">
                            <form method="POST" action="{{ route('dashboard.tools-page.sections.update', $section) }}">
                                @csrf
                                @method('PUT')
                                <div class="cms-form-grid">
                                    <div class="cms-field">
                                        <label>Section Type</label>
                                        <select name="type" required>
                                            @foreach (['hero_points' => 'Hero points', 'tool_cards' => 'Popular tool cards', 'categories' => 'Categories', 'toolkits' => 'Toolkits', 'how_steps' => 'How steps'] as $value => $label)
                                                <option value="{{ $value }}" @selected($section->type === $value)>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="cms-field">
                                        <label>Sort Order</label>
                                        <input name="sort_order" type="number" min="0" value="{{ old('sort_order', $section->sort_order) }}" required>
                                    </div>
                                    <div class="cms-field">
                                        <label>Title</label>
                                        <input name="title" value="{{ old('title', $section->title) }}" required>
                                    </div>
                                    <div class="cms-field">
                                        <label>Button Text</label>
                                        <input name="button_text" value="{{ old('button_text', $section->button_text) }}">
                                    </div>
                                    <div class="cms-field">
                                        <label>Button URL</label>
                                        <input name="button_url" value="{{ old('button_url', $section->button_url) }}">
                                    </div>
                                    <label class="cms-field" style="display:flex;gap:.5rem;align-items:center;">
                                        <input type="checkbox" name="is_published" value="1" @checked($section->is_published) style="width:auto;">
                                        Published
                                    </label>
                                </div>
                                <div class="cms-actions">
                                    <button type="submit" class="btn btn-primary">Update Section</button>
                                    <a href="#" class="icon-action" title="Cancel" aria-label="Cancel">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                                    </a>
                                </div>
                            </form>
                            <form id="delete-section-{{ $section->id }}" method="POST" action="{{ route('dashboard.tools-page.sections.destroy', $section) }}" style="margin-top:.75rem;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="icon-action danger" title="Delete section" aria-label="Delete section" data-confirm-delete data-delete-form="delete-section-{{ $section->id }}" data-delete-title="Delete Section" data-delete-message="Are you sure you want to delete &quot;{{ $section->title }}&quot;? All items inside this section will also be deleted." data-delete-confirm="Delete Section">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 6h18M8 6V4h8v2m-9 0 1 14h8l1-14M10 11v6M14 11v6" /></svg>
                                </button>
                            </form>
                        </div>

                        <div class="row-panel" id="section-item-{{ $section->id }}">
                            <form method="POST" action="{{ route('dashboard.tools-page.items.store', $section) }}">
                                @csrf
                                @include('dashboard.partials.tool-item-fields', ['item' => null])
                                <div class="cms-actions">
                                    <button type="submit" class="btn btn-primary">Add Item</button>
                                    <a href="#" class="icon-action" title="Cancel" aria-label="Cancel">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                @empty
                    <p>No sections yet. Add one above.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
