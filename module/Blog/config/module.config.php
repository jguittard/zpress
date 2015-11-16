<?php
namespace Blog;

use Doctrine\ORM;

return [
    'router' => [
        'routes' => [
            'blog' => [
                'child_routes' => [
                    'feed-rss' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/rss',
                            'default' => [
                                'controller' => 'Blog\Controller\Feed',
                                'action' => 'rss',
                            ],
                        ],
                    ],
                    'feed-atom' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/atom',
                            'default' => [
                                'controller' => 'Blog\Controller\Feed',
                                'action' => 'atom',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            'Blog\Controller\Feed' => Factory\FeedControllerFactory::class,
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