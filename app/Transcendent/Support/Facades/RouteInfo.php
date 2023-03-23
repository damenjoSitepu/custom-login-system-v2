<?php 

namespace App\Transcendent\Support\Facades;

// Laravel Facade
use Illuminate\Support\Facades\Facade;

/**
 * Documentation
 * 
 * @method static App\Transcendent\Support\Route\Information get(string | array $routeInfo)
 */

class RouteInfo extends Facade {
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'RouteInfo';
    }
}