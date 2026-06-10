@extends('layouts.app')
@section('content')
<h2 class="mb-4">Programar Nuevo Evento</h2>
<form action="{{ route('admin.partidos.store') }}" method="POST" class="card p-4 shadow-sm border-0" style="max-width: 600px;">
    @csrf
    <div class="mb-3">
        <label class="form-label fw-bold">Nombre del Partido</label>
        <input type="text" name="nombre" class="form-control" placeholder="Ej: Final Copa Libertadores" required>
    </div>
    <div class="row mb-3">
        <div class="col">
            <label class="form-label fw-bold">Fecha</label>
            <input type="date" name="fecha" class="form-control" required>
        </div>
        <div class="col">
            <label class="form-label fw-bold">Hora de Apertura</label>
            <input type="time" name="hora_inicio" class="form-control" required>
        </div>
    </div>
    <div class="mb-4">
        <label class="form-label fw-bold">Sede (Estadio)</label>
        <select name="estadio_id" class="form-select" required>
            <option value="">-- Seleccione un estadio --</option>
            @foreach($estadios as $est) 
                <option value="{{ $est->id }}">{{ $est->nombre }} ({{ $est->ciudad }})</option> 
            @endforeach
        </select>
    </div>
    <div>
        <button type="submit" class="btn btn-primary">Guardar Partido</button>
        <a href="{{ route('admin.partidos.index') }}" class="btn btn-secondary">Cancelar</a>
    </div>
</form>
@endsection