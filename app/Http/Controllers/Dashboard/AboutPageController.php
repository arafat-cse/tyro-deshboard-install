<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\AboutApproachItem;
use App\Models\AboutJourneyItem;
use App\Models\AboutMetric;
use App\Models\AboutMissionItem;
use App\Models\AboutPage;
use App\Models\AboutSocialLink;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AboutPageController extends Controller
{
    public function edit(string $section = 'about-hero'): View
    {
        abort_unless(array_key_exists($section, $this->sections()), 404);

        $aboutPage = $this->aboutPage()->load([
            'metrics',
            'missionItems',
            'approachItems',
            'socialLinks',
            'journeyItems',
        ]);
        $sections = $this->sections();
        $activeSection = $section;

        return view('dashboard.about-page', compact('aboutPage', 'sections', 'activeSection'));
    }

    public function update(Request $request): RedirectResponse
    {
        $aboutPage = $this->aboutPage();
        $data = $this->validatedPage($request);

        if ($heroImagePath = $this->storeFile($request, 'hero_image', 'about/hero')) {
            $this->deleteFile($aboutPage->hero_image_path);
            $data['hero_image_path'] = $heroImagePath;
        }

        if ($creatorImagePath = $this->storeFile($request, 'creator_image', 'about/creator')) {
            $this->deleteFile($aboutPage->creator_image_path);
            $data['creator_image_path'] = $creatorImagePath;
        }

        $aboutPage->update($data);

        return back()->with('success', 'About page content updated.');
    }

    public function storeMetric(Request $request): RedirectResponse
    {
        $this->aboutPage()->metrics()->create($this->withPublished($this->validatedMetric($request), $request));

        return back()->with('success', 'About metric created.');
    }

    public function updateMetric(Request $request, AboutMetric $metric): RedirectResponse
    {
        $metric->update($this->withPublished($this->validatedMetric($request), $request));

        return back()->with('success', 'About metric updated.');
    }

    public function destroyMetric(AboutMetric $metric): RedirectResponse
    {
        $metric->delete();

        return back()->with('success', 'About metric deleted.');
    }

    public function storeMissionItem(Request $request): RedirectResponse
    {
        $data = $this->withPublished($this->validatedMissionItem($request), $request);
        $data['is_gold'] = $request->boolean('is_gold');

        $this->aboutPage()->missionItems()->create($data);

        return back()->with('success', 'Mission item created.');
    }

    public function updateMissionItem(Request $request, AboutMissionItem $missionItem): RedirectResponse
    {
        $data = $this->withPublished($this->validatedMissionItem($request), $request);
        $data['is_gold'] = $request->boolean('is_gold');

        $missionItem->update($data);

        return back()->with('success', 'Mission item updated.');
    }

    public function destroyMissionItem(AboutMissionItem $missionItem): RedirectResponse
    {
        $missionItem->delete();

        return back()->with('success', 'Mission item deleted.');
    }

    public function storeApproachItem(Request $request): RedirectResponse
    {
        $this->aboutPage()->approachItems()->create($this->withPublished($this->validatedApproachItem($request), $request));

        return back()->with('success', 'Approach item created.');
    }

    public function updateApproachItem(Request $request, AboutApproachItem $approachItem): RedirectResponse
    {
        $approachItem->update($this->withPublished($this->validatedApproachItem($request), $request));

        return back()->with('success', 'Approach item updated.');
    }

    public function destroyApproachItem(AboutApproachItem $approachItem): RedirectResponse
    {
        $approachItem->delete();

        return back()->with('success', 'Approach item deleted.');
    }

    public function storeSocialLink(Request $request): RedirectResponse
    {
        $data = $this->withPublished($this->validatedSocialLink($request), $request);
        $data['is_gold'] = $request->boolean('is_gold');

        $this->aboutPage()->socialLinks()->create($data);

        return back()->with('success', 'Social link created.');
    }

    public function updateSocialLink(Request $request, AboutSocialLink $socialLink): RedirectResponse
    {
        $data = $this->withPublished($this->validatedSocialLink($request), $request);
        $data['is_gold'] = $request->boolean('is_gold');

        $socialLink->update($data);

        return back()->with('success', 'Social link updated.');
    }

    public function destroySocialLink(AboutSocialLink $socialLink): RedirectResponse
    {
        $socialLink->delete();

        return back()->with('success', 'Social link deleted.');
    }

    public function storeJourneyItem(Request $request): RedirectResponse
    {
        $data = $this->withPublished($this->validatedJourneyItem($request), $request);
        $data['is_gold'] = $request->boolean('is_gold');

        $this->aboutPage()->journeyItems()->create($data);

        return back()->with('success', 'Journey item created.');
    }

    public function updateJourneyItem(Request $request, AboutJourneyItem $journeyItem): RedirectResponse
    {
        $data = $this->withPublished($this->validatedJourneyItem($request), $request);
        $data['is_gold'] = $request->boolean('is_gold');

        $journeyItem->update($data);

        return back()->with('success', 'Journey item updated.');
    }

    public function destroyJourneyItem(AboutJourneyItem $journeyItem): RedirectResponse
    {
        $journeyItem->delete();

        return back()->with('success', 'Journey item deleted.');
    }

    private function aboutPage(): AboutPage
    {
        return AboutPage::firstOrCreate([], $this->defaultPageData());
    }

    /**
     * @return array<string, string>
     */
    private function sections(): array
    {
        return [
            'about-hero' => 'About Hero',
            'our-mission' => 'Our Mission',
            'the-creator' => 'The Creator',
            'credentials-approach' => 'Credentials & Approach',
            'social-media' => 'Social Media',
            'our-journey' => 'Our Journey',
        ];
    }

    /**
     * @return array<string, string>
     */
    private function defaultPageData(): array
    {
        return [
            'hero_description' => 'Life Decode is a space to understand the psychology behind your thoughts, decisions, and behavior so you can break free from autopilot and design a life with clarity, purpose, and impact.',
            'mission_description' => 'To decode the hidden patterns of the mind and behavior, share practical wisdom, and empower you to make better decisions and live a more meaningful life.',
            'creator_intro' => "Hi, I'm the creator behind Life Decode.",
            'creator_body_one' => "I've always been fascinated by why humans think, feel, and act the way they do. That curiosity led me deep into the world of psychology, cognitive science, and philosophy.",
            'creator_body_two' => 'Life Decode is the result of that journey, turning complex ideas into simple lessons that you can use in real life.',
            'credentials_description' => "I'm not here to just motivate you. I'm here to help you understand why things happen so you can change them.",
            'journey_description' => 'From a simple idea to a global community. Thank you for being a part of this journey.',
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private function validatedPage(Request $request): array
    {
        return Arr::except($request->validate([
            'eyebrow' => ['required', 'string', 'max:255'],
            'title_line_one' => ['required', 'string', 'max:255'],
            'title_line_two' => ['required', 'string', 'max:255'],
            'hero_description' => ['required', 'string'],
            'hero_image_path' => ['required', 'string', 'max:255'],
            'hero_image' => ['nullable', 'image', 'max:5120'],
            'mission_title' => ['required', 'string', 'max:255'],
            'mission_description' => ['required', 'string'],
            'creator_title' => ['required', 'string', 'max:255'],
            'creator_intro' => ['required', 'string'],
            'creator_body_one' => ['required', 'string'],
            'creator_body_two' => ['required', 'string'],
            'creator_signature' => ['required', 'string', 'max:255'],
            'creator_role' => ['required', 'string', 'max:255'],
            'creator_image_path' => ['required', 'string', 'max:255'],
            'creator_image' => ['nullable', 'image', 'max:5120'],
            'credentials_title' => ['required', 'string', 'max:255'],
            'credentials_description' => ['required', 'string'],
            'social_title' => ['required', 'string', 'max:255'],
            'journey_title' => ['required', 'string', 'max:255'],
            'journey_description' => ['required', 'string'],
            'journey_button_text' => ['required', 'string', 'max:255'],
            'journey_button_url' => ['required', 'string', 'max:255'],
            'quote_text' => ['required', 'string', 'max:255'],
            'quote_author' => ['required', 'string', 'max:255'],
        ]), ['hero_image', 'creator_image']);
    }

    /**
     * @return array<string, mixed>
     */
    private function validatedMetric(Request $request): array
    {
        return $request->validate([
            'icon_text' => ['nullable', 'string', 'max:10'],
            'value' => ['required', 'string', 'max:255'],
            'label' => ['required', 'string', 'max:255'],
            'sort_order' => ['required', 'integer', 'min:0'],
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    private function validatedMissionItem(Request $request): array
    {
        return $request->validate([
            'icon_text' => ['nullable', 'string', 'max:10'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['required', 'integer', 'min:0'],
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    private function validatedApproachItem(Request $request): array
    {
        return $request->validate([
            'type' => ['required', Rule::in(['check', 'process'])],
            'icon_text' => ['nullable', 'string', 'max:10'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['required', 'integer', 'min:0'],
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    private function validatedSocialLink(Request $request): array
    {
        return $request->validate([
            'icon_text' => ['nullable', 'string', 'max:10'],
            'platform' => ['required', 'string', 'max:255'],
            'handle' => ['required', 'string', 'max:255'],
            'url' => ['required', 'string', 'max:255'],
            'sort_order' => ['required', 'integer', 'min:0'],
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    private function validatedJourneyItem(Request $request): array
    {
        return $request->validate([
            'icon_text' => ['nullable', 'string', 'max:10'],
            'period' => ['required', 'string', 'max:255'],
            'headline' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['required', 'integer', 'min:0'],
        ]);
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    private function withPublished(array $data, Request $request): array
    {
        return $data + ['is_published' => $request->boolean('is_published')];
    }

    private function storeFile(Request $request, string $key, string $directory): ?string
    {
        if (! $request->hasFile($key)) {
            return null;
        }

        return $request->file($key)->store($directory, 'public');
    }

    private function deleteFile(?string $path): void
    {
        if (! $path || str_starts_with($path, '/') || str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return;
        }

        Storage::disk('public')->delete($path);
    }
}
