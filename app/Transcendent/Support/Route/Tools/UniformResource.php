<?php 

namespace App\Transcendent\Support\Route\Tools;

class UniformResource {
    public $title;
    public $routePath;
    public $routeName;
    public $view;
    public $isActive;

    public function __construct(array $moduleData) {
        $this->title = $moduleData['title'];
        $this->routePath = $moduleData['routePath'];
        $this->routeName = $moduleData['routeName'];
        $this->view = $moduleData['view'];
        $this->isActive = $moduleData['isActive'];
    }
}