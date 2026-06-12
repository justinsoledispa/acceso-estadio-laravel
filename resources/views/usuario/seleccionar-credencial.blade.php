@extends('layouts.app')

@section('title', 'Seleccionar credencial')

@section('content')
<div class="page-header">
    <div>
        <div class="page-kicker">Validación de acceso</div>
        <h1 class="page-title">Seleccionar credencial</h1>
        <p class="page-subtitle">
            Elige la credencial con la que deseas iniciar la simulación de ingreso al estadio.
        </p>
    </div>

    <a href="{{ route('usuario.historial') }}" class="btn btn-outline-primary">
        Ver historial
    </a>
</div>

@if($credenciales->isEmpty())
    <div class="empty-state card">
        <h5 class="empty-state-title">No tienes credenciales disponibles</h5>
        <p class="empty-state-text">
            Para simular un ingreso, primero un operador debe emitir una credencial para tu usuario.
        </p>

        <a href="{{ route('usuario.credencial') }}" class="btn btn-primary">
            Ver mis credenciales
        </a>
    </div>
@else
    <div class="user-credential-grid">
        @foreach($credenciales as $credencial)
            <div class="user-credential-card">
                <div class="user-credential-top">
                    <div class="d-flex justify-content-between align-items-start gap-3">
                        <div>
                            <small>Código de credencial</small>
                            <h5 class="mb-0 mt-1">{{ $credencial->codigo_credencial }}</h5>
                        </div>

                        <div>
                            @if($credencial->estado === 'activa')
                                <span class="badge badge-estado-activa">Activa</span>
                            @elseif($credencial->estado === 'suspendida')
                                <span class="badge badge-estado-suspendida">Suspendida</span>
                            @else
                                <span class="badge badge-estado-vencida">Vencida</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="user-credential-body">
                    <h5 class="fw-bold mb-3">{{ $credencial->partido->nombre }}</h5>

                    <div class="info-list">
                        <div class="info-item">
                            <span class="info-label">Estadio</span>
                            <span class="info-value">
                                {{ $credencial->partido->estadio->nombre ?? 'Sin estadio' }}
                            </span>
                        </div>

                        <div class="info-item">
                            <span class="info-label">Tipo</span>
                            <span class="info-value">
                                {{ $credencial->tipoAcreditacion->nombre }}
                            </span>
                        </div>

                        <div class="info-item">
                            <span class="info-label">Vencimiento</span>
                            <span class="info-value">
                                {{ $credencial->fecha_vencimiento->format('d/m/Y') }}
                            </span>
                        </div>
                    </div>

                    <div class="user-credential-code">
                        <span>Credencial para simulación</span>
                        <strong>{{ $credencial->codigo_credencial }}</strong>
                    </div>

                    <a href="{{ route('usuario.simular-ingreso', $credencial) }}" class="btn btn-primary w-100">
                        Iniciar simulación
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection