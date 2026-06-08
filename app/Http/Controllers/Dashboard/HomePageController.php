<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\HomePage;
use App\Models\HomeVideoSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class HomePageController extends Controller
{
    public function edit(): View
    {
        $homePage = $this->homePage();
        $slides = HomeVideoSlide::orderBy('sort_order')->latest()->get();

        return view('dashboard.home-page', compact('homePage', 'slides'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'eyebrow' => ['required', 'string', 'max:255'],
            'title_line_one' => ['required', 'string', 'max:255'],
            'title_line_two' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'primary_button_text' => ['required', 'string', 'max:255'],
            'primary_button_url' => ['required', 'string', 'max:255'],
            'secondary_button_text' => ['required', 'string', 'max:255'],
            'secondary_button_url' => ['required', 'string', 'max:255'],
            'community_text' => ['required', 'string', 'max:255'],
        ]);

        $this->homePage()->update($data);

        return back()->with('success', 'Home page content updated.');
    }

    public function storeSlide(Request $request)
    {
        $data = $this->validatedSlide($request);
        $data['poster_path'] = $this->storeFile($request, 'poster', 'home/posters');
        $data['video_path'] = $this->storeFile($request, 'video', 'home/videos');
        $data['is_published'] = $request->boolean('is_published');

        HomeVideoSlide::create($data);

        return back()->with('success', 'Video slide created.');
    }

    public function updateSlide(Request $request, HomeVideoSlide $slide)
    {
        $data = $this->validatedSlide($request);

        if ($posterPath = $this->storeFile($request, 'poster', 'home/posters')) {
            $this->deleteFile($slide->poster_path);
            $data['poster_path'] = $posterPath;
        }

        if ($videoPath = $this->storeFile($request, 'video', 'home/videos')) {
            $this->deleteFile($slide->video_path);
            $data['video_path'] = $videoPath;
        }

        $data['is_published'] = $request->boolean('is_published');
        $slide->update($data);

        return back()->with('success', 'Video slide updated.');
    }

    public function destroySlide(HomeVideoSlide $slide)
    {
        $this->deleteFile($slide->poster_path);
        $this->deleteFile($slide->video_path);
        $slide->delete();

        return back()->with('success', 'Video slide deleted.');
    }

    private function homePage(): HomePage
    {
        return HomePage::firstOrCreate([], [
            'description' => 'Explore the psychology, systems and thinking models that shape your behavior, decisions and reality.',
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    private function validatedSlide(Request $request): array
    {
        return $request->validate([
            'badge' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'highlight' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'duration' => ['nullable', 'string', 'max:50'],
            'video_url' => ['nullable', 'url', 'max:2048'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'poster' => ['nullable', 'image', 'max:5120'],
            'video' => ['nullable', 'file', 'mimetypes:video/mp4,video/webm,video/ogg', 'max:51200'],
        ]);
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
        if ($path) {
            Storage::disk('public')->delete($path);
        }
    }
}
