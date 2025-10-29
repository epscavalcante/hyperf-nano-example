<?php

use Src\Application\UseCases\GetListUsers;
use Hyperf\DbConnection\Db;

//beforeAll(fn() => Db::table('users')->truncate());
//beforeEach(fn() => Db::table('users')->truncate());
//afterEach(fn() => Db::table('users')->truncate());
//afterAll(fn() => Db::table('users')->truncate());

test('list users', function () {
    Db::table('users')->insert([
        'name' => 'Test User',
        'email' => uniqid("user") . '@example.com',
    ]);

    Db::table('users')->insert([
        'name' => 'Test User',
        'email' => uniqid("user") . '@example.com',
    ]);

    Db::table('users')->insert([
        'name' => 'Test User',
        'email' => uniqid("user") . '@example.com',
    ]);

    $getListUsers = new GetListUsers();

    var_dump($getListUsers->execute());

    expect(true)->toBeTruthy();
});
