<?php

namespace App\Http\Controllers;

use App\Models\Equipo;

class EquipoController extends Controller
{
    // Mostrar equipos disponibles
    public function equiposDisponibles()
    {
        $equipos = Equipo::where('estado', 'disponible')
            ->whereDoesntHave('reservaciones', function ($consulta) {
                $consulta->where('estado', 'activa');
            })
            ->get();

        return view('estudiante.equipos', compact('equipos'));
    }
}