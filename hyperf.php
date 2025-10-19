<?php

require_once __DIR__ . '/app.php';

use function Hyperf\Support\env;

$app = app();
$app->config([
    'databases' => [
        'default' => [
            'driver' => env('DB_CONNECTION', 'mysql'),
            'host' => env('DB_HOST', 'mysql'),
            'port' => env('DB_PORT', 3306),
            'database' => env('DB_DATABASE', 'app'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', 'root'),
        ],
    ],
]);
$app->run();