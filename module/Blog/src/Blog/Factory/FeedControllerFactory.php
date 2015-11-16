<?php

namespace Blog\Factory;

use Blog\Controller\FeedController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class FeedControllerFactory
 *
 * @package Blog\Factory
 */
class FeedControllerFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $controller = new FeedController();
        return $controller;
    }

}