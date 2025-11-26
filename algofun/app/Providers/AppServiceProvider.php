<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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
        Blade::directive('btnBase', function () {
            return <<<'EOD'
            "inline-flex items-center justify-center gap-2 font-nunito font-semibold
             rounded-xl transition-all duration-200 focus:ring-2
             disabled:opacity-50 disabled:cursor-not-allowed"
        EOD;
        });
    }
}
