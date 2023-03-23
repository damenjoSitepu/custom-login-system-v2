<?php 
namespace App\Transcendent\Support\Route\Module;

// Base Class Service
use App\Transcendent\Support\Route\Route;

class Home extends Route {
    /**
     * Route information definition property
     * 
     * @var array<mixed>
     */
    private static $routeInfo = [
        /**
         * Home 
         */
        'home' => [
            /**
             * Home Index View
             */
            'index'         => [
                'title'     => 'home',
                'routePath' => 'home',
                'routeName' => 'authorized.home.dashboard.view.index',
                'view'      => 'authorized.home.index',
                'isActive'  => true
            ],
        ]
    ];

    public function __construct()
    {
        /** Send data needed to parent class */
        parent::__construct(
            /** Name file of this module */
            basename(__FILE__,'.php'),
            /** Route module data needed to be send to the parent class */
            [
            'moduleName'    => 'home',
            'moduleData'    => self::$routeInfo
            ], 
            /** --- */
        );
    }

    /**
     * Get route information from home modules
     * 
     * @return array<mixed>
     */
    public function get()
    {
        return $this->modifyResource();
    }
}