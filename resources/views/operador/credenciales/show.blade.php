@extends('layouts.app')

@section('title', 'Credencial digital')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="mb-1">Credencial digital</h1>
        <p class="text-muted mb-0">Representación textual de la credencial emitida.</p>
    </div>

    <div class="d-flex gap-2">
        <a href="{{ route('operador.credenciales.edit', $credencial) }}" class="btn btn-outline-secondary">
            Editar estado
        </a>

        <a href="{{ route('operador.credenciales.index') }}" class="btn btn-outline-primary">
            Volver
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-7">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-dark text-white">
                Credencial de acceso
            </div>

            <div class="card-body">
                <div class="text-center border rounded p-4 bg-light mb-4">
                    <div class="text-muted mb-2">Código de credencial</div>
                    <h2 class="fw-bold">{{ $credencial->codigo_credencial }}</h2>
                    <p class="text-muted mb-0">Simulación de QR textual</p>
                </div>

                <dl class="row mb-0">
                    <dt class="col-sm-4">Usuario</dt>
                    <dd class="col-sm-8">
                        {{ $credencial->user->name }} {{ $credencial->user->apellido }}
                    </dd>

                    <dt class="col-sm-4">Correo</dt>
                    <dd class="col-sm-8">{{ $credencial->user->email }}</dd>

                    <dt class="col-sm-4">Documento</dt>
                    <dd class="col-sm-8">{{ $credencial->user->documento ?? 'Sin documento' }}</dd>

                    <dt class="col-sm-4">Partido</dt>
                    <dd class="col-sm-8">{{ $credencial->partido->nombre }}</dd>

                    <dt class="col-sm-4">Estadio</dt>
                    <dd class="col-sm-8">{{ $credencial->partido->estadio->nombre ?? 'Sin estadio' }}</dd>

                    <dt class="col-sm-4">Tipo</dt>
                    <dd class="col-sm-8">{{ $credencial->tipoAcreditacion->nombre }}</dd>

                    <dt class="col-sm-4">Emisión</dt>
                    <dd class="col-sm-8">{{ $credencial->fecha_emision->format('d/m/Y') }}</dd>

                    <dt class="col-sm-4">Vencimiento</dt>
                    <dd class="col-sm-8">{{ $credencial->fecha_vencimiento->format('d/m/Y') }}</dd>

                    <dt class="col-sm-4">Identidad</dt>
                    <dd class="col-sm-8">
                        @if($credencial->identidad_verificada)
                            <span class="badge bg-success">Verificada</span>
                        @else
                            <span class="badge bg-danger">No verificada</span>
                        @endif
                    </dd>

                    <dt class="col-sm-4">Estado</dt>
                    <dd class="col-sm-8">
                        @if($credencial->estado === 'activa')
                            <span class="badge bg-success">Activa</span>
                        @elseif($credencial->estado === 'suspendida')
                            <span class="badge bg-warning text-dark">Suspendida</span>
                        @else
                            <span class="badge bg-secondary">Vencida</span>
                        @endif
                    </dd>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection