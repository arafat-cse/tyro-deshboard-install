<?php

namespace App\Http\Controllers\LifeDecode;

use App\Http\Controllers\Controller;
use App\Models\LibraryItem;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;

class LibraryController extends Controller
{
    public function index(): View
    {
        $libraryItems = LibraryItem::published()->get();
        $typeCounts = $libraryItems->countBy('type');
        $topicCounts = $libraryItems
            ->flatMap(fn (LibraryItem $item): array => array_filter([$item->primary_topic, $item->secondary_topic]))
            ->countBy()
            ->sortDesc();

        return view('life-decode.library', [
            'libraryItems' => $libraryItems,
            'typeCounts' => $typeCounts,
            'topicCounts' => $topicCounts,
            'totalLibraryItems' => $libraryItems->count(),
        ]);
    }

    public function show(LibraryItem $libraryItem): View
    {
        abort_unless($libraryItem->is_published, 404);

        return view('life-decode.library-show', [
            'item' => $libraryItem,
            'relatedItems' => LibraryItem::published()
                ->whereKeyNot($libraryItem->id)
                ->where(function (Builder $query) use ($libraryItem): void {
                    $query->where('primary_topic', $libraryItem->primary_topic)
                        ->orWhere('secondary_topic', $libraryItem->primary_topic);
                })
                ->limit(3)
                ->get(),
        ]);
    }
}
