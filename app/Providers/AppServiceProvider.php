<?php

namespace App\Providers;
use Filament\Support\Facades\FilamentIcon;

use Illuminate\Support\ServiceProvider;
class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     */
    public function register(): void
    {
        FilamentIcon::register([
            'panels::topbar.global-search.field' => 'fas-magnifying-glass',
        ]);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}
