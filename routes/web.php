<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\ReservacionController;
use App\Http\Controllers\AdminEquipoController;
use App\Http\Controllers\AdminReservacionController;

// Página principal
Route::get('/', function () {
    return redirect('/login');
});

// Mostrar formulario de inicio de sesión
Route::get('/login', [AuthController::class, 'mostrarLogin'])
    ->name('login')
    ->middleware('guest');

// Procesar inicio de sesión
Route::post('/login', [AuthController::class, 'login'])
    ->name('login.post')
    ->middleware('guest');

// Cerrar sesión
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// Panel del administrador
Route::get('/admin', function () {
    return view('admin.index');
})->middleware(['auth', 'rol:administrador']);

// Panel del estudiante
Route::get('/estudiante', function () {
    return view('estudiante.index');
})->middleware(['auth', 'rol:estudiante']);

// Consultar equipos disponibles
Route::get('/estudiante/equipos', [EquipoController::class, 'equiposDisponibles'])
    ->middleware(['auth', 'rol:estudiante'])
    ->name('estudiante.equipos');

// Reservar un equipo
Route::post('/estudiante/equipos/{equipo}/reservar', [ReservacionController::class, 'reservar'])
    ->middleware(['auth', 'rol:estudiante'])
    ->name('estudiante.reservar');

// Consultar mis reservaciones
Route::get('/estudiante/reservaciones', [ReservacionController::class, 'misReservaciones'])
    ->middleware(['auth', 'rol:estudiante'])
    ->name('estudiante.reservaciones');

// Cancelar una reservación
Route::post('/estudiante/reservaciones/{id}/cancelar', [ReservacionController::class, 'cancelar'])
    ->middleware(['auth', 'rol:estudiante'])
    ->name('estudiante.cancelar');

// Administración de equipos
Route::middleware(['auth', 'rol:administrador'])->group(function () {
    // Consultar equipos
    Route::get('/admin/equipos', [AdminEquipoController::class, 'index'])
        ->name('admin.equipos');

    // Mostrar formulario de registro
    Route::get('/admin/equipos/crear', [AdminEquipoController::class, 'create'])
        ->name('admin.equipos.create');

    // Guardar equipo
    Route::post('/admin/equipos', [AdminEquipoController::class, 'store'])
        ->name('admin.equipos.store');

    // Mostrar formulario de edición
    Route::get('/admin/equipos/{id}/editar', [AdminEquipoController::class, 'edit'])
        ->name('admin.equipos.edit');

    // Actualizar equipo
    Route::put('/admin/equipos/{id}', [AdminEquipoController::class, 'update'])
        ->name('admin.equipos.update');

    // Eliminar equipo
    Route::delete('/admin/equipos/{id}', [AdminEquipoController::class, 'destroy'])
        ->name('admin.equipos.destroy');
});

// Administración de reservaciones
Route::middleware(['auth', 'rol:administrador'])->group(function () {

    Route::get('/admin/reservaciones', [AdminReservacionController::class, 'index'])
        ->name('admin.reservaciones');

    Route::post('/admin/reservaciones/{id}/cancelar', [AdminReservacionController::class, 'cancelar'])
        ->name('admin.reservaciones.cancelar');

});