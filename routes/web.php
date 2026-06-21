<?php

use App\Http\Controllers\Dashboard\AboutPageController;
use App\Http\Controllers\Dashboard\HomePageController;
use App\Http\Controllers\Dashboard\SystemSettingsController;
use App\Http\Controllers\Dashboard\ToolsPageController;
use App\Http\Controllers\Dashboard\TyroResourceController;
use App\Http\Controllers\LifeDecode\AboutController;
use App\Http\Controllers\LifeDecode\BlogController;
use App\Http\Controllers\LifeDecode\LibraryController;
use App\Http\Controllers\LifeDecode\ToolController;
use App\Models\BlogPost;
use App\Models\HomePage;
use App\Models\HomeVideoSlide;
use App\Models\LibraryItem;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

Route::get('/', function () {
    $hasHomeTables = Schema::hasTable('home_pages') && Schema::hasTable('home_video_slides');
    $hasLibraryTable = Schema::hasTable('library_items');
    $hasBlogTables = Schema::hasTable('blog_posts') && Schema::hasTable('blog_categories');
    $publishedLibraryItems = $hasLibraryTable ? LibraryItem::published()->get() : collect();

    return view('welcome', [
        'homePage' => $hasHomeTables ? HomePage::first() : null,
        'videoSlides' => $hasHomeTables ? HomeVideoSlide::published()->get() : collect(),
        'homeLibraryItems' => $publishedLibraryItems->take(6),
        'homeLibraryTopicItems' => $publishedLibraryItems,
        'homeFeaturedLibraryItem' => $hasLibraryTable ? LibraryItem::published()->where('type', 'VIDEO')->first() : null,
        'homeBlogPosts' => $hasBlogTables ? BlogPost::with('blogCategory')->published()->limit(4)->get() : collect(),
    ]);
});

Route::get('/library', [LibraryController::class, 'index'])->name('life-decode.library');
Route::get('/library/{libraryItem}', [LibraryController::class, 'show'])->name('life-decode.library.show');
Route::get('/blog', [BlogController::class, 'index'])->name('life-decode.blog');
Route::get('/blog/{blogPost}', [BlogController::class, 'show'])->name('life-decode.blog.show');
Route::get('/tools/popular', [ToolController::class, 'popular'])->name('life-decode.tools.popular');
Route::get('/tools/categories', [ToolController::class, 'categories'])->name('life-decode.tools.categories');
Route::get('/tools/toolkits', [ToolController::class, 'toolkits'])->name('life-decode.tools.toolkits');
Route::get('/tools', [ToolController::class, 'index'])->name('life-decode.tools');
Route::view('/community', 'life-decode.community')->name('life-decode.community');
Route::get('/about', [AboutController::class, 'index'])->name('life-decode.about');

Route::get('dashboard/system-settings', [SystemSettingsController::class, 'edit'])->middleware(['auth', 'dashboard.permission'])->name('dashboard.system-settings');
Route::put('dashboard/system-settings', [SystemSettingsController::class, 'update'])->middleware(['auth', 'dashboard.permission'])->name('dashboard.system-settings.update');

