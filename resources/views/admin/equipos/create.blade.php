<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar equipo</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-light">
    <div class="container mt-5">
        <h2 class="mb-4">Registrar equipo</h2>
        <a href="{{ route('admin.equipos') }}" class="btn btn-secondary mb-3">Volver</a>
        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.equipos.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Código del equipo</label>
                        <input type="text" name="codigo" class="form-control" value="{{ old('codigo') }}" required>

                        @error('codigo')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nombre del equipo</label>
                        <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>

                        @error('nombre')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea name="descripcion" class="form-control" rows="3">{{ old('descripcion') }}</textarea>

                        @error('descripcion')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success">
                        Registrar equipo
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>