<?php 

namespace App\Transcendent\Support\Route\Tools; 

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
    public static function doValidateResource(string | array $path = [], array $moduleData = []): array
    {
        // Init Value
        self::initValue($path, $moduleData);
        // First Validation
        $firstModuleDataResultWithValidation = self::checkEmptyPath();
        if ($firstModuleDataResultWithValidation !== self::KEEP_MOVING) return $firstModuleDataResultWithValidation;

        return [];
    }

    /**
     * Check if both of them ( first path and second path ) are empty
     * 
     * @return string
     * @return array<mixed>
     */
    public static function checkEmptyPath(): array | string
    {
        // If Path is empty
        if (empty(self::$path)) return self::$moduleData[self::$defaultPath]['registration'];
        return self::KEEP_MOVING;
    }
}