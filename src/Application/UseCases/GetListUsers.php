<?php

namespace Src\Application\UseCases;

use Hyperf\DbConnection\Db;

class GetListUsers
{
    public function execute(): array
    {
        $users = Db::table('users')->get();

        return array_map(
            callback: fn($user) => [
                'name' => $user->name,
                'email' => $user->email,
            ],
            array: $users->toArray()
        );
    }
}