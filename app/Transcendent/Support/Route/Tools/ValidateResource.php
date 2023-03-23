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
        $routeInfo = self::$moduleData;
        if (count($separatePaths) === 1) {
            if (isset($routeInfo[self::$path])) {
                /** Get sub path by default ( in first order only ) */ 
                $subPathByDefault = array_key_first($routeInfo[self::$path]);
                return $routeInfo[self::$path][$subPathByDefault];
            }
        } else if (count($separatePaths) > 1) {
            if (isset($routeInfo[$separatePaths[0]])) {
                $subPathByResult = '';
                for ($i = 1; $i < count($separatePaths); $i++) {
                    /**
                     * If only two paths detected, and the first iteration
                     * was return false, we need to return module data
                     * with path[0] and subPath are set by default
                     */
                    if ($i === (count($separatePaths) - 1) && count($separatePaths) === 2 && !isset($routeInfo[$separatePaths[0]][$separatePaths[$i]])) {
                        $subPathByResult = array_key_first($routeInfo[$separatePaths[0]]);
                        break;
                    }
                    /**
                     * If more than two path detected, and the next iteration
                     * return false, we need to return subPath - 1
                     * (previously sub path) as well
                     */
                    if ($i > 1 && !isset($routeInfo[$separatePaths[0]][$separatePaths[$i]])) {
                        $subPathByResult = $separatePaths[$i - 1];
                        break;
                    }
                    /** If until last iteration, path has been found */
                    if (isset($routeInfo[$separatePaths[0]][$separatePaths[$i]])) {
                        $subPathByResult = $separatePaths[$i];
                    }
                }
                return $routeInfo[$separatePaths[0]][$subPathByResult];
            }
        }
        /** Return this error message when path are not found */
        return RouteInfoService::cannotFindPath($separatePaths[0]);
    }

    private static function matchingRouteInformationUsingArrayType()
    {

    }
}