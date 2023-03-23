<?php 
namespace App\Transcendent\Support\Route\Tools;

// Services
use App\Services\General\Naming\AppNamingService;

class ModifyResource {
    /**
     * Child file name properties
     * 
     * @var $childFilename
     */
    private static $currentFileNameWithoutExtension = '';

    /**
     * Module name properties
     * 
     * @var string
     */
    private static $moduleName = '';

    /**
     * Route module data properties
     * 
     * @var array<mixed>
     */
    private static $moduleData = [];

    public function __construct(string $moduleName = '', array $moduleData = [], string $currentFileNameWithoutExtension = '')
    {
        self::$currentFileNameWithoutExtension = $currentFileNameWithoutExtension;
        self::$moduleName = $moduleName;
        self::$moduleData = $moduleData;
    }

    /**
     * Modify resources of every module name
     * 
     * @return array<mixed>
     */
    public function doModifyResource(): array
    {
        /** Validate parameter are empty or not */
        if(empty(self::$moduleName) || empty(self::$moduleData)) {
            throw new \Exception("Something In ". self::$currentFileNameWithoutExtension. " Resource Module Root Is Empty. Please Check It Out...");
        }
        /** Remove module identifier ( title of array module like: 'auth', 'home', etc) */
        $moduleWithoutIdentifier = self::$moduleData[self::$moduleName];
        /** Loop every module data to be modified */
        foreach ($moduleWithoutIdentifier as $keyModule => $valueModule) {
            $this->changeEverySourceValue($keyModule,$valueModule);
        }
        /** Return back the module data */
        return self::$moduleData;
    }

    /**
     * Get default app name 
     * 
     * @param bool $isUpperCase 
     * @return string
     */
    private function getAppName(bool $isUppercase = true): string 
    {
        return $isUppercase ? strtoupper(AppNamingService::getName()) : strtolower(AppNamingService::getName());
    }

    /**
     * Change every source value for module data
     * 
     * @param string
     * @param array $valueModule
     * @return void
     */
    private function changeEverySourceValue(string $keyModule = '', array $valueModule = []): void
    {
            // Change Source Title
            $this->changeSourceTitle($keyModule, $valueModule['title']);
            // Change Route Path 
            $this->changeSourceRoutePath($keyModule, $valueModule['routePath']);
            // Change Route Name
            $this->changeSourceRouteName($keyModule, $valueModule['routeName']);
            // Change View
            $this->changeSourceView($keyModule, isset($valueModule['view']) ? $valueModule['view'] : '');
    }

    /**
     * Change source title 
     * 
     * @param string $keyModule
     * @param string $title
     * @return void
     */
    private function changeSourceTitle(string $keyModule = '',string $title = ''): void
    {
        // Make first character of title to be uppercase
        if (isset($title)) {
            if (!empty($title)) {
                /** Replace all (.) char with space character ( if exists ) */
                $title = str_replace('.',' ',$title);
                self::$moduleData[self::$moduleName][$keyModule]['title'] = $this->getAppName() . ' | ' . ucfirst($title);
            }
        }
    }

    /**
     * Change source route path
     * 
     * @param string $keyModule
     * @param string $routePath
     * @return void
     */
    private function changeSourceRoutePath(string $keyModule = '', string $routePath = ''): void 
    {
        // Modify route path to be the real 'route path'
        if (isset($routePath)) {
            $slashPrefix = '/';
            $replaceDotWithSlash = str_replace('.','/',$routePath);
            self::$moduleData[self::$moduleName][$keyModule]['routePath'] = $slashPrefix . $replaceDotWithSlash;
        }
    }

    /**
     * Change source route name
     * 
     * @param string $keyModule
     * @param string $routeName
     * @return void
     */
    private function changeSourceRouteName(string $keyModule = '', string $routeName = ''): void 
    {
        // Modify route name with adding name of applications in lowercase 
        if (isset($routeName)) {
            self::$moduleData[self::$moduleName][$keyModule]['routeName'] = $this->getAppName(false) . '.' . $routeName;
        }
    }

    /**
     * Change source view
     * 
     * @param string $keyModule
     * @param string $view
     * @return void
     */
    private function changeSourceView(string $keyModule = '', string $view = ''): void 
    {
        // Modify view with adding name of applications ( application prefix ) in lowercase
        if (!empty($view)) {
            self::$moduleData[self::$moduleName][$keyModule]['view'] = 'application' . '.' . $view;
        }
    }
}