<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel del estudiante</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="card shadow border-0">
            <div class="card-body p-4">
                <h2>Panel del estudiante</h2>
                <p>
                    Bienvenido, {{ Auth::user()->name }}
                </p>

                <p class="text-muted">
                    Desde aquí podrás consultar equipos y realizar reservaciones.
                </p>

                <a href="{{ route('estudiante.equipos') }}" class="btn btn-primary">
                    Consultar equipos disponibles
                </a>

                <a href="{{ route('estudiante.reservaciones') }}" class="btn btn-success">
                    Mis reservaciones
                </a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-danger" type="submit">Cerrar sesion</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
