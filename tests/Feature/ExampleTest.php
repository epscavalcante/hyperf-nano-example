<?php

use Hyperf\DbConnection\Db;

test('example', function () {
    $response = $this->get('/');
    $response->assertOk();
    $response->assertJson([
        'data' => 'Hello World'
    ]);
});

test('example 2', function () {
    $response = $this->get('/hello');
    $response->assertOk();
    $response->assertJson([
        'message' => 'hello HyperF Nano',
        'method' => 'GET'
    ]);
});

test('example 3', function () {
    Db::table('users')->truncate();
    $email = uniqid() . 'email.com';
    Db::table('users')->insert([
        'name' => 'Test User',
        'email' => $email,
    ]);
    $response = $this->get('/users');
    $response->assertOk();
    $response->assertJson([
        'total' => 1,
        'items' => [
            [
                'name' => 'Test User',
                'email' => $email,
            ]
        ]
    ]);
});
