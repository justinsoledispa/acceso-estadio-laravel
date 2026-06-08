@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Gestión de Recintos (Estadios)</h2>
    <a href="{{ route('admin.estadios.create') }}" class="btn btn-primary">Registrar Recinto</a>
</div>
<table class="table bg-white shadow-sm rounded">
    <thead class="table-dark"><tr><th>Nombre</th><th>Ciudad</th><th>Capacidad</th><th>Opciones</th></tr></thead>
    <tbody>
        @foreach($estadios as $e)
        <tr><td>{{ $e->nombre }}</td><td>{{ $e->ciudad }}</td><td>{{ $e->capacidad }}</td>
            <td><a href="{{ route('admin.estadios.show', $e->id) }}" class="btn btn-sm btn-info text-white">Configurar Estructura</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection