<?php 

namespace App\Services\General\Error\Message;

/**
 * Documentation
 * 
 * @method static cannotFindPath(string $pathName)
 */

class RouteInfoService {
    /**
     * Error Message 
     * 
     * @param string
     */
    public static function cannotFindPath(string $pathName = '')
    {
        return throw new \Exception("We've trying hard as we can, but we cannot find path: [{$pathName}] on the route information that you've give before...");
    }
}