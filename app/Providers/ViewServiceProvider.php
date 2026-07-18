<?php

namespace App\Providers;

use App\Models\PageMetaSeo;
use App\Models\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if (Schema::hasTable('settings') && Schema::hasTable('page_meta_seos')) {

            $setting = Setting::query()
                ->firstOrCreate();

            $pageSeo = PageMetaSeo::query()
                ->firstOrCreate();

            View::composer(['*'], function ($view) use ($setting) {
                $view->with([
                    'settingInfo' => $setting,
                ]);
            });

            View::composer('frontend.*', function ($view) use ($pageSeo) {
                $view->with([
                    'pageSeo' => $pageSeo
                ]);
            });
        }
    }
}
