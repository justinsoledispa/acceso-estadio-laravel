@extends('layouts.app')

@section('title', 'Credenciales emitidas')

@section('content')
<div class="page-header">
    <div>
        <div class="page-kicker">Gestión de acreditaciones</div>
        <h1 class="page-title">Credenciales emitidas</h1>
        <p class="page-subtitle">
            Listado de credenciales generadas por el operador de acreditación.
        </p>
    </div>

    <a href="{{ route('operador.credenciales.create') }}" class="btn btn-primary">
        Emitir credencial
    </a>
</div>

<div class="card data-card">
    <div class="data-toolbar">
        <div>
            <div class="data-toolbar-title">Registro de credenciales</div>
            <p class="data-toolbar-subtitle">
                Consulta códigos, usuarios, partidos, tipos de acreditación y estados.
            </p>
        </div>
    </div>

    <div class="card-body">
        @if($credenciales->isEmpty())
            <div class="empty-state">
                <h5 class="empty-state-title">Todavía no hay credenciales emitidas</h5>
                <p class="empty-state-text">
                    Cuando se emita una credencial, aparecerá en este listado.
                </p>

                <a href="{{ route('operador.credenciales.create') }}" class="btn btn-primary">
                    Emitir primera credencial
                </a>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-clean align-middle">
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
                                    <span class="code-pill">
                                        {{ $credencial->codigo_credencial }}
                                    </span>
                                </td>

                                <td>
                                    <div class="user-cell">
                                        <strong>
                                            {{ $credencial->user->name }}
                                            {{ $credencial->user->apellido }}
                                        </strong>
                                        <small>{{ $credencial->user->email }}</small>
                                    </div>
                                </td>

                                <td>
                                    {{ $credencial->partido->nombre }}
                                </td>

                                <td>
                                    {{ $credencial->tipoAcreditacion->nombre }}
                                </td>

                                <td>
                                    @if($credencial->estado === 'activa')
                                        <span class="badge badge-estado-activa">Activa</span>
                                    @elseif($credencial->estado === 'suspendida')
                                        <span class="badge badge-estado-suspendida">Suspendida</span>
                                    @else
                                        <span class="badge badge-estado-vencida">Vencida</span>
                                    @endif
                                </td>

                                <td>
                                    {{ $credencial->fecha_vencimiento->format('d/m/Y') }}
                                </td>

                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('operador.credenciales.show', $credencial) }}"
                                           class="btn btn-sm btn-outline-primary">
                                            Ver
                                        </a>

                                        <a href="{{ route('operador.credenciales.edit', $credencial) }}"
                                           class="btn btn-sm btn-outline-secondary">
                                            Editar
                                        </a>
                                    </div>
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