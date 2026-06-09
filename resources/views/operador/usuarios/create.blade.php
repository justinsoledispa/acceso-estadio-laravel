@extends('layouts.app')

@section('title', 'Registrar usuario final')

@section('content')
<div class="mb-4">
    <h1 class="mb-1">Registrar usuario final</h1>
    <p class="text-muted mb-0">El operador registra usuarios que luego podrán recibir credenciales.</p>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <form method="POST" action="{{ route('operador.usuarios.store') }}">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}"
                        required
                    >

                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="apellido" class="form-label">Apellido</label>
                    <input
                        type="text"
                        name="apellido"
                        id="apellido"
                        class="form-control @error('apellido') is-invalid @enderror"
                        value="{{ old('apellido') }}"
                    >

                    @error('apellido')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}"
                    required
                >

                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="documento" class="form-label">Documento</label>
                    <input
                        type="text"
                        name="documento"
                        id="documento"
                        class="form-control @error('documento') is-invalid @enderror"
                        value="{{ old('documento') }}"
                        maxlength="10"
                    >

                    @error('documento')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
    <label for="telefono" class="form-label">Teléfono</label>
    <input
        type="text"
        name="telefono"
        id="telefono"
        class="form-control @error('telefono') is-invalid @enderror"
        value="{{ old('telefono') }}"
        inputmode="numeric"
        maxlength="10"
        pattern="09[0-9]{8}"
        placeholder="Ejemplo: 0977777777"
    >

    @error('telefono')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-control @error('password') is-invalid @enderror"
                        required
                    >

                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                    <input
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        class="form-control"
                        required
                    >
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    Guardar usuario
                </button>

                <a href="{{ route('operador.usuarios.index') }}" class="btn btn-outline-secondary">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection