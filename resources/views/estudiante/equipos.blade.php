<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipos disponibles</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Equipos disponibles</h2>
            <a href="{{ url('/estudiante') }}" class="btn btn-secondary">Regresar</a>
        </div>
        <div class="card shadow border-0">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($equipos->isEmpty())
                    <div class="alert alert-info">
                        No hay equipos disponibles actualmente.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($equipos as $equipo)
                                    <tr>
                                        <td>{{ $equipo->codigo }}</td>
                                        <td>{{ $equipo->nombre }}</td>
                                        <td>{{ $equipo->descripcion }}</td>
                                        <td>
                                            <span class="badge bg-success">{{ $equipo->estado }}</span>
                                        </td>
                                        <td>
                                            <form action="{{ route('estudiante.reservar', $equipo->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-primary btn-sm">Reservar</button>
                                            </form>
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