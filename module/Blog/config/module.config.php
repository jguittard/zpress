<?php
namespace Blog;

use Doctrine\ORM;

return [
    'router' => [
        'routes' => [

        ],
    ],
    'service_manager' => [
        'factories' => [
            'blog.service.post' => Factory\PostServiceFactory::class,
        ],
        'abstract_factories' => [
            Mapper\AbstractFactory::class,
        ],
    ],
    'doctrine' => [
        'driver' => [
            'blog_driver' => [
                'class' => ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [
                    __DIR__ . '/../src/Blog/Entity',
                ],
            ],
            'orm_default' => [
                'drivers' => [
                    'Blog\Entity' => 'blog_driver',
                ],
            ],
        ],
    ],
];