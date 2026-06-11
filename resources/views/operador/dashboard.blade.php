@extends('layouts.app')

@section('title', 'Dashboard operador')

@section('content')
<div class="page-header">
    <div>
        <div class="page-kicker">Operador de acreditación</div>
        <h1 class="page-title">Panel operativo</h1>
        <p class="page-subtitle">
            Gestiona usuarios finales, emite credenciales y consulta las acreditaciones disponibles.
        </p>
    </div>
</div>

<div class="action-grid">
    <div class="action-card">
        <div>
            <div class="action-card-label">Usuarios</div>
            <h3>Registrar usuario final</h3>
            <p>
                Crea usuarios que podrán recibir una credencial digital para acceder al estadio.
            </p>
        </div>

        <a href="{{ route('operador.usuarios.create') }}" class="btn btn-primary">
            Registrar usuario
        </a>
    </div>

    <div class="action-card">
        <div>
            <div class="action-card-label">Credenciales</div>
            <h3>Emitir credencial</h3>
            <p>
                Asocia un usuario, un partido y un tipo de acreditación dentro del sistema.
            </p>
        </div>

        <a href="{{ route('operador.credenciales.create') }}" class="btn btn-primary">
            Emitir credencial
        </a>
    </div>

    <div class="action-card">
        <div>
            <div class="action-card-label">Consulta</div>
            <h3>Ver credenciales emitidas</h3>
            <p>
                Revisa el estado de las credenciales y accede a sus acciones principales.
            </p>
        </div>

        <a href="{{ route('operador.credenciales.index') }}" class="btn btn-outline-primary">
            Ver credenciales
        </a>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header">
        Flujo recomendado
    </div>

    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-4">
                <strong>1. Registrar usuario</strong>
                <p class="text-muted mb-0">
                    Primero se crea el usuario final con sus datos básicos.
                </p>
            </div>

            <div class="col-md-4">
                <strong>2. Emitir credencial</strong>
                <p class="text-muted mb-0">
                    Luego se genera la credencial vinculada a un partido.
                </p>
            </div>

            <div class="col-md-4">
                <strong>3. Validar acceso</strong>
                <p class="text-muted mb-0">
                    El usuario podrá simular su ingreso desde su propio panel.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection