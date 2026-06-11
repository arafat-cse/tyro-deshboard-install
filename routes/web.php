<?php

use App\Http\Controllers\Dashboard\HomePageController;
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

Route::view('/library', 'life-decode.library')->name('life-decode.library');
Route::view('/blog', 'life-decode.blog')->name('life-decode.blog');
Route::view('/tools', 'life-decode.tools')->name('life-decode.tools');
Route::view('/community', 'life-decode.community')->name('life-decode.community');
Route::view('/about', 'life-decode.about')->name('life-decode.about');

Route::view('dashboard/system-settings', 'dashboard.system-settings')->middleware(['auth', 'tyro-dashboard.admin'])->name('dashboard.system-settings');

Route::middleware(['auth', 'tyro-dashboard.admin'])->prefix('dashboard')->name('dashboard.')->group(function (): void {
    Route::get('home-page', [HomePageController::class, 'edit'])->name('home-page.edit');
    Route::put('home-page', [HomePageController::class, 'update'])->name('home-page.update');
    Route::post('home-page/slides', [HomePageController::class, 'storeSlide'])->name('home-page.slides.store');
    Route::put('home-page/slides/{slide}', [HomePageController::class, 'updateSlide'])->name('home-page.slides.update');
    Route::delete('home-page/slides/{slide}', [HomePageController::class, 'destroySlide'])->name('home-page.slides.destroy');
});

Route::view('dashboard/adminplan', 'dashboard.adminplan')->middleware(['auth', 'tyro-dashboard.admin'])->name('dashboard.adminplan');
