<?php 
namespace App\Services\General\Naming;

/**
 * Documentation
 * 
 * @method static string getName()
 * @method static string getAliasName()
 */

class AppNamingService {
    /**
     * App Name Property
     * 
     * @var string
     */
    private const APP_NAME = 'CLS';

    /**
     * App Alias Name Property
     * 
     * @var string
     */
    private const APP_ALIAS_NAME = 'Custom Login System';

    /**
     * Get App Name
     * 
     * @return string
     */
    public static function getName(): string
    {
        return self::APP_NAME;
    }

    /**
     * Get App Alias Name
     * 
     * @return string
     */
    public static function getAliasName(): string
    {
        return self::APP_ALIAS_NAME;
    }
}