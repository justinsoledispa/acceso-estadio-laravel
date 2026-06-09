@extends('layouts.app')

@section('title', 'Mi credencial')

@section('content')
<div class="mb-4">
    <h1 class="mb-1">Mi credencial</h1>
    <p class="text-muted mb-0">Credenciales digitales asociadas a tus partidos.</p>
</div>

@if($credenciales->isEmpty())
    <div class="alert alert-info">
        Todavía no tienes credenciales emitidas.
    </div>
@else
    <div class="row">
        @foreach($credenciales as $credencial)
            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header bg-dark text-white">
                        {{ $credencial->codigo_credencial }}
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">{{ $credencial->partido->nombre }}</h5>

                        <p class="mb-1">
                            <strong>Estadio:</strong>
                            {{ $credencial->partido->estadio->nombre ?? 'Sin estadio' }}
                        </p>

                        <p class="mb-1">
                            <strong>Tipo:</strong>
                            {{ $credencial->tipoAcreditacion->nombre }}
                        </p>

                        <p class="mb-1">
                            <strong>Vencimiento:</strong>
                            {{ $credencial->fecha_vencimiento->format('d/m/Y') }}
                        </p>

                        <p class="mb-3">
                            <strong>Estado:</strong>
                            @if($credencial->estado === 'activa')
                                <span class="badge bg-success">Activa</span>
                            @elseif($credencial->estado === 'suspendida')
                                <span class="badge bg-warning text-dark">Suspendida</span>
                            @else
                                <span class="badge bg-secondary">Vencida</span>
                            @endif
                        </p>

                        <div class="border rounded p-3 bg-light text-center mb-3">
                            <div class="text-muted">Código textual de acceso</div>
                            <h4 class="fw-bold mb-0">{{ $credencial->codigo_credencial }}</h4>
                        </div>

                        <a href="{{ route('usuario.simular-ingreso', $credencial) }}" class="btn btn-primary">
                            Simular ingreso
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection