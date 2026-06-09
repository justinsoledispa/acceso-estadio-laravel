@extends('layouts.app')

@section('title', 'Simular ingreso')

@section('content')
<div class="mb-4">
    <h1 class="mb-1">Simular ingreso</h1>
    <p class="text-muted mb-0">Seleccione un punto de acceso para probar la credencial.</p>
</div>

@if(session('resultado_acceso'))
    @php($resultado = session('resultado_acceso'))

    <div class="alert {{ $resultado['resultado'] === 'aprobado' ? 'alert-success' : 'alert-danger' }}">
        <h5 class="mb-1">
            {{ $resultado['resultado'] === 'aprobado' ? 'Acceso aprobado' : 'Acceso rechazado' }}
        </h5>

        <p class="mb-1">
            <strong>Motivo:</strong> {{ $resultado['motivo'] }}
        </p>

        <p class="mb-0">
            <strong>Punto:</strong> {{ $resultado['punto'] }} |
            <strong>Zona:</strong> {{ $resultado['zona'] }}
        </p>
    </div>
@endif

<div class="row">
    <div class="col-lg-5 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-dark text-white">
                Credencial seleccionada
            </div>

            <div class="card-body">
                <p class="mb-1">
                    <strong>Código:</strong> {{ $credencial->codigo_credencial }}
                </p>

                <p class="mb-1">
                    <strong>Partido:</strong> {{ $credencial->partido->nombre }}
                </p>

                <p class="mb-1">
                    <strong>Estadio:</strong> {{ $credencial->partido->estadio->nombre ?? 'Sin estadio' }}
                </p>

                <p class="mb-1">
                    <strong>Tipo:</strong> {{ $credencial->tipoAcreditacion->nombre }}
                </p>

                <p class="mb-0">
                    <strong>Estado:</strong>
                    @if($credencial->estado === 'activa')
                        <span class="badge bg-success">Activa</span>
                    @elseif($credencial->estado === 'suspendida')
                        <span class="badge bg-warning text-dark">Suspendida</span>
                    @else
                        <span class="badge bg-secondary">Vencida</span>
                    @endif
                </p>
            </div>
        </div>

        <div class="card shadow-sm border-0 mt-4">
            <div class="card-header">
                Zonas permitidas
            </div>

            <div class="card-body">
                <p class="text-muted mb-2">Zonas generales del partido:</p>

                @forelse($zonasGenerales as $zona)
                    <span class="badge bg-primary me-1 mb-1">{{ $zona->nombre }}</span>
                @empty
                    <p class="text-muted mb-2">No hay zonas generales habilitadas.</p>
                @endforelse

                <hr>

                <p class="text-muted mb-2">Zonas por tipo de acreditación:</p>

                @forelse($zonasPermitidas as $zona)
                    <span class="badge bg-secondary me-1 mb-1">{{ $zona->nombre }}</span>
                @empty
                    <p class="text-muted mb-0">No hay zonas restringidas permitidas para este tipo.</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="col-lg-7">
        <div class="card shadow-sm border-0">
            <div class="card-header">
                Punto de acceso
            </div>

            <div class="card-body">
                @if($puntosAcceso->isEmpty())
                    <div class="alert alert-info mb-0">
                        No hay puntos de acceso disponibles para este partido.
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

                        <div class="d-flex gap-2">
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