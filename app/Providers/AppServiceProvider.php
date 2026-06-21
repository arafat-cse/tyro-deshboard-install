<?php

namespace App\Providers;

use App\Models\SystemSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer(['welcome', 'life-decode.*', 'dashboard.system-settings'], function ($view): void {
            $settings = Schema::hasTable('system_settings')
                ? SystemSetting::current()
                : new SystemSetting(SystemSetting::defaults());

            $view->with('systemSettings', $settings);
        });
    }
}
