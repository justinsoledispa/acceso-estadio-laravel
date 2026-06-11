@extends('layouts.app')

@section('title', 'Editar credencial')

@section('content')
<div class="page-header">
    <div>
        <div class="page-kicker">Estado operativo</div>
        <h1 class="page-title">Editar credencial</h1>
        <p class="page-subtitle">
            Modifica únicamente el estado operativo de la credencial emitida.
        </p>
    </div>

    <a href="{{ route('operador.credenciales.show', $credencial) }}" class="btn btn-outline-primary">
        Volver a la credencial
    </a>
</div>

<div class="row g-4">
    <div class="col-lg-7">
        <div class="card form-card">
            <div class="card-header">
                Cambio de estado
            </div>

            <div class="card-body">
                <div class="status-summary mb-4">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <small class="text-muted d-block">Código</small>
                            <strong>{{ $credencial->codigo_credencial }}</strong>
                        </div>

                        <div class="col-md-4">
                            <small class="text-muted d-block">Usuario</small>
                            <strong>
                                {{ $credencial->user->name }} {{ $credencial->user->apellido }}
                            </strong>
                        </div>

                        <div class="col-md-4">
                            <small class="text-muted d-block">Partido</small>
                            <strong>{{ $credencial->partido->nombre }}</strong>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('operador.credenciales.update', $credencial) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="estado" class="form-label">Estado de la credencial</label>
                        <select
                            name="estado"
                            id="estado"
                            class="form-select @error('estado') is-invalid @enderror"
                            required
                        >
                            <option value="activa" @selected(old('estado', $credencial->estado) === 'activa')>
                                Activa
                            </option>
                            <option value="suspendida" @selected(old('estado', $credencial->estado) === 'suspendida')>
                                Suspendida
                            </option>
                            <option value="vencida" @selected(old('estado', $credencial->estado) === 'vencida')>
                                Vencida
                            </option>
                        </select>

                        @error('estado')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            Guardar cambios
                        </button>

                        <a href="{{ route('operador.credenciales.show', $credencial) }}" class="btn btn-outline-secondary">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="form-help-box">
            <strong>Importante</strong>
            <p class="mb-2 mt-2">
                Esta pantalla no cambia el usuario, el partido ni el tipo de acreditación.
            </p>
            <p class="mb-0">
                Solo permite controlar si la credencial sigue activa, queda suspendida o se marca como vencida.
            </p>
        </div>
    </div>
</div>
@endsection