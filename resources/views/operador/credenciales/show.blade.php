@extends('layouts.app')

@section('title', 'Credencial digital')

@section('content')
<div class="page-header">
    <div>
        <div class="page-kicker">Credencial emitida</div>
        <h1 class="page-title">Credencial digital</h1>
        <p class="page-subtitle">
            Representación web de la acreditación asociada a un usuario y a un partido.
        </p>
    </div>

    <div class="d-flex gap-2 flex-wrap">
        <a href="{{ route('operador.credenciales.edit', $credencial) }}" class="btn btn-outline-secondary">
            Editar estado
        </a>

        <a href="{{ route('operador.credenciales.index') }}" class="btn btn-outline-primary">
            Volver al listado
        </a>
    </div>
</div>

<div class="credential-shell">
    <div class="credential-card">
        <div class="credential-top">
            <div class="d-flex justify-content-between align-items-start gap-3 flex-wrap">
                <div>
                    <small>Sistema de Acreditación y Control de Acceso</small>
                    <h4 class="mb-0 mt-1">Credencial de acceso</h4>
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

        <div class="card-body p-4">
            <div class="credential-code-panel mb-4">
                <div class="credential-code-label">Código de credencial</div>
                <div class="credential-code">{{ $credencial->codigo_credencial }}</div>
                <p class="text-muted mb-0">
                    Simulación textual de credencial digital
                </p>
            </div>

            <dl class="row credential-details">
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

                <dt class="col-sm-4">Estado</dt>
                <dd class="col-sm-8">
                    @if($credencial->estado === 'activa')
                        <span class="badge badge-estado-activa">Activa</span>
                    @elseif($credencial->estado === 'suspendida')
                        <span class="badge badge-estado-suspendida">Suspendida</span>
                    @else
                        <span class="badge badge-estado-vencida">Vencida</span>
                    @endif
                </dd>
            </dl>
        </div>
    </div>
</div>
@endsection