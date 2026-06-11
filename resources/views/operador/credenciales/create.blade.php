@extends('layouts.app')

@section('title', 'Emitir credencial')

@section('content')
<div class="page-header">
    <div>
        <div class="page-kicker">Gestión de acreditaciones</div>
        <h1 class="page-title">Emitir credencial</h1>
        <p class="page-subtitle">
            Selecciona el usuario final, el partido y el tipo de acreditación para generar una credencial activa.
        </p>
    </div>

    <a href="{{ route('operador.credenciales.index') }}" class="btn btn-outline-primary">
        Volver al listado
    </a>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card form-card">
            <div class="card-header">
                Datos de emisión
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('operador.credenciales.store') }}">
                    @csrf

                    <div class="form-section-title">Información principal</div>

                    <div class="mb-3">
                        <label for="user_id" class="form-label">Usuario final</label>
                        <select
                            name="user_id"
                            id="user_id"
                            class="form-select @error('user_id') is-invalid @enderror"
                            required
                        >
                            <option value="">Seleccione un usuario</option>
                            @foreach($usuarios as $usuario)
                                <option value="{{ $usuario->id }}" @selected(old('user_id') == $usuario->id)>
                                    {{ $usuario->name }} {{ $usuario->apellido }} - {{ $usuario->email }}
                                </option>
                            @endforeach
                        </select>

                        @error('user_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tipo_acreditacion_id" class="form-label">Tipo de acreditación</label>
                            <select
                                name="tipo_acreditacion_id"
                                id="tipo_acreditacion_id"
                                class="form-select @error('tipo_acreditacion_id') is-invalid @enderror"
                                required
                            >
                                <option value="">Seleccione un tipo</option>
                                @foreach($tiposAcreditacion as $tipo)
                                    <option value="{{ $tipo->id }}" @selected(old('tipo_acreditacion_id') == $tipo->id)>
                                        {{ $tipo->nombre }}
                                    </option>
                                @endforeach
                            </select>

                            @error('tipo_acreditacion_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="partido_id" class="form-label">Partido</label>
                            <select
                                name="partido_id"
                                id="partido_id"
                                class="form-select @error('partido_id') is-invalid @enderror"
                                required
                            >
                                <option value="">Seleccione un partido</option>
                                @foreach($partidos as $partido)
                                    <option value="{{ $partido->id }}" @selected(old('partido_id') == $partido->id)>
                                        {{ $partido->nombre }} - {{ $partido->fecha }}
                                    </option>
                                @endforeach
                            </select>

                            @error('partido_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-section-title mt-3">Vigencia</div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="fecha_emision" class="form-label">Fecha de emisión</label>
                            <input
                                type="date"
                                name="fecha_emision"
                                id="fecha_emision"
                                class="form-control @error('fecha_emision') is-invalid @enderror"
                                value="{{ old('fecha_emision', now()->toDateString()) }}"
                                required
                            >

                            @error('fecha_emision')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="fecha_vencimiento" class="form-label">Fecha de vencimiento</label>
                            <input
                                type="date"
                                name="fecha_vencimiento"
                                id="fecha_vencimiento"
                                class="form-control @error('fecha_vencimiento') is-invalid @enderror"
                                value="{{ old('fecha_vencimiento', now()->addDay()->toDateString()) }}"
                                required
                            >

                            @error('fecha_vencimiento')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            Emitir credencial
                        </button>

                        <a href="{{ route('operador.credenciales.index') }}" class="btn btn-outline-secondary">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-help-box">
            <strong>Regla del sistema</strong>
            <p class="mb-0 mt-2">
                La credencial se emite con estado activo. Luego podrá ser suspendida o marcada como vencida desde la edición de estado.
            </p>
        </div>
    </div>
</div>
@endsection