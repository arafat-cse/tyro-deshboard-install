@extends('tyro-dashboard::layouts.admin')

@section('title', 'System Settings')

@section('breadcrumb')
<a href="{{ route($dashboardRoute::name('index')) }}">Dashboard</a>
<span class="breadcrumb-separator">/</span>
<span>System Settings</span>
@endsection

@php
    $textFields = [
        'site_name' => 'Site Name',
        'site_name_highlight' => 'Highlighted Brand Word',
        'brand_mark' => 'Brand Mark',
        'tagline' => 'Tagline',
        'default_meta_title' => 'Default Meta Title',
        'header_cta_text' => 'Header CTA Text',
        'header_cta_url' => 'Header CTA URL',
        'newsletter_title' => 'Newsletter Title',
        'newsletter_subtitle' => 'Newsletter Subtitle',
        'newsletter_placeholder' => 'Newsletter Input Placeholder',
        'newsletter_button_text' => 'Newsletter Button Text',
        'footer_quote_text' => 'Footer Quote',
        'footer_quote_author' => 'Footer Quote Author',
        'contact_email' => 'Contact Email',
        'contact_phone' => 'Contact Phone',
        'contact_address' => 'Contact Address',
        'youtube_url' => 'YouTube URL',
        'facebook_url' => 'Facebook URL',
        'instagram_url' => 'Instagram URL',
        'x_url' => 'X URL',
        'linkedin_url' => 'LinkedIn URL',
        'maintenance_message' => 'Maintenance Message',
    ];

    $groups = [
        'Identity & SEO' => [
            'site_name',
            'site_name_highlight',
            'brand_mark',
            'tagline',
            'default_meta_title',
            'default_meta_description',
        ],
        'Header Controls' => [
            'header_cta_text',
            'header_cta_url',
            'show_header_search',
            'show_header_cta',
            'show_login_link',
        ],
        'Newsletter' => [
            'newsletter_title',
            'newsletter_subtitle',
            'newsletter_placeholder',
            'newsletter_button_text',
            'show_newsletter',
        ],
        'Footer' => [
            'footer_description',
            'footer_quote_text',
            'footer_quote_author',
        ],
        'Contact & Social' => [
            'contact_email',
            'contact_phone',
            'contact_address',
            'youtube_url',
            'facebook_url',
            'instagram_url',
            'x_url',
            'linkedin_url',
        ],
        'Operations' => [
            'is_site_live',
            'maintenance_message',
        ],
    ];

    $toggleLabels = [
        'show_header_search' => 'Show Header Search',
        'show_header_cta' => 'Show Header CTA',
        'show_login_link' => 'Show Login Link',
        'show_newsletter' => 'Show Newsletter Blocks',
        'is_site_live' => 'Site Live',
    ];

    $allFields = collect($groups)->flatten()->unique()->values();

    $summaries = [
        'Identity & SEO' => $settings->site_name . ' / ' . $settings->tagline,
        'Header Controls' => $settings->header_cta_text . ' -> ' . $settings->header_cta_url,
        'Newsletter' => $settings->show_newsletter ? $settings->newsletter_title : 'Newsletter hidden',
        'Footer' => $settings->footer_quote_text,
        'Contact & Social' => $settings->contact_email ?: 'Contact details not set',
        'Operations' => $settings->is_site_live ? 'Site live' : 'Site marked offline',
    ];
@endphp

