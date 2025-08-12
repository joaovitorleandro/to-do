<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;

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
        if ($this->app->environment('local')) {
        Response::macro('prettyJson', function ($value, $status = 200, array $headers = [], $options = 0) {
            $options = $options | JSON_PRETTY_PRINT;
            return response()->json($value, $status, $headers, $options);
        });
    }
    }
}
