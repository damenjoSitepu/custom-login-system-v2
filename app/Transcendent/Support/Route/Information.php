<?php 

namespace App\Transcendent\Support\Route;

// Contracts
use App\Transcendent\Contracts\RouteRootInformation;
// Modules
use App\Transcendent\Support\Route\Module\Auth;

/**
 * Documentation
 * 
 * @method static get(string | array $routeInfo)
 */

class Information implements RouteRootInformation {
    /**
     * Initialize all route information from every file 
     * which contains in transcendent route module
     * all modules will merged here as well
     * 
     * @var array<mixed>
     */
    private static $allRouteInformation = [];

    /**
     * Merge Route Information Here
     */
    public function __construct(
        private Auth $authModule
    ){
        // Merge All Route Information
        $mergeAllRouteInformation = array_merge(
            $authModule->get()
        );
        // Initialization Starts Here
        self::$allRouteInformation = $mergeAllRouteInformation;
    }

    /**
     * Get Route Information Definition
     * - Route Name
     * - View Name
     * - Title Name
     * 
     * @param string | array
     */
    public static function get(string | array $routeInfo = [])
    {
        return self::$allRouteInformation;
    }
}