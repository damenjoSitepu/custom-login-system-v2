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
        /** Final Validation */
        return self::matchingRouteInformation();
    }

    /**
     * Check if both of them ( first path and second path ) are empty
     * 
     * @return string
     * @return mixed
     */
    private static function checkEmptyPath(): array | string
    {
        // If Path is empty
        if (empty(self::$path)) {
            /** Get sub path by default ( in first order only ) */ 
            $subPathByDefault = array_key_first(self::$moduleData[self::$defaultPath]);
            return self::$moduleData[self::$defaultPath][$subPathByDefault];
        } 
        return self::KEEP_MOVING;
    }

    private static function matchingRouteInformation()
    {
        /** Will applied for path string type */
        if (is_string(self::$path)) {
            return self::matchingRouteInformationUsingStringType();
        }
        /** Will applied for path array type */
        // return self::matchingRouteInformationUsingArrayType();
    }

    /**
     * Matching route information base on string type
     * 
     * @return mixed
     */
    private static function matchingRouteInformationUsingStringType(): mixed
    {
        /** Separate string path with (.) delimiter */
        $separatePaths = explode('.',self::$path);
        /** Return this error message when path are not found */
        if (! isset(self::$moduleData[$separatePaths[0]])) {
            return RouteInfoService::cannotFindPath($separatePaths[0]);
        }
        /** Matching route algorithm starts here */
        $routeInfo = self::$moduleData[$separatePaths[0]];
        /** When only one main path detected */
        if (count($separatePaths) === 1) {
            /** Check if this main path was exists */
            if (isset($routeInfo)) {
                /** Get sub path by default ( in first order only ) */ 
                $subPathByDefault = array_key_first($routeInfo);
                return $routeInfo[$subPathByDefault];
            }
        } 
        /** 
         * When When path consist of main path, sub path, 
         * and so on, we need to check each of
         * them one by one as well
         */
        if (count($separatePaths) > 1) {
            if (isset($routeInfo)) {
                /** Array Key First From Every Main Path Module Data */
                $subPathByDefault = array_key_first($routeInfo);
                /** Sub path finding for each iteration for the sub main path */
                $subPathFinding = '';
                /** Iteration starts here */
                for ($i = 1; $i < count($separatePaths); $i++) {
                    if (isset($routeInfo[$separatePaths[$i]])) {
                        $subPathFinding = $separatePaths[$i];
                    }
                }
                /** If empty, set sub path by default */
                if (empty($subPathFinding)) {
                    return $routeInfo[$subPathByDefault];
                }
                /** Otherwise */
                return $routeInfo[$subPathFinding];
            }
        }
    }

    private static function matchingRouteInformationUsingArrayType()
    {

    }
}