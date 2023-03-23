<?php 

namespace App\Transcendent\Contracts;

/**
 * Documentation
 * 
 * @method static get(string $routeInfo)
 */

interface RouteRootInformation {
    /**
     * Get Route Information Definition
     * - Route Name
     * - View Name
     * - Title Name
     * 
     * @return string
     */
    public static function get(string $routeInfo): string;
}