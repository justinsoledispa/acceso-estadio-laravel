@extends('layouts.app')

@section('title', 'Usuarios finales')

@section('content')
<div class="page-header">
    <div>
        <div class="page-kicker">Gestión de usuarios</div>
        <h1 class="page-title">Usuarios finales</h1>
        <p class="page-subtitle">
            Listado de usuarios registrados por el operador de acreditación.
        </p>
    </div>

    <a href="{{ route('operador.usuarios.create') }}" class="btn btn-primary">
        Registrar usuario
    </a>
</div>

<div class="card data-card">
    <div class="data-toolbar">
        <div>
            <div class="data-toolbar-title">Registro de usuarios finales</div>
            <p class="data-toolbar-subtitle">
                Consulta los datos básicos de los usuarios que pueden recibir credenciales digitales.
            </p>
        </div>
    </div>

    <div class="card-body">
        @if($usuarios->isEmpty())
            <div class="empty-state">
                <h5 class="empty-state-title">Todavía no hay usuarios finales registrados</h5>
                <p class="empty-state-text">
                    Cuando registres un usuario final, aparecerá en este listado.
                </p>

                <a href="{{ route('operador.usuarios.create') }}" class="btn btn-primary">
                    Registrar primer usuario
                </a>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-clean align-middle">
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Documento</th>
                            <th>Teléfono</th>
                            <th>Estado</th>
                            <th class="text-center">Credenciales</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($usuarios as $usuario)
                            <tr>
                                <td>
                                    <div class="user-cell">
                                        <strong>
                                            {{ $usuario->name }}
                                            {{ $usuario->apellido }}
                                        </strong>
                                        <small>{{ $usuario->email }}</small>
                                    </div>
                                </td>

                                <td>
                                    @if($usuario->documento)
                                        <span class="code-pill">
                                            {{ $usuario->documento }}
                                        </span>
                                    @else
                                        <span class="text-muted">Sin documento</span>
                                    @endif
                                </td>

                                <td>
                                    {{ $usuario->telefono ?? 'Sin teléfono' }}
                                </td>

                                <td>
                                    @if($usuario->estado === 'activo')
                                        <span class="badge badge-estado-activa">Activo</span>
                                    @elseif($usuario->estado === 'inactivo')
                                        <span class="badge badge-estado-vencida">Inactivo</span>
                                    @else
                                        <span class="badge bg-secondary">
                                            {{ ucfirst($usuario->estado) }}
                                        </span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    <span class="code-pill">
                                        {{ $usuario->credenciales_count }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection