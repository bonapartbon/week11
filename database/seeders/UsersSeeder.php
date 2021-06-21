<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'role' => 'admin',
                'password' => '$2y$10$jPRodq6Ap/76kzGXlJgdMeImZUCmJxHz5z1ojMD3ZNNO9ukVzF0ie'
            ],
            [
                'name' => 'Editor',
                'email' => 'editor@gmail.com',
                'role' => 'editor',
                'password' => '$2y$10$XDKpzB/YJimydWxfC24tJeDc9oVTzCASXbd7p1duVItwWHvRSKMdu'
            ]
        ];

        User::insert($users);
    }
}
