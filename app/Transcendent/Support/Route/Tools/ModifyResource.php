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
     * @var array<string>
     */
    private static $moduleName = [];

    /**
     * Route module data properties
     * 
     * @var array<mixed>
     */
    private static $moduleData = [];

    public function __construct(array $moduleName = [], array $moduleData = [], string $currentFileNameWithoutExtension = '')
    {
        // self::$currentFileNameWithoutExtension = $currentFileNameWithoutExtension;
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
        /** Validate parameter are empty or not ( For Every Main Path Iteration ) */
        self::checkEachMainPathOnCertainModule();
        /** Loop every module data to be modified ( Adding mainPath key to every main module iteration ) */
        foreach (self::$moduleData as $mainPathName => $valueModule) {
            if (array_key_exists('isModify',self::$moduleData[$mainPathName])) continue;
            foreach (self::$moduleData[$mainPathName] as $subPathName => $subValueModule) {
                if (! isset(self::$moduleData[$mainPathName][$subPathName]['isModify'])) {
                    $this->changeEverySourceValue($mainPathName,$subPathName, $subValueModule);
                }
            }
        }
        /** Return back the module data and remove isModify Modifier Too */
        return array_map(function($moduleData) {
            unset($moduleData['isModify']);
            return $moduleData;
        },self::$moduleData);
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
    private function changeEverySourceValue(string $mainPathName = '', string $subPathName = '', array $valueModule = []): void
    {
        /** Mark this data has been edited */
        if (!array_key_exists('isModify',self::$moduleData[$mainPathName])) self::$moduleData[$mainPathName]['isModify'] = true;
        // Change Source Title
        $this->changeSourceTitle($mainPathName, $subPathName, $valueModule['title']);
        // Change Route Path 
        $this->changeSourceRoutePath($mainPathName, $subPathName, $valueModule['routePath']);
        // Change Route Name
        $this->changeSourceRouteName($mainPathName, $subPathName, $valueModule['routeName']);
        // Change View
        $this->changeSourceView($mainPathName, $subPathName, isset($valueModule['view']) ? $valueModule['view'] : '');
    }

    /**
     * Change source title 
     * 
     * @param string $keyModule
     * @param string $title
     * @return void
     */
    private function changeSourceTitle(string $mainPathName = '', string $subPathName = '',string $title = ''): void
    {
        // Make first character of title to be uppercase
        if (isset($title)) {
            if (!empty($title)) {
                /** Replace all (.) char with space character ( if exists ) */
                $title = str_replace('.',' ',$title);
                self::$moduleData[$mainPathName][$subPathName]['title'] = $this->getAppName() . ' | ' . ucfirst($title);
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
    private function changeSourceRoutePath(string $mainPathName = '', string $subPathName = '', string $routePath = ''): void 
    {
        // Modify route path to be the real 'route path'
        if (isset($routePath)) {
            $slashPrefix = '/';
            $replaceDotWithSlash = str_replace('.','/',$routePath);
            self::$moduleData[$mainPathName][$subPathName]['routePath'] = $slashPrefix . $replaceDotWithSlash;
        }
    }

    /**
     * Change source route name
     * 
     * @param string $keyModule
     * @param string $routeName
     * @return void
     */
    private function changeSourceRouteName(string $mainPathName = '', string $subPathName = '', string $routeName = ''): void 
    {
        // Modify route name with adding name of applications in lowercase 
        if (isset($routeName)) {
            self::$moduleData[$mainPathName][$subPathName]['routeName'] = $this->getAppName(false) . '.' . $routeName;
        }
    }

    /**
     * Change source view
     * 
     * @param string $keyModule
     * @param string $view
     * @return void
     */
    private function changeSourceView(string $mainPathName = '', string $subPathName = '', string $view = ''): void 
    {
        // Modify view with adding name of applications ( application prefix ) in lowercase
        if (!empty($view)) {
            self::$moduleData[$mainPathName][$subPathName]['view'] = 'application' . '.' . $view;
        }
    }

    /**
     * Validate parameter are empty or not ( For Every Main Path Iteration )
     * 
     * @return void
     */
    private function checkEachMainPathOnCertainModule()
    {
        for ($i = 0; $i < count(self::$moduleName); $i++) {
            /** If route main path in certain module was not exists */
            if (! isset(self::$moduleData[self::$moduleName[$i]])) {
                throw new \Exception("Main Default Path: [". ucfirst(strtolower(self::$moduleName[$i])) . "] Module Was Not Exists.");
                break;
            }
            /** If Main path contains empty array */
            if (empty(self::$moduleData[self::$moduleName[$i]])) {
                throw new \Exception("Route Information In ". ucfirst(strtolower(self::$moduleName[$i])) . " Resource Module Root Are Empty. Please Check It Out...");
                break;
            }
        }
    }
}