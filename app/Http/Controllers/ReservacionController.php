<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Equipo;
use App\Models\Reservacion;

class ReservacionController extends Controller
{
    //Reservar un equipo
    public function reservar(Request $request, Equipo $equipo)
    {
        $resultado = DB::transaction(function () use ($request, $equipo) {

            //Bloquear el equipo mientras se realiza la operación
            $equipoBloqueado = Equipo::whereKey($equipo->id)
                ->lockForUpdate()
                ->firstOrFail();

            //Comprobar que el equipo esté disponible físicamente
            if ($equipoBloqueado->estado !== 'disponible') {
                return 'mantenimiento';
            }

            // Comprobar que no tenga una reservación activa
            $ocupado = $equipoBloqueado->reservaciones()
                ->where('estado', 'activa')
                ->exists();

            if ($ocupado) {
                return 'ocupado';
            }

            // Registrar la reservación
            Reservacion::create([
                'user_id' => $request->user()->id,
                'equipo_id' => $equipoBloqueado->id,
                'estado' => 'activa'
            ]);
            return 'correcto';
        });

        if ($resultado === 'mantenimiento') {
            return back()->with('error', 'Este equipo está en mantenimiento.');
        }

        if ($resultado === 'ocupado') {
            return back()->with('error', 'Este equipo ya está reservado.');
        }

        return back()->with('success', '¡Equipo reservado correctamente!');
    }

    //Mostrar las reservaciones del estudiante
    public function misReservaciones(Request $request)
    {
        $reservaciones = Reservacion::with('equipo')
            ->where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return view('estudiante.reservaciones', compact('reservaciones'));
    }

    // Cancelar una reservación
    public function cancelar(Request $request, $id)
    {
        $usuarioId = $request->user()->id;

        //Buscar una reservacion que pertenezca al estudiante
        $reservacion = Reservacion::where('id', $id)
            ->where('user_id', $usuarioId)
            ->firstOrFail();

        //Bloquear el equipo para evitar operaciones simultaneas
        DB::transaction(function () use ($reservacion, $usuarioId) {

            Equipo::where('id', $reservacion->equipo_id)
                ->lockForUpdate()
                ->firstOrFail();

            // Volver a consultar y bloquear la reservacion
            $reservacion = Reservacion::where('id', $reservacion->id)
                ->where('user_id', $usuarioId)
                ->lockForUpdate()
                ->firstOrFail();

            //Solamente se pueden cancelar reservaciones activas
            if ($reservacion->estado !== 'activa') {
                return;
            }

            $reservacion->update([
                'estado' => 'cancelada'
            ]);
        });
        return redirect()
            ->route('estudiante.reservaciones')
            ->with('success', 'La reservación fue cancelada correctamente.');
    }
}