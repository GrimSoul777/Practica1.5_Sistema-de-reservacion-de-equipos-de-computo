<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis reservaciones</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Mis reservaciones</h2>
            <a href="{{ url('/estudiante') }}" class="btn btn-secondary">Regresar</a>
        </div>

        <div class="card shadow border-0">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($reservaciones->isEmpty())
                    <div class="alert alert-info">
                        Todavia no tienes reservaciones.
                    </div>
                @else

                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Codigo</th>
                                    <th>Equipo</th>
                                    <th>Descripcion</th>
                                    <th>Estado</th>
                                    <th>Fecha de reservacion</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reservaciones as $reservacion)
                                    <tr>
                                        <td>{{ $reservacion->equipo->codigo }}</td>
                                        <td>{{ $reservacion->equipo->nombre }}</td>
                                        <td>{{ $reservacion->equipo->descripcion }}</td>
                                        <td>
                                            @if ($reservacion->estado === 'activa')
                                                <span class="badge bg-success">Activa</span>
                                            @elseif ($reservacion->estado === 'cancelada')
                                                <span class="badge bg-danger">Cancelada</span>
                                            @else
                                                <span class="badge bg-secondary">Finalizada</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $reservacion->created_at->format('d/m/Y H:i') }}
                                        </td>
                                        <td>
                                            @if ($reservacion->estado === 'activa')
                                                <form action="{{ route('estudiante.cancelar', $reservacion->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('¿Estás seguro de cancelar esta reservación?')">
                                                        Cancelar
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-muted">Sin acciones</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>