@push('styles')
<style>
    .settings-wrap {
        display: grid;
        gap: 1rem;
    }

    .settings-topbar {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        padding: 1rem;
        border: 1px solid color-mix(in srgb, var(--border) 75%, transparent);
        border-radius: .75rem;
        background: var(--background);
    }

    .settings-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 1rem;
    }

    .settings-list {
        display: grid;
        gap: .75rem;
    }

    .settings-row {
        overflow: hidden;
        border: 1px solid color-mix(in srgb, var(--border) 75%, transparent);
        border-radius: .65rem;
        background: var(--background);
    }

    .settings-row-main {
        display: grid;
        grid-template-columns: 1fr 120px auto;
        gap: .85rem;
        align-items: center;
        padding: .9rem 1rem;
    }

    .settings-row-title {
        display: grid;
        gap: .2rem;
        min-width: 0;
    }

    .settings-row-title strong,
    .settings-row-title span {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .settings-panel {
        display: none;
        padding: 1rem;
        border-top: 1px solid color-mix(in srgb, var(--border) 75%, transparent);
        background: color-mix(in srgb, var(--background) 98%, var(--foreground));
    }

    .settings-panel:target {
        display: block;
    }

    .settings-preview {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: .75rem;
    }

    .settings-preview-box {
        padding: .8rem;
        border: 1px solid color-mix(in srgb, var(--border) 75%, transparent);
        border-radius: .55rem;
        background: var(--background);
    }

    .settings-preview-box.full {
        grid-column: 1 / -1;
    }

    .settings-preview-box b {
        display: block;
        margin-bottom: .25rem;
        font-size: .8rem;
    }

    .settings-pill {
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

    .settings-pill.success {
        border-color: rgba(34, 197, 94, .24);
        background: rgba(34, 197, 94, .1);
        color: #15803d;
    }

    .row-actions {
        display: flex;
        flex-wrap: wrap;
        gap: .6rem;
        align-items: center;
        justify-content: flex-end;
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

    .icon-action svg {
        width: 17px;
        height: 17px;
    }

    .settings-field {
        display: grid;
        gap: .4rem;
    }

    .settings-field.full {
        grid-column: 1 / -1;
    }

    .settings-field label,
    .settings-toggle {
        font-size: .875rem;
        font-weight: 650;
    }

    .settings-field input,
    .settings-field textarea {
        width: 100%;
        border: 1px solid var(--border);
        border-radius: .5rem;
        padding: .7rem .85rem;
        background: var(--background);
        color: var(--foreground);
    }

    .settings-field textarea {
        min-height: 110px;
        resize: vertical;
    }

    .settings-toggle {
        display: flex;
        gap: .6rem;
        align-items: center;
        min-height: 42px;
        padding: .7rem .85rem;
        border: 1px solid color-mix(in srgb, var(--border) 75%, transparent);
        border-radius: .5rem;
        background: color-mix(in srgb, var(--background) 97%, var(--foreground));
    }

    .settings-toggle input {
        width: auto;
    }

    .settings-note {
        color: var(--muted-foreground);
        font-size: .85rem;
    }

    .settings-actions {
        display: flex;
        flex-wrap: wrap;
        gap: .75rem;
        align-items: center;
        margin-top: 1rem;
    }

    @media (max-width: 860px) {
        .settings-grid,
        .settings-row-main,
        .settings-preview {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<div class="settings-wrap">
    <div class="settings-topbar">
        <div>
            <h1 class="page-title">System Settings</h1>
            <p class="page-description" style="font-size:1rem;">Control global brand, header, newsletter, footer, contact, and operational settings.</p>
        </div>
        <a href="{{ url('/') }}" target="_blank" class="btn btn-secondary">View Site</a>
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
            <h3 class="card-title" style="font-size:1.0625rem;">Settings List</h3>
        </div>
        <div class="card-body">
            <div class="settings-list">
                @foreach ($groups as $groupTitle => $fields)
                    @php
                        $groupKey = \Illuminate\Support\Str::slug($groupTitle);
                    @endphp
                    <div class="settings-row">
                        <div class="settings-row-main">
                            <div class="settings-row-title">
                                <strong>{{ $groupTitle }}</strong>
                                <span class="settings-note">{{ $summaries[$groupTitle] }}</span>
                            </div>
                            <span class="settings-pill {{ $groupTitle === 'Operations' && $settings->is_site_live ? 'success' : '' }}">{{ count($fields) }} settings</span>
                            <div class="row-actions">
                                <a href="#view-{{ $groupKey }}" class="icon-action" title="View settings" aria-label="View settings">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.5 12s3.5-7 9.5-7 9.5 7 9.5 7-3.5 7-9.5 7-9.5-7-9.5-7Z" /><circle cx="12" cy="12" r="3" /></svg>
                                </a>
                                <a href="#edit-{{ $groupKey }}" class="icon-action primary" title="Edit settings" aria-label="Edit settings">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 20h9" /><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5Z" /></svg>
                                </a>
                            </div>
                        </div>

                        <div class="settings-panel" id="view-{{ $groupKey }}">
                            <div class="settings-preview">
                                @foreach ($fields as $field)
                                    <div class="settings-preview-box {{ in_array($field, ['default_meta_description', 'footer_description', 'contact_address', 'maintenance_message'], true) ? 'full' : '' }}">
                                        <b>{{ $toggleLabels[$field] ?? ($textFields[$field] ?? ($field === 'default_meta_description' ? 'Default Meta Description' : 'Footer Description')) }}</b>
                                        <span>
                                            @if (array_key_exists($field, $toggleLabels))
                                                {{ $settings->{$field} ? 'Enabled' : 'Disabled' }}
                                            @else
                                                {{ $settings->{$field} ?: 'Not set' }}
                                            @endif
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                            <div class="settings-actions">
                                <a href="#edit-{{ $groupKey }}" class="icon-action primary" title="Edit settings" aria-label="Edit settings">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 20h9" /><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5Z" /></svg>
                                </a>
                                <a href="#" class="icon-action" title="Close" aria-label="Close">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                                </a>
                            </div>
                        </div>

                        <div class="settings-panel" id="edit-{{ $groupKey }}">
                            <form method="POST" action="{{ route('dashboard.system-settings.update') }}">
                                @csrf
                                @method('PUT')

                                @foreach ($allFields as $hiddenField)
                                    @if (! in_array($hiddenField, $fields, true))
                                        @if (array_key_exists($hiddenField, $toggleLabels))
                                            @if ($settings->{$hiddenField})
                                                <input type="hidden" name="{{ $hiddenField }}" value="1">
                                            @endif
                                        @else
                                            <input type="hidden" name="{{ $hiddenField }}" value="{{ old($hiddenField, $settings->{$hiddenField}) }}">
                                        @endif
                                    @endif
                                @endforeach

                                <div class="settings-grid">
                                    @foreach ($fields as $field)
                                        @if (array_key_exists($field, $toggleLabels))
                                            <label class="settings-toggle">
                                                <input type="checkbox" name="{{ $field }}" value="1" @checked(old($field, $settings->{$field}))>
                                                {{ $toggleLabels[$field] }}
                                            </label>
                                        @elseif (in_array($field, ['default_meta_description', 'footer_description'], true))
                                            <div class="settings-field full">
                                                <label for="{{ $groupKey }}-{{ $field }}">{{ $field === 'default_meta_description' ? 'Default Meta Description' : 'Footer Description' }}</label>
                                                <textarea id="{{ $groupKey }}-{{ $field }}" name="{{ $field }}" required>{{ old($field, $settings->{$field}) }}</textarea>
                                            </div>
                                        @else
                                            <div class="settings-field {{ in_array($field, ['contact_address', 'maintenance_message'], true) ? 'full' : '' }}">
                                                <label for="{{ $groupKey }}-{{ $field }}">{{ $textFields[$field] }}</label>
                                                <input id="{{ $groupKey }}-{{ $field }}" name="{{ $field }}" value="{{ old($field, $settings->{$field}) }}" @required(! in_array($field, ['contact_email', 'contact_phone', 'contact_address', 'youtube_url', 'facebook_url', 'instagram_url', 'x_url', 'linkedin_url', 'maintenance_message'], true))>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>

                                @if ($groupTitle === 'Operations')
                                    <p class="settings-note" style="margin-top:1rem;">Site Live is an informational toggle for now. Use it to track launch state without blocking admin access.</p>
                                @endif

                                <div class="settings-actions">
                                    <button type="submit" class="btn btn-primary">Save {{ $groupTitle }}</button>
                                    <a href="#" class="icon-action" title="Cancel" aria-label="Cancel">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
