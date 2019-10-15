<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [[
            'id'             => 1,
            'name'           => 'Admin',
            'email'          => 'admin@admin.com',
            'password'       => '$2y$10$0qUo.fzwyqrCJXcTQ0.Pl.3DWhe/5pODA38gtOQ5W/y33kLKIn70m',
            'remember_token' => null,
            'created_at'     => '2019-09-03 19:10:12',
            'updated_at'     => '2019-09-03 19:10:12',
            'deleted_at'     => null,
        ]];

        User::insert($users);
    }
}
