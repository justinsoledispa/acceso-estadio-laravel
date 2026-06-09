@extends('layouts.app')

@section('title', 'Emitir credencial')

@section('content')
<div class="mb-4">
    <h1 class="mb-1">Emitir credencial</h1>
    <p class="text-muted mb-0">Seleccione el usuario, partido y tipo de acreditación.</p>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <form method="POST" action="{{ route('operador.credenciales.store') }}">
            @csrf

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

            <div class="form-check mb-4">
                <input
                    type="checkbox"
                    name="identidad_verificada"
                    id="identidad_verificada"
                    class="form-check-input"
                    value="1"
                    @checked(old('identidad_verificada', true))
                >
                <label for="identidad_verificada" class="form-check-label">
                    Identidad verificada
                </label>
            </div>

            <div class="d-flex gap-2">
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
@endsection