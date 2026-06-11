<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Acceso Estadio')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/acceso.css') }}" rel="stylesheet">
</head>

<body>
@php
    $role = auth()->user()->rol->nombre ?? '';
    $userName = auth()->user()->name ?? 'Usuario';
@endphp

<nav class="navbar app-topbar px-4 py-3">
    <div class="container-fluid px-0">
        <a class="app-brand" href="#">
            <span class="app-brand-icon">▣</span>
            <span>Sistema de Acreditación</span>
        </a>

        <div class="d-flex align-items-center gap-3">
            <div class="app-user-box">
                <strong>{{ $userName }}</strong><br>
                <small>{{ $role }}</small>
            </div>

            <span class="badge badge-role d-none d-md-inline">
                {{ $role }}
            </span>

            <form method="POST" action="{{ route('logout') }}" class="m-0">
                @csrf
                <button class="btn btn-outline-light btn-sm">
                    Cerrar sesión
                </button>
            </form>
        </div>
    </div>
</nav>

<div class="container-fluid app-shell">
    <div class="row g-0">
        <aside class="col-md-3 col-xl-2 app-sidebar">
            <div class="sidebar-title">Panel de control</div>

            <div class="list-group app-nav">
                @if($role === 'Administrador')
                    <a href="{{ route('admin.dashboard') }}"
                       class="list-group-item list-group-item-action {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        Dashboard
                    </a>

                    <a href="{{ route('admin.estadios.index') }}"
                       class="list-group-item list-group-item-action {{ request()->routeIs('admin.estadios.*') ? 'active' : '' }}">
                        Estadios
                    </a>

                    <a href="{{ route('admin.partidos.index') }}"
                       class="list-group-item list-group-item-action {{ request()->routeIs('admin.partidos.*') ? 'active' : '' }}">
                        Partidos
                    </a>

                    <a href="{{ route('admin.tipos_acreditacion.zonas') }}"
                       class="list-group-item list-group-item-action {{ request()->routeIs('admin.tipos_acreditacion.*') ? 'active' : '' }}">
                        Permisos por tipo
                    </a>

                    <a href="{{ route('admin.reportes') }}"
                       class="list-group-item list-group-item-action {{ request()->routeIs('admin.reportes') ? 'active' : '' }}">
                        Reportes
                    </a>
                @endif

                @if($role === 'Operador de acreditación')
                    <a href="{{ route('operador.dashboard') }}"
                       class="list-group-item list-group-item-action {{ request()->routeIs('operador.dashboard') ? 'active' : '' }}">
                        Dashboard
                    </a>

                    <a href="{{ route('operador.usuarios.index') }}"
                       class="list-group-item list-group-item-action {{ request()->routeIs('operador.usuarios.*') ? 'active' : '' }}">
                        Usuarios
                    </a>

                    <a href="{{ route('operador.credenciales.index') }}"
                       class="list-group-item list-group-item-action {{ request()->routeIs('operador.credenciales.*') ? 'active' : '' }}">
                        Credenciales
                    </a>
                @endif

                @if($role === 'Usuario final')
                    <a href="{{ route('usuario.credencial') }}"
                       class="list-group-item list-group-item-action {{ request()->routeIs('usuario.credencial') ? 'active' : '' }}">
                        Mi credencial
                    </a>

                    <a href="{{ route('usuario.simular-ingreso.seleccionar') }}"
                       class="list-group-item list-group-item-action {{ request()->routeIs('usuario.simular-ingreso*') ? 'active' : '' }}">
                        Simular ingreso
                    </a>

                    <a href="{{ route('usuario.historial') }}"
                       class="list-group-item list-group-item-action {{ request()->routeIs('usuario.historial') ? 'active' : '' }}">
                        Mi historial
                    </a>
                @endif
            </div>
        </aside>

        <main class="col-md-9 col-xl-10 app-main">
            @if(session('success'))
                <div class="alert alert-success shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger shadow-sm">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>

</body>
</html>