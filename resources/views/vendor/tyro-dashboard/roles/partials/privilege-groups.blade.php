@php
    $selectedPrivilegeIds = collect(old('privileges', $selectedPrivilegeIds ?? []))
        ->map(fn ($id) => (int) $id)
        ->all();
    $privilegesBySlug = $privileges->keyBy('slug');
    $groupedSlugs = collect(config('dashboard-permissions.groups', []))
        ->flatMap(fn ($group, $key) => collect(array_keys($group['actions']))->map(fn ($action) => "{$key}.{$action}"))
        ->all();
    $otherPrivileges = $privileges->reject(fn ($privilege) => in_array($privilege->slug, $groupedSlugs, true));
@endphp

@pushOnce('styles')
<style>
    .permission-groups {
        display: grid;
        gap: .85rem;
    }

    .permission-group {
        overflow: hidden;
        border: 1px solid var(--border);
        border-radius: .65rem;
        background: var(--background);
    }

    .permission-group-header {
        display: grid;
        grid-template-columns: auto 1fr;
        gap: .75rem;
        align-items: start;
        padding: .9rem 1rem;
        background: color-mix(in srgb, var(--background) 94%, var(--foreground));
    }

    .permission-group-title {
        display: grid;
        gap: .2rem;
    }

    .permission-group-title strong {
        font-size: .95rem;
    }

    .permission-group-title span,
    .permission-action small {
        color: var(--muted-foreground);
        font-size: .8rem;
    }

    .permission-actions {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: .5rem;
        padding: .75rem;
    }

    .permission-action {
        display: grid;
        grid-template-columns: auto 1fr;
        gap: .5rem;
        align-items: start;
        min-height: 76px;
        border: 1px solid var(--border);
        border-radius: .55rem;
        padding: .75rem;
        background: color-mix(in srgb, var(--background) 98%, var(--foreground));
        cursor: pointer;
    }

    .permission-action input,
    .permission-group-header input {
        margin-top: .15rem;
    }

    .permission-action span {
        display: grid;
        gap: .15rem;
        min-width: 0;
    }

    .permission-action b {
        font-size: .85rem;
    }

    .permission-action small {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    @media (max-width: 900px) {
        .permission-actions {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 560px) {
        .permission-actions {
            grid-template-columns: 1fr;
        }
    }
</style>
@endPushOnce

<div class="permission-groups" data-permission-groups>
    @foreach(config('dashboard-permissions.groups', []) as $groupKey => $group)
        @php
            $groupPrivilegeIds = collect(array_keys($group['actions']))
                ->map(fn ($action) => $privilegesBySlug->get("{$groupKey}.{$action}")?->id)
                ->filter()
                ->map(fn ($id) => (int) $id)
                ->values()
                ->all();
            $selectedGroupCount = count(array_intersect($groupPrivilegeIds, $selectedPrivilegeIds));
            $isGroupChecked = $groupPrivilegeIds !== [] && $selectedGroupCount === count($groupPrivilegeIds);
        @endphp
        <section class="permission-group">
            <label class="permission-group-header">
                <input type="checkbox" data-permission-group-toggle @checked($isGroupChecked)>
                <span class="permission-group-title">
                    <strong>{{ $group['name'] }}</strong>
                    <span>{{ $group['description'] }}</span>
                </span>
            </label>
            <div class="permission-actions">
                @foreach($group['actions'] as $action => $label)
                    @php
                        $slug = "{$groupKey}.{$action}";
                        $privilege = $privilegesBySlug->get($slug);
                    @endphp
                    @if($privilege)
                        <label class="permission-action">
                            <input type="checkbox" name="privileges[]" value="{{ $privilege->id }}" data-permission-child @checked(in_array((int) $privilege->id, $selectedPrivilegeIds, true))>
                            <span>
                                <b>{{ $label }}</b>
                                <small>{{ $privilege->slug }}</small>
                            </span>
                        </label>
                    @endif
                @endforeach
            </div>
        </section>
    @endforeach

    @if($otherPrivileges->count())
        <section class="permission-group">
            <label class="permission-group-header">
                <input type="checkbox" data-permission-group-toggle>
                <span class="permission-group-title">
                    <strong>Other Privileges</strong>
                    <span>Package or custom privileges outside the dashboard groups.</span>
                </span>
            </label>
            <div class="permission-actions">
                @foreach($otherPrivileges as $privilege)
                    <label class="permission-action">
                        <input type="checkbox" name="privileges[]" value="{{ $privilege->id }}" data-permission-child @checked(in_array((int) $privilege->id, $selectedPrivilegeIds, true))>
                        <span>
                            <b>{{ $privilege->name }}</b>
                            <small>{{ $privilege->slug }}</small>
                        </span>
                    </label>
                @endforeach
            </div>
        </section>
    @endif
</div>

@pushOnce('scripts')
<script>
    document.addEventListener('change', function (event) {
        const groupToggle = event.target.closest('[data-permission-group-toggle]');
        const childToggle = event.target.closest('[data-permission-child]');

        if (groupToggle) {
            const group = groupToggle.closest('.permission-group');
            group.querySelectorAll('[data-permission-child]').forEach(function (checkbox) {
                checkbox.checked = groupToggle.checked;
            });
        }

        if (childToggle) {
            const group = childToggle.closest('.permission-group');
            const children = Array.from(group.querySelectorAll('[data-permission-child]'));
            const checked = children.filter(function (checkbox) {
                return checkbox.checked;
            });
            group.querySelector('[data-permission-group-toggle]').checked = checked.length === children.length;
        }
    });
</script>
@endPushOnce
