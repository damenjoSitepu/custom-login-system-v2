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
        return throw new \Exception("Main path: [$pathName] was not found on our directories. Please try to check our these listed modules in this directories as well:");
    }
}