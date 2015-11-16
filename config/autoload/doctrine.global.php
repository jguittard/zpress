<?php
return [
    'doctrine' => [
        'entitymanager' => [
            'orm_default' => [
                'connection'    => 'orm_default',
                'configuration' => 'orm_default',
            ],
        ],
        'configuration' => [
            'orm_default' => [
                'proxy_dir'         => __DIR__ . '/../../data/orm/proxies',
                'proxy_namespace'   => 'Orm\Resource\Proxy',
                'generate_proxies'  => false,
                'metadata_cache'    => 'array',
                'query_cache'       => 'array',
                'result_cache'      => 'array',
                'driver'            => 'orm_default',
            ],
        ],
        'migrations_configuration' => [
            'orm_default' => [
                'directory' => __DIR__ . '/../../data/orm/migrations',
                'name'      => 'Doctrine_Sandbox_Migrations',
                'namespace' => 'DoctrineMigrations',
                'table'     => 'doctrine_migration_versions',
            ],
        ],
        'eventmanager' => [
            'orm_default' => [
                'subscribers' => [
                    'Gedmo\Timestampable\TimestampableListener',
                    'Gedmo\SoftDeleteable\SoftDeleteableListener',
                    'Gedmo\Sluggable\SluggableListener',
                ],
            ],
        ],
    ],
];