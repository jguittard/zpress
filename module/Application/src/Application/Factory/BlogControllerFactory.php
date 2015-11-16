<?php

namespace Application\Factory;

use Application\Controller\BlogController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class BlogControllerFactory
 *
 * @package Application\Factory
 *
 * @author Julien Guittard <julien.g@zend.com>
 * @version 1.0
 */
class BlogControllerFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $services = $serviceLocator->getServiceLocator();
        $postService = $services->get('blog.service.post');
        return new BlogController($postService);
    }

}