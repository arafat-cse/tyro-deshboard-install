<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ToolItem;
use App\Models\ToolPage;
use App\Models\ToolSection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ToolsPageController extends Controller
{
    public function edit(Request $request): View
    {
        $toolPage = $this->toolPage();
        $sections = $toolPage->sections()->with('items')->get();
        $selectedSectionId = $request->integer('section');
        $toolItems = ToolItem::with('section')
            ->whereHas('section', fn ($query) => $query->whereBelongsTo($toolPage, 'page'))
            ->when($selectedSectionId > 0, fn ($query) => $query->where('tool_section_id', $selectedSectionId))
            ->orderBy(
                ToolSection::select('sort_order')
                    ->whereColumn('tool_sections.id', 'tool_items.tool_section_id')
                    ->limit(1)
            )
            ->orderBy('sort_order')
            ->get();

        return view('dashboard.tools-page', compact('toolPage', 'sections', 'toolItems', 'selectedSectionId'));
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'eyebrow' => ['required', 'string', 'max:255'],
            'title_line_one' => ['required', 'string', 'max:255'],
            'title_line_two' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]);

        $this->toolPage()->update($data);

        return back()->with('success', 'Tools page hero updated.');
    }

    public function storeSection(Request $request): RedirectResponse
    {
        $data = $this->validatedSection($request);
        $data['is_published'] = $request->boolean('is_published');

        $this->toolPage()->sections()->create($data);

        return back()->with('success', 'Tools section created.');
    }

    public function updateSection(Request $request, ToolSection $section): RedirectResponse
    {
        $data = $this->validatedSection($request);
        $data['is_published'] = $request->boolean('is_published');

        $section->update($data);

        return back()->with('success', 'Tools section updated.');
    }

    public function destroySection(ToolSection $section): RedirectResponse
    {
        $section->delete();

        return back()->with('success', 'Tools section deleted.');
    }

    public function storeItem(Request $request, ToolSection $section): RedirectResponse
    {
        $data = $this->validatedItem($request);
        $data['is_published'] = $request->boolean('is_published');

        $section->items()->create($data);

        return back()->with('success', 'Tools item created.');
    }

    public function updateItem(Request $request, ToolItem $item): RedirectResponse
    {
        $data = $this->validatedItem($request);
        $data['is_published'] = $request->boolean('is_published');

        $item->update($data);

        return back()->with('success', 'Tools item updated.');
    }

    public function destroyItem(ToolItem $item): RedirectResponse
    {
        $item->delete();

        return back()->with('success', 'Tools item deleted.');
    }

    private function toolPage(): ToolPage
    {
        return ToolPage::firstOrCreate([], [
            'description' => 'Hand-picked frameworks, worksheets, and checklists to help you understand better, decide smarter, and live with more clarity and purpose.',
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    private function validatedSection(Request $request): array
    {
        return $request->validate([
            'type' => ['required', Rule::in(['hero_points', 'tool_cards', 'categories', 'toolkits', 'how_steps'])],
            'title' => ['required', 'string', 'max:255'],
            'button_text' => ['nullable', 'string', 'max:255'],
            'button_url' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['required', 'integer', 'min:0'],
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    private function validatedItem(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'icon_text' => ['nullable', 'string', 'max:10'],
            'style_class' => ['nullable', Rule::in(['', 'gold-bg', 'green-bg', 'purple-bg', 'pink-bg', 'green-img', 'purple-img'])],
            'meta_one' => ['nullable', 'string', 'max:255'],
            'meta_two' => ['nullable', 'string', 'max:255'],
            'meta_three' => ['nullable', 'string', 'max:255'],
            'button_text' => ['nullable', 'string', 'max:255'],
            'button_url' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['required', 'integer', 'min:0'],
        ]);
    }
}
