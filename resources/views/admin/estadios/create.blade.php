@extends('layouts.app')
@section('content')
<h4>Registrar Nuevo Estadio</h4>
<form action="{{ route('admin.estadios.store') }}" method="POST" class="card p-4 shadow-sm border-0" style="max-width: 500px;">
    @csrf
    <div class="mb-3"><label class="form-label">Nombre</label><input type="text" name="nombre" class="form-control" required></div>
    <div class="mb-3"><label class="form-label">Ciudad</label><input type="text" name="ciudad" class="form-control" required></div>
    <div class="mb-3"><label class="form-label">Capacidad total</label><input type="number" name="capacidad" class="form-control" required></div>
    <button type="submit" class="btn btn-success">Guardar Recinto</button>
</form>
@endsection