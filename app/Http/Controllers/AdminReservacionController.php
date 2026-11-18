<?php

namespace App\Http\Controllers;

use App\Models\Reservacion;
use App\Models\Equipo;
use Illuminate\Support\Facades\DB;

class AdminReservacionController extends Controller
{
    // Consultar todas las reservaciones
    public function index()
    {
        $reservaciones = Reservacion::with(['usuario', 'equipo'])
            ->latest()
            ->get();
        return view('admin.reservaciones.index', compact('reservaciones'));
    }

    //Cancelar una reservación
    public function cancelar($id)
    {
        DB::transaction(function () use ($id) {
            $reservacion = Reservacion::findOrFail($id);

            //Bloquear el equipo mientras se realiza la operación
            Equipo::where('id', $reservacion->equipo_id)
                ->lockForUpdate()
                ->firstOrFail();

            //Volver a consultar y bloquear la reservación
            $reservacion = Reservacion::where('id', $id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($reservacion->estado === 'activa') {
                $reservacion->update([
                    'estado' => 'cancelada'
                ]);
            }
        });

        return redirect()
            ->route('admin.reservaciones')
            ->with('success', 'Reservación cancelada correctamente.');
    }
}