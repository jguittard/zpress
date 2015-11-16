<?php

return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => [
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Home',
                        'action'     => 'index',
                    ),
                ],
            ],
            'blog' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/blog',
                ],
                'may_terminate' => false,
                'child_routes' => [
                    'post' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/:slug',
                            'defaults' => [
                                'controller' => 'Application\Controller\Blog',
                                'action' => 'post'
                            ]
                        ]
                    ]
                ]
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            'Application\Controller\Home' => \Application\Factory\HomeControllerFactory::class,
            'Application\Controller\Blog' => \Application\Factory\BlogControllerFactory::class,
        ]
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/home/index' => __DIR__ . '/../view/application/home/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];