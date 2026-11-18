<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Equipo;

class EquipoSeeder extends Seeder
{
    public function run(): void
    {
        Equipo::updateOrCreate(
            ['codigo' => 'PC-001'],
            [
                'nombre' => 'Computadora Dell',
                'descripcion' => 'Computadora de escritorio Dell',
                'estado' => 'disponible'
            ]
        );

        Equipo::updateOrCreate(
            ['codigo' => 'PC-002'],
            [
                'nombre' => 'Computadora HP',
                'descripcion' => 'Computadora de escritorio HP',
                'estado' => 'disponible'
            ]
        );

        Equipo::updateOrCreate(
            ['codigo' => 'PC-003'],
            [
                'nombre' => 'Computadora Lenovo',
                'descripcion' => 'Computadora de escritorio Lenovo',
                'estado' => 'disponible'
            ]
        );

        Equipo::updateOrCreate(
            ['codigo' => 'LAP-001'],
            [
                'nombre' => 'Laptop Dell',
                'descripcion' => 'Laptop para uso académico',
                'estado' => 'disponible'
            ]
        );

        Equipo::updateOrCreate(
            ['codigo' => 'LAP-002'],
            [
                'nombre' => 'Laptop HP',
                'descripcion' => 'Laptop para actividades escolares',
                'estado' => 'mantenimiento'
            ]
        );
    }
}