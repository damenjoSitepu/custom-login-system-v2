<?php 

namespace App\Transcendent\Support\Route\Tools; 

// Services
use App\Services\General\Error\Message\RouteInfoService;

class ValidateResource {
    /**
     * Path
     * 
     * @var string
     * @var array
     */
    private static $path = '';

    /**
     * Default Path
     * 
     * @var string
     */
    private static $defaultPath = 'auth';

    /**
     * Route module data properties
     * 
     * @var array<mixed>
     */
    private static $moduleData = [];

    /**
     * Define Which Validation Will Be Continued Or Not
     * 
     * @var string
     */
    private const KEEP_MOVING = 'Go Through Next Validation';

    /**
     * Init All Data Needed
     * 
     * @param array
     * @return void 
     */
    private static function initValue(string | array $path = [], array $moduleData = []): void 
    {
        self::$path = $path;
        self::$moduleData = $moduleData;
    }

    /**
     * Do validate resource
     * 
     * @param string | array
     * @param array
     * @return array<mixed>
     */
    public static function doValidateResource(string | array $path = [], array $moduleData = [])
    {
        /** Init Value */
        self::initValue($path, $moduleData);
        /** First Validation */
        $firstModuleDataResultWithValidation = self::checkEmptyPath();
        if ($firstModuleDataResultWithValidation !== self::KEEP_MOVING) return $firstModuleDataResultWithValidation;

        // Validation
        return self::matchingRouteInformation();
    }

    /**
     * Check if both of them ( first path and second path ) are empty
     * 
     * @return string
     * @return array<mixed>
     */
    private static function checkEmptyPath(): array | string
    {
        // If Path is empty
        if (empty(self::$path)) return self::$moduleData[self::$defaultPath]['registration'];
        return self::KEEP_MOVING;
    }

    private static function matchingRouteInformation()
    {
        if (is_string(self::$path)) {
            return self::matchingRouteInformationUsingStringType();
        }
        // return self::matchingRouteInformationUsingArrayType();
    }

    private static function matchingRouteInformationUsingStringType()
    {
        $separatePaths = explode('.',self::$path);
        if (count($separatePaths) === 1) {
            if (isset(self::$moduleData[self::$path])) {
                /** Get sub path by default ( in first order only ) */ 
                $subPathByDefault = array_key_first(self::$moduleData[self::$path]);
                return self::$moduleData[self::$path][$subPathByDefault];
            }
        }
        return RouteInfoService::cannotFindPath(self::$path);
    }

    private static function matchingRouteInformationUsingArrayType()
    {

    }
}