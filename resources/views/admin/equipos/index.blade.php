<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar equipos</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-light">
    <div class="container mt-5">
        <h2 class="mb-4">Administración de equipos</h2>
        <p>Bienvenido, {{ Auth::user()->name }}</p>
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

        <a href="{{ route('admin.equipos.create') }}" class="btn btn-primary mb-3">
            Registrar equipo
        </a>

        <a href="{{ url('/admin') }}" class="btn btn-secondary mb-3">
            Volver al panel
        </a>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($equipos as $equipo)
                    <tr>
                        <td>{{ $equipo->codigo }}</td>
                        <td>{{ $equipo->nombre }}</td>
                        <td>{{ $equipo->descripcion }}</td>
                        <td>{{ $equipo->estado }}</td>
                        <td>
                            <a href="{{ route('admin.equipos.edit', $equipo->id) }}" class="btn btn-warning btn-sm">Editar</a>

                            <form action="{{ route('admin.equipos.destroy', $equipo->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Deseas eliminar este equipo?')">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">
                            No hay equipos registrados.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>