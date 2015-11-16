<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2015 ZPress Inc. (https://zpress.io)
 */

return [
    // Development time modules
    'modules' => [
        'DoctrineDataFixtureModule',
    ],
    // development time configuration globbing
    'module_listener_options' => [
        'config_glob_paths' => ['config/autoload/{,*.}{global,local}-development.php'],
        'config_cache_enabled' => false,
        'module_map_cache_enabled' => false,
    ],
];
