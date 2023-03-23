<?php 

namespace App\Transcendent\Support\Route\Tools;

class UniformResource {
    /**
     * Title property
     * 
     * @var string
     */
    public $title;

    /**
     * Route path property
     * 
     * @var string
     */
    public $routePath;

    /**
     * Route name property
     * 
     * @var string
     */
    public $routeName;

    /**
     * View property
     * 
     * @var string
     */
    public $view;

    /**
     * Is active property
     * 
     * @var bool
     */
    public $isActive;

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
        $this->view = $moduleData['view'];
        /** Is Active Status */
        $this->isActive = $moduleData['isActive'];
    }
}