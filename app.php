<?php

! defined('BASE_PATH') && define('BASE_PATH', __DIR__);

require_once BASE_PATH . '/vendor/autoload.php';

use Hyperf\Nano\App;

use function Hyperf\Support\env;
use Hyperf\DbConnection\Db as DB;
use Hyperf\HttpMessage\Stream\SwooleStream;

function app(): App
{
    $app = Hyperf\Nano\Factory\AppFactory::create();
    $app = Hyperf\Nano\Factory\AppFactory::createApp();
    $app->config([
        'databases' => [
            'default' => [
                'driver' => env('DB_DRIVER', 'mysql'),
                'host' => env('DB_HOST', 'mysql'),
                'database' => env('DB_DATABASE', 'app'),
                'port' => env('DB_PORT', 3306),
                'username' => env('DB_USERNAME', 'root'),
                'password' => env('DB_PASSWORD', 'root'),
                'charset' => env('DB_CHARSET', 'utf8'),
                'collation' => env('DB_COLLATION', 'utf8_unicode_ci'),
                'prefix' => env('DB_PREFIX', ''),
                'pool' => [
                    'min_connections' => 1,
                    'max_connections' => 10,
                    'connect_timeout' => 10.0,
                    'wait_timeout' => 3.0,
                    'heartbeat' => -1,
                    'max_idle_time' => (float) env('DB_MAX_IDLE_TIME', 60),
                ],
            ],
        ],
    ]);

    $app->get('/', function () {
        return [
            'data' => "Hello World",
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

    $app->get('/users', function ($_, $response) {
        $usersQuery = DB::table('users')->get();
        $users = $usersQuery->toArray();
        $usersTotal = count($users);

        $data = [
            'items' => array_map(
                callback: fn ($user) => [
                    'name' => $user->name,
                    'email' => $user->email,
                ],
                array: $users
            ),
            'total' => $usersTotal,
        ];

        return $data;

        return $response
            ->withStatus(201)
            ->withHeader('Content-Type', 'application/json')
            ->withBody(new SwooleStream(json_encode($data)));
    });

    return $app;
}
