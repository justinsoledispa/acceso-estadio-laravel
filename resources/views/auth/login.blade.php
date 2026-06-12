<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Acceso Estadio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/acceso.css') }}" rel="stylesheet">
</head>

<body class="login-body">

<div class="container d-flex justify-content-center align-items-center min-vh-100 px-3">
    <div class="card login-card shadow-lg">
        <div class="login-header text-center">
            <div class="login-mark">SP</div>
            <h3 class="mb-1">StadPass</h3>
            <p class="mb-0 text-white-50">
                Sistema de Acreditación e Ingreso para Estadios
            </p>
        </div>

        <div class="card-body p-4">
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.post') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Correo electrónico</label>
                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email') }}"
                        placeholder="usuario@test.com"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">Contraseña</label>
                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        placeholder="Ingresa tu contraseña"
                        required
                    >
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2">
                    Iniciar sesión
                </button>
            </form>

            <div class="demo-box small text-muted mt-4">
                <strong>Usuarios demo</strong><br>
                Administrador: admin@test.com / 12345678<br>
                Operador: operador@test.com / 12345678<br>
                Usuario final: usuario@test.com / 12345678
            </div>
        </div>
    </div>
</div>

</body>
</html>