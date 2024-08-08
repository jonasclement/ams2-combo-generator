<?php

namespace App\Providers;

use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider as LaravelIdeHelperIdeHelperServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class IdeHelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        if (App::isLocal()) {
            App::register(LaravelIdeHelperIdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
