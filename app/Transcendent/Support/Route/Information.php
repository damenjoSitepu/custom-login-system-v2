<?php 

namespace App\Transcendent\Support\Route;

// Contracts
use App\Transcendent\Contracts\RouteRootInformation;
// Modules
use App\Transcendent\Support\Route\Module\Auth;
// Base Class Service
use App\Transcendent\Support\Route\Route;
use App\Transcendent\Support\Route\Tools\UniformResource;

/**
 * Documentation
 * 
 * @method static get(string | array $path)
 */
class Information extends Route implements RouteRootInformation {
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
            $authModule->get() ?: []
        );
        // Initialization Starts Here
        self::$allRouteInformation = $mergeAllRouteInformation;
    }

    /**
     * Get Route Information Definition
     * - Title ( Required )
     * - Route Path ( Required )
     * - Route Name ( Required )
     * - View ( Optional )
     * - Is Active ( Required )
     * 
     * @param string | array
     */
    public static function get(string | array $path = [])
    {
        /** Turn given array in results into single object */
        return new UniformResource(self::validateResource($path,self::$allRouteInformation));
    }
}