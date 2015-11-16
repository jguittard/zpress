<?php
namespace Admin;

return [
    'router' => [
        'routes' => [
            'admin' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/admin',
                    'defaults' => [
                        'controller' => 'Admin\Controller\Dashboard',
                        'action' => 'index',
                    ]
                ]
            ],
        ]
    ],
    'controllers' => [
        'factories' => [
            'Admin\Controller\Dashboard' => Factory\DashboardControllerFactory::class,
        ]
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];