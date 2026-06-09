@extends('layouts.app')

@section('title', 'Editar credencial')

@section('content')
<div class="mb-4">
    <h1 class="mb-1">Editar credencial</h1>
    <p class="text-muted mb-0">Solo se modifica el estado operativo de la credencial.</p>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="alert alert-info">
            Credencial: <strong>{{ $credencial->codigo_credencial }}</strong><br>
            Usuario: {{ $credencial->user->name }} {{ $credencial->user->apellido }}<br>
            Partido: {{ $credencial->partido->nombre }}
        </div>

        <form method="POST" action="{{ route('operador.credenciales.update', $credencial) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
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


            <div class="d-flex gap-2">
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
@endsection