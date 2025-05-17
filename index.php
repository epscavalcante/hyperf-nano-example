<?php

require_once __DIR__ . '/vendor/autoload.php';

use Hyperf\Nano\Factory\AppFactory;

$app = AppFactory::create('0.0.0.0', 9501);

$app->get('/', function () {
    return [
        'data' => "hello World",
    ];
});

$app->get('/hello', function () {
    $user = $this->request->input('user', 'nano');
    $method = $this->request->getMethod();

    return [
        'message' => "hello {$user}",
        'method' => $method,
    ];
});

$app->run();