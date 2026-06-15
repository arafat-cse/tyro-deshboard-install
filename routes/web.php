<?php

use App\Http\Controllers\Dashboard\HomePageController;
use App\Http\Controllers\Dashboard\ToolsPageController;
use App\Http\Controllers\Dashboard\TyroResourceController;
use App\Http\Controllers\LifeDecode\BlogController;
use App\Http\Controllers\LifeDecode\LibraryController;
use App\Http\Controllers\LifeDecode\ToolController;
use App\Models\HomePage;
use App\Models\HomeVideoSlide;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

Route::get('/', function () {
    $hasHomeTables = Schema::hasTable('home_pages') && Schema::hasTable('home_video_slides');

    return view('welcome', [
        'homePage' => $hasHomeTables ? HomePage::first() : null,
        'videoSlides' => $hasHomeTables ? HomeVideoSlide::published()->get() : collect(),
    ]);
});

Route::get('/library', [LibraryController::class, 'index'])->name('life-decode.library');
Route::get('/library/{libraryItem}', [LibraryController::class, 'show'])->name('life-decode.library.show');
Route::get('/blog', [BlogController::class, 'index'])->name('life-decode.blog');
Route::get('/blog/{blogPost}', [BlogController::class, 'show'])->name('life-decode.blog.show');
Route::get('/tools', [ToolController::class, 'index'])->name('life-decode.tools');
Route::view('/community', 'life-decode.community')->name('life-decode.community');
Route::view('/about', 'life-decode.about')->name('life-decode.about');

Route::view('dashboard/system-settings', 'dashboard.system-settings')->middleware(['auth', 'tyro-dashboard.admin'])->name('dashboard.system-settings');

Route::get('dashboard/resources/{resource}', [TyroResourceController::class, 'index'])
    ->middleware(['web', 'auth'])
    ->name('tyro-dashboard.resources.index');

Route::middleware(['auth', 'tyro-dashboard.admin'])->prefix('dashboard')->name('dashboard.')->group(function (): void {
    Route::get('home-page', [HomePageController::class, 'edit'])->name('home-page.edit');
    Route::put('home-page', [HomePageController::class, 'update'])->name('home-page.update');
    Route::post('home-page/slides', [HomePageController::class, 'storeSlide'])->name('home-page.slides.store');
    Route::put('home-page/slides/{slide}', [HomePageController::class, 'updateSlide'])->name('home-page.slides.update');
    Route::delete('home-page/slides/{slide}', [HomePageController::class, 'destroySlide'])->name('home-page.slides.destroy');

    Route::get('tools-page', [ToolsPageController::class, 'edit'])->name('tools-page.edit');
    Route::put('tools-page', [ToolsPageController::class, 'update'])->name('tools-page.update');
    Route::post('tools-page/sections', [ToolsPageController::class, 'storeSection'])->name('tools-page.sections.store');
    Route::put('tools-page/sections/{section}', [ToolsPageController::class, 'updateSection'])->name('tools-page.sections.update');
    Route::delete('tools-page/sections/{section}', [ToolsPageController::class, 'destroySection'])->name('tools-page.sections.destroy');
    Route::post('tools-page/sections/{section}/items', [ToolsPageController::class, 'storeItem'])->name('tools-page.items.store');
    Route::put('tools-page/items/{item}', [ToolsPageController::class, 'updateItem'])->name('tools-page.items.update');
    Route::delete('tools-page/items/{item}', [ToolsPageController::class, 'destroyItem'])->name('tools-page.items.destroy');
});

Route::view('dashboard/adminplan', 'dashboard.adminplan')->middleware(['auth', 'tyro-dashboard.admin'])->name('dashboard.adminplan');
