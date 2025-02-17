<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Usuarios con datos específicos
        $users = [
            [
                'name' => 'Elias Abisai',
                'last_name' => 'Ramos Jacinto',
                'second_last_name' => null,
                'username' => 'eliasabisai',
                'email' => 'eliasabisai@gmail.com',
                'password' => Hash::make('password123'),
                'status' => 'Activo',
            ],
            [
                'name' => 'Jacqueline',
                'last_name' => 'Miguel Pensamiento',
                'second_last_name' => 'Dominguez',
                'username' => 'jacquelinemiguelpensamiento',
                'email' => 'jacquelinemiguelpensamiento@gmail.com',
                'password' => Hash::make('password123'),
                'status' => 'Activo',
            ],
            [
                'name' => 'Arturo',
                'last_name' => 'Rodriguez Padro',
                'second_last_name' => null,
                'username' => 'arturorodriguez',
                'email' => 'arturorodriguez@gmail.com',
                'password' => Hash::make('password123'),
                'status' => 'Activo',
            ],
            [
                'name' => 'Adrian',
                'last_name' => 'Nuñez',
                'second_last_name' => null,
                'username' => 'adriannunez',
                'email' => 'adriannunez@gmail.com',
                'password' => Hash::make('password123'),
                'status' => 'Activo',
            ],
            [
                'name' => 'Admin',
                'last_name' => 'AdminApellido',
                'second_last_name' => 'AdminSegApellido',
                'username' => 'admin001',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('adminpassword'),
                'status' => 'Activo',
            ],
        ];

        // Insertar usuarios
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
