@extends('layouts.app')

@section('title', 'Registrar usuario final')

@section('content')
<div class="page-header">
    <div>
        <div class="page-kicker">Gestión de usuarios</div>
        <h1 class="page-title">Registrar usuario final</h1>
        <p class="page-subtitle">
            Crea un usuario final que posteriormente podrá recibir credenciales digitales para partidos.
        </p>
    </div>

    <a href="{{ route('operador.usuarios.index') }}" class="btn btn-outline-primary">
        Volver al listado
    </a>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card form-card">
            <div class="card-header">
                Datos del usuario
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('operador.usuarios.store') }}">
                    @csrf

                    <div class="form-section-title">Información personal</div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}"
                                placeholder="Ejemplo: Ana"
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
                                placeholder="Ejemplo: Torres"
                            >

                            @error('apellido')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-section-title mt-3">Contacto e identificación</div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}"
                            placeholder="usuario@test.com"
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
                                placeholder="Máximo 10 caracteres"
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

                    <div class="form-section-title mt-3">Acceso al sistema</div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input
                                type="password"
                                name="password"
                                id="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Contraseña del usuario"
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
                                placeholder="Repite la contraseña"
                                required
                            >
                        </div>
                    </div>

                    <div class="form-actions">
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
    </div>

    <div class="col-lg-4">
        <div class="form-help-box">
            <strong>Usuario final</strong>
            <p class="mb-2 mt-2">
                Este registro permite crear usuarios que luego podrán recibir una credencial digital.
            </p>
            
        </div>
    </div>
</div>
@endsection