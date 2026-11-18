<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //Mostrar formulario de inicio de sesion
    public function mostrarLogin()
    {
        return view('auth.login');
    }

    // Iniciar sesion
    public function login(Request $request)
    {
        $credenciales = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credenciales)) {
            //Regenerar el ID de sesion
            $request->session()->regenerate();
            //Obtener el usuario autenticado
            $usuario = Auth::user();
            //Redirigir segun su rol
            if ($usuario->rol === 'administrador') {
                return redirect('/admin');
            }
            return redirect('/estudiante');
        }

        return back()->withErrors([
            'email' => 'Las credenciales son incorrectas.'
        ])->onlyInput('email');
    }

    // Cerrar sesion
    public function logout(Request $request)
    {
        Auth::logout();
        // Invalidar la sesión actual
        $request->session()->invalidate();
        // Generar un nuevo token CSRF
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}