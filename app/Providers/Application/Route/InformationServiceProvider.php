<?php

namespace App\Providers\Application\Route;

use Illuminate\Support\ServiceProvider;

use App\Transcendent\Support\Route\Information;

// Every Route Module Information
use App\Transcendent\Support\Route\Module\Auth;

class InformationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        /**
         * Register Auth Module
         */
        $this->app->singleton(Auth::class, function() {
            return new Auth;
        });

        /**
         * Register Route Into Facades
         */
        $this->app->bind('RouteInfo', function() {
            return new Information(
                $this->app->make(Auth::class)
            );
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
