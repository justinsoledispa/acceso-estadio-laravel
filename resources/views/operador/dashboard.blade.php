@extends('layouts.app')

@section('title', 'Dashboard operador')

@section('content')
<h1 class="mb-4">Dashboard Operador de Acreditación</h1>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <h5>Acciones principales</h5>
        <p class="text-muted">Desde aquí se registrarán usuarios y se emitirán credenciales.</p>

        <a href="{{ route('operador.usuarios.create') }}" class="btn btn-primary">
            Registrar usuario
        </a>

        <a href="#" class="btn btn-outline-primary">
            Emitir credencial
        </a>
    </div>
</div>
@endsection