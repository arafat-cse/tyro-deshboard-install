@extends('tyro-dashboard::layouts.admin')

@section('title', 'Privileges')

@section('breadcrumb')
<a href="{{ route($dashboardRoute::name('index')) }}">Dashboard</a>
<span class="breadcrumb-separator">/</span>
<span>Privileges</span>
@endsection

@php
    $dashboardGroups = config('dashboard-permissions.groups', []);
    $privilegesBySlug = $privileges->keyBy('slug');
    $permissionSections = [
        'Home Management' => ['home'],
        'About Management' => ['about.hero', 'about.mission', 'about.creator', 'about.credentials', 'about.social', 'about.journey'],
        'Tools Management' => ['tools'],
        'Content Management' => ['library', 'blog'],
        'Administration' => ['users', 'roles', 'privileges', 'system-settings', 'invitations', 'audits', 'adminplan'],
    ];
    $knownSlugs = collect($dashboardGroups)
        ->flatMap(fn ($group, $key) => collect(array_keys($group['actions'] ?? []))->map(fn ($action) => "{$key}.{$action}"))
        ->values();
    $otherPrivileges = $privileges->reject(fn ($privilege) => $knownSlugs->contains($privilege->slug));
@endphp

@push('styles')
<style>
    .privilege-groups {
        display: grid;
        gap: 1rem;
    }

    .privilege-section,
    .privilege-group-card {
        border: 1px solid var(--border);
        border-radius: .65rem;
        background: var(--card);
        overflow: hidden;
    }

    .privilege-section summary,
    .privilege-group-card summary {
        cursor: pointer;
        list-style: none;
    }

    .privilege-section summary::-webkit-details-marker,
    .privilege-group-card summary::-webkit-details-marker {
        display: none;
    }

    .privilege-section-header,
    .privilege-group-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        padding: 1rem;
    }

    .privilege-section-header {
        background: color-mix(in srgb, var(--background) 94%, var(--foreground));
    }

    .privilege-group-header {
        border-top: 1px solid var(--border);
    }

    .privilege-title {
        display: grid;
        gap: .2rem;
        min-width: 0;
    }

    .privilege-title strong {
        font-size: .98rem;
    }

    .privilege-title span {
        color: var(--muted-foreground);
        font-size: .85rem;
    }

    .privilege-section-body {
        display: grid;
        gap: .75rem;
        padding: .75rem;
    }

    .privilege-action-list {
        display: grid;
        gap: .5rem;
        padding: 0 .75rem .75rem;
    }

    .privilege-action-row {
        display: grid;
        grid-template-columns: minmax(160px, .75fr) minmax(220px, 1fr) auto auto;
        gap: .75rem;
        align-items: center;
        padding: .75rem;
        border: 1px solid var(--border);
        border-radius: .55rem;
        background: color-mix(in srgb, var(--background) 98%, var(--foreground));
    }

    .privilege-action-row code {
        width: fit-content;
        max-width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        padding: .25rem .5rem;
        border-radius: .3rem;
        background: var(--muted);
        font-size: .8rem;
    }

    .privilege-action-main {
        display: grid;
        gap: .15rem;
        min-width: 0;
    }

    .privilege-action-main a {
        color: var(--foreground);
        font-weight: 600;
        text-decoration: none;
    }

    .privilege-action-main span {
        overflow: hidden;
        color: var(--muted-foreground);
        font-size: .82rem;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .privilege-empty-action {
        color: var(--muted-foreground);
        font-size: .875rem;
    }

    @media (max-width: 900px) {
        .privilege-action-row {
            grid-template-columns: 1fr;
        }

        .privilege-action-row .action-buttons {
            justify-content: flex-start !important;
        }
    }
</style>
@endpush

@section('content')
<div class="page-header">
    <div class="page-header-row">
        <div>
            <h1 class="page-title">Privileges</h1>
            <p class="page-description">Manage granular permissions that can be assigned to roles.</p>
        </div>
        <a href="{{ route($dashboardRoute::name('privileges.create')) }}" class="btn btn-primary">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Add Privilege
        </a>
    </div>
</div>

<!-- Filters -->
<div class="card" style="margin-bottom: 1rem;">
    <div class="card-body">
        <form action="{{ route($dashboardRoute::name('privileges.index')) }}" method="GET">
            <div class="filters-bar">
                <div class="search-box">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" name="search" class="form-input" placeholder="Search privileges..." value="{{ $filters['search'] ?? '' }}">
                </div>
                <button type="submit" class="btn btn-secondary">Search</button>
                @if(!empty($filters['search']))
                    <a href="{{ route($dashboardRoute::name('privileges.index')) }}" class="btn btn-ghost">Clear</a>
                @endif
            </div>
        </form>
    </div>
</div>

<!-- Privileges Groups -->
<div class="privilege-groups">
    @if($privileges->count())
        @foreach($permissionSections as $sectionName => $groupKeys)
            @php
                $sectionPrivileges = collect($groupKeys)
                    ->flatMap(fn ($groupKey) => collect(array_keys($dashboardGroups[$groupKey]['actions'] ?? []))->map(fn ($action) => $privilegesBySlug->get("{$groupKey}.{$action}")))
                    ->filter();
            @endphp

            @continue($sectionPrivileges->isEmpty())

            <details class="privilege-section" open>
                <summary>
                    <div class="privilege-section-header">
                        <div class="privilege-title">
                            <strong>{{ $sectionName }}</strong>
                            <span>{{ $sectionPrivileges->count() }} privileges in this group</span>
                        </div>
                        <span class="badge badge-secondary">{{ $sectionPrivileges->sum('roles_count') }} role links</span>
                    </div>
                </summary>

                <div class="privilege-section-body">
                    @foreach($groupKeys as $groupKey)
                        @php
                            $group = $dashboardGroups[$groupKey] ?? null;
                            $groupPrivileges = $group
                                ? collect(array_keys($group['actions'] ?? []))
                                    ->mapWithKeys(fn ($action) => [$action => $privilegesBySlug->get("{$groupKey}.{$action}")])
                                    ->filter()
                                : collect();
                        @endphp

                        @continue(! $group || $groupPrivileges->isEmpty())

                        <details class="privilege-group-card" open>
                            <summary>
                                <div class="privilege-group-header">
                                    <div class="privilege-title">
                                        <strong>{{ $group['name'] }}</strong>
                                        <span>{{ $group['description'] }}</span>
                                    </div>
                                    <span class="badge badge-primary">{{ $groupPrivileges->count() }} actions</span>
                                </div>
                            </summary>

                            <div class="privilege-action-list">
                                @foreach($group['actions'] as $action => $label)
                                    @php
                                        $privilege = $privilegesBySlug->get("{$groupKey}.{$action}");
                                    @endphp

                                    @if($privilege)
                                        <div class="privilege-action-row">
                                            <div class="privilege-action-main">
                                                <a href="{{ route($dashboardRoute::name('privileges.show'), $privilege->id) }}">{{ $label }}</a>
                                                <span>{{ Str::limit($privilege->description, 70) ?: '-' }}</span>
                                            </div>
                                            <code>{{ $privilege->slug }}</code>
                                            <span class="badge badge-secondary">{{ $privilege->roles_count }} roles</span>
                                            <div class="action-buttons" style="justify-content: flex-end;">
                                                <a href="{{ route($dashboardRoute::name('privileges.show'), $privilege->id) }}" class="action-btn" title="View">
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </a>
                                                <a href="{{ route($dashboardRoute::name('privileges.edit'), $privilege->id) }}" class="action-btn" title="Edit">
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </a>
                                                <form action="{{ route($dashboardRoute::name('privileges.destroy'), $privilege->id) }}" method="POST" style="display: inline;" id="delete-privilege-form-{{ $privilege->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="action-btn action-btn-danger" title="Delete" onclick="event.preventDefault(); showDanger('Delete Privilege', 'Are you sure you want to delete this privilege? It will be removed from all roles.').then(confirmed => { if(confirmed) document.getElementById('delete-privilege-form-{{ $privilege->id }}').submit(); })">
                                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @else
                                        <div class="privilege-action-row">
                                            <div class="privilege-action-main">
                                                <span class="privilege-empty-action">{{ $label }}</span>
                                            </div>
                                            <code>{{ $groupKey }}.{{ $action }}</code>
                                            <span class="badge badge-secondary">Missing</span>
                                            <span></span>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </details>
                    @endforeach
                </div>
            </details>
        @endforeach

        @if($otherPrivileges->count())
            <details class="privilege-section" open>
                <summary>
                    <div class="privilege-section-header">
                        <div class="privilege-title">
                            <strong>Other Privileges</strong>
                            <span>Legacy, wildcard, package, or custom privileges.</span>
                        </div>
                        <span class="badge badge-secondary">{{ $otherPrivileges->count() }} privileges</span>
                    </div>
                </summary>

                <div class="privilege-section-body">
                    <div class="privilege-action-list">
                        @foreach($otherPrivileges as $privilege)
                            <div class="privilege-action-row">
                                <div class="privilege-action-main">
                                    <a href="{{ route($dashboardRoute::name('privileges.show'), $privilege->id) }}">{{ $privilege->name }}</a>
                                    <span>{{ Str::limit($privilege->description, 70) ?: '-' }}</span>
                                </div>
                                <code>{{ $privilege->slug }}</code>
                                <span class="badge badge-secondary">{{ $privilege->roles_count }} roles</span>
                                <div class="action-buttons" style="justify-content: flex-end;">
                                    <a href="{{ route($dashboardRoute::name('privileges.show'), $privilege->id) }}" class="action-btn" title="View">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                    <a href="{{ route($dashboardRoute::name('privileges.edit'), $privilege->id) }}" class="action-btn" title="Edit">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    <form action="{{ route($dashboardRoute::name('privileges.destroy'), $privilege->id) }}" method="POST" style="display: inline;" id="delete-privilege-form-{{ $privilege->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="action-btn action-btn-danger" title="Delete" onclick="event.preventDefault(); showDanger('Delete Privilege', 'Are you sure you want to delete this privilege? It will be removed from all roles.').then(confirmed => { if(confirmed) document.getElementById('delete-privilege-form-{{ $privilege->id }}').submit(); })">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </details>
        @endif
    @else
        <div class="card">
            <div class="empty-state">
                <svg class="empty-state-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                </svg>
                <h3 class="empty-state-title">No privileges found</h3>
                <p class="empty-state-description">Get started by creating a new privilege.</p>
                <a href="{{ route($dashboardRoute::name('privileges.create')) }}" class="btn btn-primary">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Add Privilege
                </a>
            </div>
        </div>
    @endif
</div>

@push('scripts')
<script>
    // Auto-focus search input and move cursor to end if search is present
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.querySelector('input[name="search"]');
        if (searchInput && searchInput.value) {
            searchInput.focus();
            searchInput.setSelectionRange(searchInput.value.length, searchInput.value.length);
        }
    });
</script>
@endpush
@endsection
