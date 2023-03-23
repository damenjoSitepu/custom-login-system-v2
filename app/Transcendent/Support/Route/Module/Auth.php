<?php 
namespace App\Transcendent\Support\Route\Module;

// Base Class Service
use App\Transcendent\Support\Route\Route;

class Auth extends Route {
    /**
     * Route information definition property
     * 
     * @var array<mixed>
     */
    private static $routeInfo = [
        /**
         * Auth 
         */
        'auth' => [
            /**
             * Login View
             */
            'login'         => [
                'title'     => 'login',
                'routePath' => 'auth',
                'routeName' => 'guest.auth.login.view.index',
                'view'      => 'guest.auth.login',
                'isActive'  => true
            ],
            /**
             * Registration View
             */
            'registration'  => [
                'title'     => 'registration', 
                'routePath' => 'auth.registration',
                'routeName' => 'guest.auth.registration.view.index',
                'view'      => 'guest.auth.registration',
                'isActive'  => true
            ],
            /**
             * Registration Process
             */
            'signup'        => [
                'title'     => 'sign.up.process',
                'routePath' => 'auth.registration.sign-up',
                'routeName' => 'guest.auth.registration.process.signup',
                'isActive'  => true
            ]
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
            'moduleName'    => 'auth',
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