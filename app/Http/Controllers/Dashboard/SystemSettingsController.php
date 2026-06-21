<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\SystemSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SystemSettingsController extends Controller
{
    public function edit(): View
    {
        $settings = SystemSetting::current();

        return view('dashboard.system-settings', compact('settings'));
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'site_name' => ['required', 'string', 'max:255'],
            'site_name_highlight' => ['required', 'string', 'max:255'],
            'brand_mark' => ['required', 'string', 'max:20'],
            'tagline' => ['required', 'string', 'max:255'],
            'default_meta_title' => ['required', 'string', 'max:255'],
            'default_meta_description' => ['required', 'string'],
            'header_cta_text' => ['required', 'string', 'max:255'],
            'header_cta_url' => ['required', 'string', 'max:255'],
            'newsletter_title' => ['required', 'string', 'max:255'],
            'newsletter_subtitle' => ['required', 'string', 'max:255'],
            'newsletter_placeholder' => ['required', 'string', 'max:255'],
            'newsletter_button_text' => ['required', 'string', 'max:255'],
            'footer_description' => ['required', 'string'],
            'footer_quote_text' => ['required', 'string', 'max:255'],
            'footer_quote_author' => ['required', 'string', 'max:255'],
            'contact_email' => ['nullable', 'email', 'max:255'],
            'contact_phone' => ['nullable', 'string', 'max:255'],
            'contact_address' => ['nullable', 'string', 'max:255'],
            'youtube_url' => ['nullable', 'string', 'max:255'],
            'facebook_url' => ['nullable', 'string', 'max:255'],
            'instagram_url' => ['nullable', 'string', 'max:255'],
            'x_url' => ['nullable', 'string', 'max:255'],
            'linkedin_url' => ['nullable', 'string', 'max:255'],
            'maintenance_message' => ['nullable', 'string', 'max:255'],
        ]);

        $data['show_header_search'] = $request->boolean('show_header_search');
        $data['show_header_cta'] = $request->boolean('show_header_cta');
        $data['show_login_link'] = $request->boolean('show_login_link');
        $data['show_newsletter'] = $request->boolean('show_newsletter');
        $data['is_site_live'] = $request->boolean('is_site_live');

        SystemSetting::current()->update($data);

        return back()->with('success', 'System settings updated.');
    }
}
