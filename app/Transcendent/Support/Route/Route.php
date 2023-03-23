<?php 

namespace App\Transcendent\Support\Route;

// Contracts
use App\Transcendent\Contracts\RouteRoot;
// Tools
use App\Transcendent\Support\Route\Tools\ModifyResource;

class Route implements RouteRoot {
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

    private $modifyResource;

    public function __construct(
        /** Name file of this module */
        string $currentFileNameWithoutExtension = '',
        /** Route module data needed to be send to the parent class */
        array $routeModuleData = [],
        /** --- */
    )
    {
        self::$currentFileNameWithoutExtension = $currentFileNameWithoutExtension;
        if (!empty($routeModuleData)) {
            self::$moduleName = $routeModuleData['moduleName'];
            self::$moduleData = $routeModuleData['moduleData'];
        }

        // Instantiate Tools Needed
        $this->modifyResource = new ModifyResource(self::$moduleName, self::$moduleData,self::$currentFileNameWithoutExtension);
    }

    /**
     * Modify resources of every module name
     * 
     * @return array<mixed>
     */
    public function modifyResource()
    {
        return $this->modifyResource->doModifyResource();
    }
}