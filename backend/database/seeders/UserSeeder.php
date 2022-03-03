<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(User $user)
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
            'phone' => '99999999999',
            'image' => null,
        ]);

        $user = User::create([
            'name' => 'Teste',
            'email' => 'teste@gmail.com',
            'password' => bcrypt('123456'),
            'phone' => '99999999999',
            'image' => null,
        ]);

        $user = User::create([
            'name' => 'Teste 2',
            'email' => 'teste2@gmail.com',
            'password' => bcrypt('123456'),
            'phone' => '99999999999',
            'image' => null,
        ]);

        $user = User::create([
            'name' => 'Teste 3',
            'email' => 'teste3@gmail.com',
            'password' => bcrypt('123456'),
            'phone' => '99999999999',
            'image' => null,
        ]);
    }
}
