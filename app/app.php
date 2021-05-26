<?php

use app\exceptions\routeException;

class app {
    public static $router;

    public static $db;

    public static $kernel;

    public static function init()
    {
        spl_autoload_register(['static','loadClass']);
        static::bootstrap();
        set_exception_handler(['app','handleException']);

    }

    public static function bootstrap()
    {
        static::$router = new app\router();
        static::$kernel = new app\kernel();
				static::$db = new app\database();
    }

    public static function loadClass ($className)
    {

        $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
        require_once ROOTPATH.DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR.$className.'.php';

    }

    public static function handleException ( $e)
    {
        if($e instanceof routeException) {
            echo static::$kernel->launchAction('error', 'page404', [$e]);
        }else{
            echo static::$kernel->launchAction('error', 'page500', [$e]);
        }

    }
}