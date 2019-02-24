<?php
define('APP_ROOT', __DIR__);

return [
    'settings' => [
        'displayErrorDetails' => true,
        'determineRouteBeforeAppMiddleware' => false,
        'doctrine' => [
            'dev_mode' => true,
            // path where the compiled metadata info will be cached
            // make sure the path exists and it is writable
            'cache_dir' => APP_ROOT . '/var/doctrine',

            // you should add any other path containing annotated entity classes
            'metadata_dirs' => [APP_ROOT . '/../entity'],

            'connection' => [
                'driver' => 'pdo_mysql',
                'host' => 'db',
                'port' => 3306,
                'dbname' => 'myDb',
                'user' => 'user',
                'password' => 'test',
                'charset' => 'utf8'
            ]
        ]
    ]
];