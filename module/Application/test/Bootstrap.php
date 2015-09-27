<?php

namespace ApplicationTest;

use Zend\Mvc\Service\ServiceManagerConfig;
use Zend\ServiceManager\ServiceManager;
use Zend\Stdlib\ArrayUtils;

/**
 * Test bootstrap, for setting up autoloading
 */
class Bootstrap
{
    protected static $serviceManager;

    protected static $config;

    public static function init()
    {
        chdir(dirname(__DIR__));
        include '../../vendor/autoload.php';
        $appConfig = include  '../../config/application.config.php';

        if (file_exists('../../config/development.config.php')) {
            $appConfig = ArrayUtils::merge($appConfig, include '../../config/development.config.php');
        }
        self::$config = $appConfig;
        $serviceManager = new ServiceManager(new ServiceManagerConfig);
        $serviceManager->setService('ApplicationConfig', self::$config);
        $serviceManager->get('ModuleManager')->loadModules();
        self::$serviceManager = $serviceManager;
    }

    public static function getServiceManager()
    {
        return static::$serviceManager;
    }

    public static function getConfig()
    {
        return static::$config;
    }
}

Bootstrap::init();
