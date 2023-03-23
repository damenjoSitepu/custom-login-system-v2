<?php 

namespace App\Transcendent\Support\Route\Tools;

use stdClass;

class UniformResource {
    /**
     * Title property
     * 
     * @var string
     */
    private $title;

    /**
     * Route path property
     * 
     * @var string
     */
    private $routePath;

    /**
     * Route name property
     * 
     * @var string
     */
    private $routeName;

    /**
     * View property
     * 
     * @var string
     */
    private $view;

    /**
     * Is active property
     * 
     * @var bool
     */
    private $isActive;

    /**
     * Uniform the resources
     */
    public function __construct(array $moduleData) {
        /** Title */
        $this->title = $moduleData['title'];
        /** Route Path */
        $this->routePath = $moduleData['routePath'];
        /** Route Name */
        $this->routeName = $moduleData['routeName'];
        /** View */
        $this->view = isset($moduleData['view']) ? $moduleData['view'] : null;
        /** Is Active Status */
        $this->isActive = $moduleData['isActive'];
    }

    /**
     * Uniform data 
     * 
     * @return stdClass
     */
    public function data(): stdClass 
    {
        $serializeData = new stdClass();
        $serializeData->title = $this->title;
        $serializeData->routePath = $this->routePath;
        $serializeData->routeName = $this->routeName;
        if (!empty($this->view)) {
            $serializeData->view = $this->view;
        }
        $serializeData->isActive = $this->isActive;
        return $serializeData;
    }
}