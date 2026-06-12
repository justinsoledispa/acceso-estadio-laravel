@extends('layouts.app')

@section('title', 'Simular ingreso')

@section('content')
<div class="page-header">
    <div>
        <div class="page-kicker">Validación de acceso</div>
        <h1 class="page-title">Simular ingreso</h1>
        <p class="page-subtitle">
            Selecciona un punto de acceso para validar si la credencial puede ingresar a esa zona.
        </p>
    </div>

    <a href="{{ route('usuario.credencial') }}" class="btn btn-outline-primary">
        Volver a mis credenciales
    </a>
</div>

@if(session('resultado_acceso'))
    @php($resultado = session('resultado_acceso'))

    <div class="access-result {{ $resultado['resultado'] === 'aprobado' ? 'approved' : 'rejected' }}">
        <h5 class="access-result-title">
            {{ $resultado['resultado'] === 'aprobado' ? 'Acceso aprobado' : 'Acceso rechazado' }}
        </h5>

        <p class="mb-1">
            <strong>Motivo:</strong> {{ $resultado['motivo'] }}
        </p>

        <p class="mb-0">
            <strong>Punto:</strong> {{ $resultado['punto'] }}
            <span class="mx-1">|</span>
            <strong>Zona:</strong> {{ $resultado['zona'] }}
        </p>
    </div>
@endif

<div class="row g-4">
    <div class="col-lg-5">
        <div class="simulation-panel">
            <div class="simulation-panel-header">
                Credencial seleccionada
            </div>

            <div class="simulation-panel-body">
                <div class="user-credential-code mt-0">
                    <span>Código de credencial</span>
                    <strong>{{ $credencial->codigo_credencial }}</strong>
                </div>

                <div class="info-list">
                    <div class="info-item">
                        <span class="info-label">Partido</span>
                        <span class="info-value">{{ $credencial->partido->nombre }}</span>
                    </div>

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
                        <span class="info-label">Estado</span>
                        <span class="info-value">
                            @if($credencial->estado === 'activa')
                                <span class="badge badge-estado-activa">Activa</span>
                            @elseif($credencial->estado === 'suspendida')
                                <span class="badge badge-estado-suspendida">Suspendida</span>
                            @else
                                <span class="badge badge-estado-vencida">Vencida</span>
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="simulation-panel mt-4">
            <div class="simulation-panel-header">
                Zonas habilitadas
            </div>

            <div class="simulation-panel-body">
                <p class="text-muted mb-2">Zonas generales del partido</p>

                @forelse($zonasGenerales as $zona)
                    <span class="zone-chip zone-chip-general">{{ $zona->nombre }}</span>
                @empty
                    <p class="text-muted mb-3">No hay zonas generales habilitadas.</p>
                @endforelse

                <hr>

                <p class="text-muted mb-2">Zonas permitidas por tipo de acreditación</p>

                @forelse($zonasPermitidas as $zona)
                    <span class="zone-chip zone-chip-restricted">{{ $zona->nombre }}</span>
                @empty
                    <p class="text-muted mb-0">
                        No hay zonas restringidas permitidas para este tipo de acreditación.
                    </p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="col-lg-7">
        <div class="simulation-panel">
            <div class="simulation-panel-header">
                Punto de acceso
            </div>

            <div class="simulation-panel-body">
                @if($puntosAcceso->isEmpty())
                    <div class="empty-state py-4">
                        <h5 class="empty-state-title">No hay puntos de acceso disponibles</h5>
                        <p class="empty-state-text">
                            Este partido no tiene puntos de acceso configurados para realizar la simulación.
                        </p>
                    </div>
                @else
                    <form method="POST" action="{{ route('usuario.simular-ingreso.procesar', $credencial) }}">
                        @csrf

                        <div class="mb-3">
                            <label for="punto_acceso_id" class="form-label">Seleccione punto de acceso</label>
                            <select
                                name="punto_acceso_id"
                                id="punto_acceso_id"
                                class="form-select @error('punto_acceso_id') is-invalid @enderror"
                                required
                            >
                                <option value="">Seleccione un punto</option>

                                @foreach($puntosAcceso as $punto)
                                    <option value="{{ $punto->id }}" @selected(old('punto_acceso_id') == $punto->id)>
                                        {{ $punto->nombre }} - {{ $punto->zona->nombre }}
                                        @if(in_array(strtolower($punto->zona->tipo_zona), ['general', 'publica', 'pública']))
                                            (zona general)
                                        @endif
                                    </option>
                                @endforeach
                            </select>

                            @error('punto_acceso_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-help-box mb-3">
                            <strong>Validación simulada</strong>
                            <p class="mb-0 mt-2">
                                El sistema comprobará el estado de la credencial, el punto de acceso, la zona habilitada para el partido y los permisos del tipo de acreditación.
                            </p>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">
                                Validar acceso
                            </button>

                            <a href="{{ route('usuario.historial') }}" class="btn btn-outline-secondary">
                                Finalizar simulación
                            </a>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection