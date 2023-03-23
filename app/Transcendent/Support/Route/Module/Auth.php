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
                'title'     => 'registration', 
                'routePath' => 'auth.registration',
                'routeName' => 'guest.auth.registration.view.index',
                'view'      => 'guest.auth.registration',
                'isActive'  => true
            ],
            /**
             * Login
             */
            'login'         => [
                'title'     => 'login',
                'routePath' => 'auth',
                'routeName' => 'guest.auth.login.view.index',
                'view'      => 'guest.auth.login',
                'isActive'  => true
            ],
            /**
             * Registration Process
             */
            'signup'        => [
                'title'     => 'Sign up Process',
                'routePath' => 'auth.registration.sign-up',
                'routeName' => 'guest.auth.registration.process.signup',
                'isActive'  => true
            ]
        ]
    ];

    /**
     * Get route information from home modules
     * 
     * @return array<mixed>
     */
    public function get(): array
    {
        return $this->modifyResource('auth');
        // return self::$routeInfo;
    }

    private function modifyResource($name = 'auth')
    {
        $appName = AppNamingService::getName();
        // Remove module identifier ( title of array module like: 'auth', 'home', etc)
        $moduleWithoutIdentifier = self::$routeInfo[$name];
        // Loop every module data to be modified
        foreach ($moduleWithoutIdentifier as $keyModule => $valueModule) {
            // Make first character of title to be uppercase
            if (isset($valueModule['title'])) {
                if (!empty($valueModule['title'])) {
                    $moduleWithoutIdentifier[$keyModule]['title'] = $appName . ' | ' . ucfirst($valueModule['title']);
                }
            }
            // Modify route path to be the real 'route path'
            if (isset($valueModule['routePath'])) {
                $slashPrefix = '/';
                $replaceDotWithSlash = str_replace('.','/',$valueModule['routePath']);
                $moduleWithoutIdentifier[$keyModule]['routePath'] = $slashPrefix . $replaceDotWithSlash;
            }
            // Modify route name with adding name of applications in lowercase 
            if (isset($valueModule['routeName'])) {
                $moduleWithoutIdentifier[$keyModule]['routeName'] = strtolower($appName) . '.' . $valueModule['routeName'];
            }
            // Modify view with adding name of applications ( application prefix ) in lowercase
            if (isset($valueModule['view'])) {
                $moduleWithoutIdentifier[$keyModule]['view'] = 'application' . '.' . $valueModule['view'];
            }
        }
        // Return back the module data
        self::$routeInfo[$name] = $moduleWithoutIdentifier; 
        return self::$routeInfo;
    }
}