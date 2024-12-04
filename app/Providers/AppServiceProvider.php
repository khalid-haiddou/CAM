<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register AdminMiddleware explicitly (optional)
        $this->app->singleton(\App\Http\Middleware\AdminMiddleware::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Fix for database migrations (optional)
        Schema::defaultStringLength(191);
    }
}
