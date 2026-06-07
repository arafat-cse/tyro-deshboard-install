<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/library', 'life-decode.library')->name('life-decode.library');
Route::view('/blog', 'life-decode.blog')->name('life-decode.blog');
Route::view('/tools', 'life-decode.tools')->name('life-decode.tools');
Route::view('/community', 'life-decode.community')->name('life-decode.community');
Route::view('/about', 'life-decode.about')->name('life-decode.about');

Route::view('dashboard/system-settings', 'dashboard.system-settings')->middleware(['auth', 'tyro-dashboard.admin'])->name('dashboard.system-settings');

Route::view('dashboard/adminplan', 'dashboard.adminplan')->middleware(['auth', 'tyro-dashboard.admin'])->name('dashboard.adminplan');

Route::view('dashboard/welecome', 'dashboard.welecome')->middleware(['auth', 'tyro-dashboard.admin'])->name('dashboard.welecome');
