@extends('layouts.app')

@section('title', 'Usuarios finales')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="mb-1">Usuarios finales</h1>
        <p class="text-muted mb-0">Listado de usuarios registrados por el operador de acreditación.</p>
    </div>

    <a href="{{ route('operador.usuarios.create') }}" class="btn btn-primary">
        Registrar usuario
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        @if($usuarios->isEmpty())
            <div class="alert alert-info mb-0">
                Todavía no hay usuarios finales registrados.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Documento</th>
                            <th>Teléfono</th>
                            <th>Estado</th>
                            <th>Credenciales</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($usuarios as $usuario)
                            <tr>
                                <td>
                                    {{ $usuario->name }}
                                    {{ $usuario->apellido }}
                                </td>
                                <td>{{ $usuario->email }}</td>
                                <td>{{ $usuario->documento ?? 'Sin documento' }}</td>
                                <td>{{ $usuario->telefono ?? 'Sin teléfono' }}</td>
                                <td>
                                    <span class="badge bg-success">
                                        {{ ucfirst($usuario->estado) }}
                                    </span>
                                </td>
                                <td>{{ $usuario->credenciales_count }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection