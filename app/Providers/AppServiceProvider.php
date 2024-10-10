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
        Blade::directive('isok', function ($expression) {
            return "<?php if(collect(explode(',', $expression))->filter(function(\$value) {
                return in_array(trim(\$value), (session('user')['permission'] ?? []));
            })->isNotEmpty()): ?>";
        });
        Blade::directive('endisok', function () {
            return "<?php endif; ?>";
        });
    }
}
