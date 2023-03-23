<?php

namespace App\Providers\Application\Route;

use Illuminate\Support\ServiceProvider;

use App\Transcendent\Support\Route\Information;

// Every Route Module Information
use App\Transcendent\Support\Route\Module\Auth;
use App\Transcendent\Support\Route\Module\Home;

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
         * Register Home Module
         */
        $this->app->singleton(Home::class, function() {
            return new Home;
        });

        /**
         * Register Route Into Facades
         */
        $this->app->bind('RouteInfo', function() {
            return new Information(
                $this->app->make(Auth::class),
                $this->app->make(Home::class),
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
