<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar reservaciones</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-light">
    <div class="container mt-5">
        <h2 class="mb-4">Administración de reservaciones</h2>
        <a href="{{ url('/admin') }}" class="btn btn-secondary mb-3">Volver al panel</a>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Estudiante</th>
                        <th>Correo</th>
                        <th>Equipo</th>
                        <th>Código</th>
                        <th>Estado</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reservaciones as $reservacion)
                        <tr>
                            <td>{{ $reservacion->usuario->name }}</td>
                            <td>{{ $reservacion->usuario->email }}</td>
                            <td>{{ $reservacion->equipo->nombre }}</td>
                            <td>{{ $reservacion->equipo->codigo }}</td>
                            <td>
                                @if ($reservacion->estado === 'activa')
                                    <span class="badge bg-success">Activa</span>
                                @else
                                    <span class="badge bg-secondary">Cancelada</span>
                                @endif
                            </td>
                            <td>{{ $reservacion->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                @if ($reservacion->estado === 'activa')
                                    <form action="{{ route('admin.reservaciones.cancelar', $reservacion->id) }}"
                                        method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('¿Deseas cancelar esta reservación?')">
                                            Cancelar
                                        </button>
                                    </form>
                                @else
                                    <span class="text-muted">Sin acciones</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">
                                No hay reservaciones registradas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>