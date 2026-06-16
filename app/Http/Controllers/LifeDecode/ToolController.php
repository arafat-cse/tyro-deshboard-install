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
}
