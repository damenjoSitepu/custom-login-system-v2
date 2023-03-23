<?php 
namespace App\Transcendent\Support\Route\Module;

// Services
use App\Services\General\Naming\AppNamingService;

class Auth {
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
             * Registration
             */
            'registration'  => [
                'title'     => 'Registration', 
                'routePath' => '/registration',
                'routeName' => 'application.guest.auth.registration.view.index',
                'view'      => 'application.guest.auth.registration',
                'isActive'  => true
            ],
            /**
             * Login
             */
            'login'         => [
                'title'     => 'Login',
                'routePath' => '/',
                'routeName' => 'application.guest.auth.login.view.index',
                'view'      => 'application.guest.auth.login',
                'isActive'  => true
            ],
        ]
    ];

    /**
     * Get route information from home modules
     * 
     * @return array<mixed>
     */
    public function get(): array
    {
        return self::$routeInfo;
    }
}