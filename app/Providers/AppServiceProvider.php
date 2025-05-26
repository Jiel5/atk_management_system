<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;  // <- ini yang kurang

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if (config('app.env') != 'local') {
            URL::forceScheme('https');
        }
    }

    public function register(): void
    {
        //
    }
}
