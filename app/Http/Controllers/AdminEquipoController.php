<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipo;

class AdminEquipoController extends Controller
{
    //Mostrar todos los equipos
    public function index()
    {
        $equipos = Equipo::all();
        return view('admin.equipos.index', compact('equipos'));
    }

    //Mostrar formulario para crear un equipo
    public function create()
    {
        return view('admin.equipos.create');
    }

    //Guardar un equipo
    public function store(Request $request)
    {
        $datos = $request->validate([
            'codigo' => 'required|string|max:255|unique:equipos,codigo',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);
        $datos['estado'] = 'disponible';

        Equipo::create($datos);

        return redirect()
            ->route('admin.equipos')
            ->with('success', 'Equipo registrado correctamente.');
    }

    //Mostrar formulario para editar un equipo
    public function edit($id)
    {
        $equipo = Equipo::findOrFail($id);
        return view('admin.equipos.edit', compact('equipo'));
    }

    // Actualizar un equipo
    public function update(Request $request, $id)
    {
        $equipo = Equipo::findOrFail($id);
        $datos = $request->validate([
            'codigo' => 'required|string|max:255|unique:equipos,codigo,' . $equipo->id,
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);
        $equipo->update($datos);

        return redirect()
            ->route('admin.equipos')
            ->with('success', 'Equipo actualizado correctamente.');
    }

    //Eliminar un equipo
    public function destroy($id)
    {
        $equipo = Equipo::findOrFail($id);

        //Comprobar si tiene reservaciones
        if ($equipo->reservaciones()->exists()) {
            return back()->with('error', 'No se puede eliminar este equipo porque tiene reservaciones registradas.');
        }
        $equipo->delete();

        return redirect()
            ->route('admin.equipos')
            ->with('success', 'Equipo eliminado correctamente.');
    }
}