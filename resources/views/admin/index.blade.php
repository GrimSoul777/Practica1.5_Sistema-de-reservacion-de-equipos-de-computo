<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de administrador</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="card shadow border-0">
            <div class="card-body p-4">
                <h2>Panel de administrador</h2>
                <p>Bienvenido, {{ Auth::user()->name }}</p>

                <p class="text-muted">Desde aqui podrás administrar los equipos y las reservaciones.</p>

                <a href="{{ route('admin.equipos') }}" class="btn btn-primary">
                    Administrar equipos
                </a>

                <a href="{{ route('admin.reservaciones') }}" class="btn btn-success">
                    Consultar reservaciones
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