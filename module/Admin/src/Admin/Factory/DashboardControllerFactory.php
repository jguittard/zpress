<?php

namespace Admin\Factory;

use Admin\Controller\DashboardController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class DashboardControllerFactory
 *
 * @package Admin\Factory
 *
 * @author Julien Guittard <julien.g@zend.com>
 * @version 1.0
 */
class DashboardControllerFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $controller = new DashboardController();
        return $controller;
    }

}