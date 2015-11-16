<?php

namespace Blog\Factory;

use Blog\Service\Post;
use Blog\Entity\Post as PostEntity;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class PostServiceFactory
 *
 * @package Blog\Factory
 *
 * @author Julien Guittard <julien.g@zend.com>
 * @version 1.0
 */
class PostServiceFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var \Application\Doctrine\Mapper\DoctrineMapperInterface $mapper */
        $mapper = $serviceLocator->get('blog.mapper.post');
        $postService = new Post($mapper);
        $postService->setEntityClass(PostEntity::class);
        return $postService;
    }

}