<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client; // Use Guzzle for HTTP requests

class ApiRequestServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // Bind a singleton to the container
        $this->app->singleton('ApiRequestService', function ($app) {
            return new \App\Services\ApiRequestService(new Client());
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Any boot logic can go here
    }
}
