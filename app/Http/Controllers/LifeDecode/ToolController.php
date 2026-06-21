<?php

namespace App\Http\Controllers\LifeDecode;

use App\Http\Controllers\Controller;
use App\Models\ToolPage;
use Illuminate\View\View;

class ToolController extends Controller
{
    public function index(): View
    {
        $toolPage = ToolPage::with([
            'sections' => fn ($query) => $query->published()->with([
                'items' => fn ($query) => $query->published(),
            ]),
        ])->first();

        return view('life-decode.tools', [
            'toolPage' => $toolPage,
            'heroPoints' => $toolPage?->sections->firstWhere('type', 'hero_points')?->items ?? collect(),
            'contentSections' => $toolPage?->sections->where('type', '!=', 'hero_points') ?? collect(),
        ]);
    }

    public function popular(): View
    {
        $toolPage = ToolPage::with([
            'sections' => fn ($query) => $query->published()->where('type', 'tool_cards')->with([
                'items' => fn ($query) => $query->published(),
            ]),
        ])->first();

        return view('life-decode.popular-tools', [
            'toolPage' => $toolPage,
            'popularSection' => $toolPage?->sections->first(),
        ]);
    }

    public function categories(): View
    {
        $toolPage = ToolPage::with([
            'sections' => fn ($query) => $query->published()->where('type', 'categories')->with([
                'items' => fn ($query) => $query->published(),
            ]),
        ])->first();

        return view('life-decode.tool-categories', [
            'toolPage' => $toolPage,
            'categorySection' => $toolPage?->sections->first(),
        ]);
    }

    public function toolkits(): View
    {
        $toolPage = ToolPage::with([
            'sections' => fn ($query) => $query->published()->where('type', 'toolkits')->with([
                'items' => fn ($query) => $query->published(),
            ]),
        ])->first();

        return view('life-decode.toolkits', [
            'toolPage' => $toolPage,
            'toolkitSection' => $toolPage?->sections->first(),
        ]);
    }
}