Route::middleware(['auth', 'dashboard.permission'])->prefix('dashboard/resources/{resource}')->name('tyro-dashboard.resources.')->group(function (): void {
    Route::get('/', [TyroResourceController::class, 'index'])->name('index');
    Route::get('/create', [TyroResourceController::class, 'create'])->name('create');
    Route::post('/', [TyroResourceController::class, 'store'])->name('store');
    Route::get('/{id}', [TyroResourceController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [TyroResourceController::class, 'edit'])->name('edit');
    Route::put('/{id}', [TyroResourceController::class, 'update'])->name('update');
    Route::delete('/{id}', [TyroResourceController::class, 'destroy'])->name('destroy');
});

Route::middleware(['auth', 'dashboard.permission'])->prefix('dashboard')->name('dashboard.')->group(function (): void {
    Route::redirect('home-page', '/dashboard/home-management/hero')->name('home-page.edit');
    Route::get('home-management/{section}', [HomePageController::class, 'edit'])->name('home-management.edit');
    Route::put('home-page', [HomePageController::class, 'update'])->name('home-page.update');
    Route::post('home-page/slides', [HomePageController::class, 'storeSlide'])->name('home-page.slides.store');
    Route::put('home-page/slides/{slide}', [HomePageController::class, 'updateSlide'])->name('home-page.slides.update');
    Route::delete('home-page/slides/{slide}', [HomePageController::class, 'destroySlide'])->name('home-page.slides.destroy');

    Route::redirect('about-page', '/dashboard/about-management/about-hero')->name('about-page.edit');
    Route::get('about-management/{section}', [AboutPageController::class, 'edit'])->name('about-management.edit');
    Route::put('about-page', [AboutPageController::class, 'update'])->name('about-page.update');
    Route::post('about-page/metrics', [AboutPageController::class, 'storeMetric'])->name('about-page.metrics.store');
    Route::put('about-page/metrics/{metric}', [AboutPageController::class, 'updateMetric'])->name('about-page.metrics.update');
    Route::delete('about-page/metrics/{metric}', [AboutPageController::class, 'destroyMetric'])->name('about-page.metrics.destroy');
    Route::post('about-page/mission-items', [AboutPageController::class, 'storeMissionItem'])->name('about-page.mission-items.store');
    Route::put('about-page/mission-items/{missionItem}', [AboutPageController::class, 'updateMissionItem'])->name('about-page.mission-items.update');
    Route::delete('about-page/mission-items/{missionItem}', [AboutPageController::class, 'destroyMissionItem'])->name('about-page.mission-items.destroy');
    Route::post('about-page/approach-items', [AboutPageController::class, 'storeApproachItem'])->name('about-page.approach-items.store');
    Route::put('about-page/approach-items/{approachItem}', [AboutPageController::class, 'updateApproachItem'])->name('about-page.approach-items.update');
    Route::delete('about-page/approach-items/{approachItem}', [AboutPageController::class, 'destroyApproachItem'])->name('about-page.approach-items.destroy');
    Route::post('about-page/social-links', [AboutPageController::class, 'storeSocialLink'])->name('about-page.social-links.store');
    Route::put('about-page/social-links/{socialLink}', [AboutPageController::class, 'updateSocialLink'])->name('about-page.social-links.update');
    Route::delete('about-page/social-links/{socialLink}', [AboutPageController::class, 'destroySocialLink'])->name('about-page.social-links.destroy');
    Route::post('about-page/journey-items', [AboutPageController::class, 'storeJourneyItem'])->name('about-page.journey-items.store');
    Route::put('about-page/journey-items/{journeyItem}', [AboutPageController::class, 'updateJourneyItem'])->name('about-page.journey-items.update');
    Route::delete('about-page/journey-items/{journeyItem}', [AboutPageController::class, 'destroyJourneyItem'])->name('about-page.journey-items.destroy');

    Route::get('tools-page', [ToolsPageController::class, 'edit'])->name('tools-page.edit');
    Route::put('tools-page', [ToolsPageController::class, 'update'])->name('tools-page.update');
    Route::post('tools-page/sections', [ToolsPageController::class, 'storeSection'])->name('tools-page.sections.store');
    Route::put('tools-page/sections/{section}', [ToolsPageController::class, 'updateSection'])->name('tools-page.sections.update');
    Route::delete('tools-page/sections/{section}', [ToolsPageController::class, 'destroySection'])->name('tools-page.sections.destroy');
    Route::post('tools-page/sections/{section}/items', [ToolsPageController::class, 'storeItem'])->name('tools-page.items.store');
    Route::put('tools-page/items/{item}', [ToolsPageController::class, 'updateItem'])->name('tools-page.items.update');
    Route::delete('tools-page/items/{item}', [ToolsPageController::class, 'destroyItem'])->name('tools-page.items.destroy');
});

Route::view('dashboard/adminplan', 'dashboard.adminplan')->middleware(['auth', 'dashboard.permission'])->name('dashboard.adminplan');
