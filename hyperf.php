<?php

require_once __DIR__ . '/vendor/autoload.php';

use Hyperf\Nano\Factory\AppFactory;

use function Hyperf\Support\env;

$app = AppFactory::create();

$app->get('/', function () {
    return [
        'data' => "hello World",
    ];
});

$app->get('/hello', function () {
    $user = env('APP_NAME');
    $method = $this->request->getMethod();

    return [
        'message' => "hello {$user}",
        'method' => $method,
    ];
});

$app->run();