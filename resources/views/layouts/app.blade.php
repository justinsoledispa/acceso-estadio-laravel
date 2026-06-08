<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Acceso Estadio')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-dark px-4">
    <span class="navbar-brand mb-0 h1">Acceso Estadio</span>

    <div class="d-flex align-items-center gap-3">
        <span class="text-white">
            {{ auth()->user()->name ?? '' }}
            <small class="text-secondary">
                {{ auth()->user()->rol->nombre ?? '' }}
            </small>
        </span>

        <form method="POST" action="/logout" class="m-0">
            @csrf
            <button class="btn btn-outline-light btn-sm">Cerrar sesión</button>
        </form>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <aside class="col-md-3 col-lg-2 bg-white border-end min-vh-100 p-3">
            <h6 class="text-muted">Menú</h6>

            <div class="list-group">
                @if(auth()->user()->rol->nombre === 'Administrador')
                    <a href="/admin/dashboard" class="list-group-item list-group-item-action">Dashboard</a>
                    <a href="#" class="list-group-item list-group-item-action">Estadios</a>
                    <a href="#" class="list-group-item list-group-item-action">Partidos</a>
                    <a href="#" class="list-group-item list-group-item-action">Permisos por tipo</a>
                    <a href="#" class="list-group-item list-group-item-action">Reportes</a>
                @endif

                @if(auth()->user()->rol->nombre === 'Operador de acreditación')
                    <a href="/operador/dashboard" class="list-group-item list-group-item-action">Dashboard</a>
                    <a href="#" class="list-group-item list-group-item-action">Usuarios</a>
                    <a href="#" class="list-group-item list-group-item-action">Credenciales</a>
                @endif

                @if(auth()->user()->rol->nombre === 'Usuario final')
                    <a href="/usuario/credencial" class="list-group-item list-group-item-action">Mi credencial</a>
                    <a href="#" class="list-group-item list-group-item-action">Simular ingreso</a>
                    <a href="#" class="list-group-item list-group-item-action">Mi historial</a>
                @endif
            </div>
        </aside>

        <main class="col-md-9 col-lg-10 p-4">
            @yield('content')
        </main>
    </div>
</div>

</body>
</html>