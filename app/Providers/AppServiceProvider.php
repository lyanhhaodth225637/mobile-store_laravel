<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\View\Composers\SanPhamComposer; // ✅ ĐÚNG

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        if (config('app.env') !== 'local') {
            URL::forceScheme('https');
        }

        if (env('APP_ENV') !== 'local' || str_contains(request()->getHost(), 'ngrok-free.app')) {
            URL::forceScheme('https');
        }

        View::composer(
            ['layouts.frontend', 'frontend.home'], // hoặc '*'
            SanPhamComposer::class
        );
    }
}
