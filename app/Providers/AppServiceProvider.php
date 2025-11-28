<?php

namespace App\Providers;
use Illuminate\Support\Facades\URL;
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
        // Kiểm tra nếu môi trường KHÔNG phải là local (tức là trên Render)
        if (config('app.env') !== 'local') {
            URL::forceScheme('https');
        }
        if (env('APP_ENV') !== 'local' || str_contains(request()->getHost(), 'ngrok-free.app')) {
            URL::forceScheme('https');
        }
    }
}
