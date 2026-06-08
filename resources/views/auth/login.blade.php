<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Acceso Estadio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark">

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-lg border-0" style="width: 420px;">
        <div class="card-body p-4">
            <h3 class="text-center mb-2">Control de Acceso</h3>
            <p class="text-center text-muted mb-4">Sistema de acreditación para estadio</p>

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="/login">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Correo electrónico</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Contraseña</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    Iniciar sesión
                </button>
            </form>

            <hr>

            <div class="small text-muted">
                <strong>Usuarios demo:</strong><br>
                admin@test.com / 12345678<br>
                operador@test.com / 12345678<br>
                usuario@test.com / 12345678
            </div>
        </div>
    </div>
</div>

</body>
</html>