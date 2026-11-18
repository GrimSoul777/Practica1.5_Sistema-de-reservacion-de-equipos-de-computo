<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Administrador',
                'password' => 'Admin123',
                'rol' => 'administrador'
            ]
        );

        User::updateOrCreate(
            ['email' => 'estudiante@gmail.com'],
            [
                'name' => 'Estudiante de prueba',
                'password' => 'Estudiante123',
                'rol' => 'estudiante'
            ]
        );

        User::updateOrCreate(
            ['email' => 'estudiante2@gmail.com'],
            [
                'name' => 'Estudiante2',
                'password' => 'Estudiante123',
                'rol' => 'estudiante'
            ]
        );
    }
}