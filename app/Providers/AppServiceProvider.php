<?php

namespace App\Providers;

use App\Models\Info;
use App\Models\Layanan;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
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
        Blade::anonymousComponentPath(resource_path('views/admin/components'));

        if (Schema::hasTable('infos')) {
            View::share('infos', Info::first());
        }

        if (Schema::hasTable('layanans')) {
            View::share('navLayanans', Layanan::where('status', 'aktif')
                ->orderBy('urutan')
                ->orderBy('id')
                ->get());
        }
    }
}

