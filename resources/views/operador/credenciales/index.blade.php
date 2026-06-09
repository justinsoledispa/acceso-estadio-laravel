@extends('layouts.app')

@section('title', 'Credenciales emitidas')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="mb-1">Credenciales emitidas</h1>
        <p class="text-muted mb-0">Listado de credenciales generadas por el operador de acreditación.</p>
    </div>

    <a href="{{ route('operador.credenciales.create') }}" class="btn btn-primary">
        Emitir credencial
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        @if($credenciales->isEmpty())
            <div class="alert alert-info mb-0">
                Todavía no hay credenciales emitidas.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Usuario</th>
                            <th>Partido</th>
                            <th>Tipo</th>
                            <th>Estado</th>
                            <th>Vence</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($credenciales as $credencial)
                            <tr>
                                <td>
                                    <strong>{{ $credencial->codigo_credencial }}</strong>
                                </td>
                                <td>
                                    {{ $credencial->user->name }}
                                    {{ $credencial->user->apellido }}
                                </td>
                                <td>{{ $credencial->partido->nombre }}</td>
                                <td>{{ $credencial->tipoAcreditacion->nombre }}</td>
                                <td>
                                    @if($credencial->estado === 'activa')
                                        <span class="badge bg-success">Activa</span>
                                    @elseif($credencial->estado === 'suspendida')
                                        <span class="badge bg-warning text-dark">Suspendida</span>
                                    @else
                                        <span class="badge bg-secondary">Vencida</span>
                                    @endif
                                </td>
                                <td>{{ $credencial->fecha_vencimiento->format('d/m/Y') }}</td>
                                <td class="text-end">
                                    <a href="{{ route('operador.credenciales.show', $credencial) }}" class="btn btn-sm btn-outline-primary">
                                        Ver
                                    </a>

                                    <a href="{{ route('operador.credenciales.edit', $credencial) }}" class="btn btn-sm btn-outline-secondary">
                                        Editar
                                    </a>
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