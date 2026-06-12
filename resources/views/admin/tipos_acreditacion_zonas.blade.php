@extends('layouts.app')

@section('title', 'Permisos por tipo de acreditación')

@section('content')
<div class="page-header">
    <div>
        <div class="page-kicker">Seguridad de acceso</div>
        <h1 class="page-title">Permisos por tipo de acreditación</h1>
        <p class="page-subtitle">
            Define qué zonas físicas puede utilizar cada tipo de acreditación dentro de los estadios registrados.
        </p>
    </div>

    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary">
        Volver al dashboard
    </a>
</div>

<form action="{{ route('admin.tipos_acreditacion.zonas.update') }}" method="POST">
    @csrf

    <div class="permission-grid">
        @foreach($tiposAcreditacion as $tipo)
            <div class="permission-card">
                <div class="permission-card-header">
                    <small>Perfil de acreditación</small>
                    <h5 class="permission-card-title">{{ $tipo->nombre }}</h5>
                </div>

                <div class="permission-card-body">
                    <p class="permission-help">
                        Selecciona las zonas restringidas a las que este perfil puede ingresar.
                    </p>

                    @php
                        $idZonasAutorizadas = $tipo->zonas->pluck('id')->toArray();
                    @endphp

                    @foreach($estadios as $estadio)
                        @if($estadio->zonas->count() > 0)
                            <div class="stadium-permission-block">
                                <div class="stadium-permission-title">
                                    {{ $estadio->nombre }} · {{ $estadio->ciudad }}
                                </div>

                                <div class="zone-check-grid">
                                    @foreach($estadio->zonas as $zona)
                                        <div class="zone-check-item">
                                            <div class="form-check">
                                                <input
                                                    class="form-check-input"
                                                    type="checkbox"
                                                    name="permisos[{{ $tipo->id }}][]"
                                                    value="{{ $zona->id }}"
                                                    id="chk_{{ $tipo->id }}_{{ $zona->id }}"
                                                    {{ in_array($zona->id, $idZonasAutorizadas) ? 'checked' : '' }}
                                                >

                                                <label class="form-check-label" for="chk_{{ $tipo->id }}_{{ $zona->id }}">
                                                    {{ $zona->nombre }}
                                                    <small>{{ $zona->tipo_zona }}</small>
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach

                    @if($estadios->flatMap->zonas->count() == 0)
                        <div class="empty-state py-4">
                            <h5 class="empty-state-title">No hay zonas creadas</h5>
                            <p class="empty-state-text">
                                Primero registra zonas dentro de los estadios para configurar permisos.
                            </p>

                            <a href="{{ route('admin.estadios.index') }}" class="btn btn-primary">
                                Ir a Estadios
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <div class="admin-save-bar">
        <div class="d-flex justify-content-end gap-2 flex-wrap">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
                Cancelar
            </a>

            <button type="submit" class="btn btn-primary px-4">
                Guardar matriz de permisos
            </button>
        </div>
    </div>
</form>
@endsection