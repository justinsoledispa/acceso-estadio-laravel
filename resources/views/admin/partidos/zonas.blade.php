@extends('layouts.app')
@section('content')
<div class="card p-4 shadow-sm border-0">
    <h3 class="fw-bold">Gestión de Zonas Operativas</h3>
    <p class="text-muted">Evento: <strong>{{ $partido->nombre }}</strong> | Sede: {{ $partido->estadio->nombre }}</p>
    <div class="alert alert-info py-2 small">Enciende el interruptor de las zonas que estarán abiertas para el personal durante este evento.</div>
    <hr>
    <form action="{{ route('admin.partidos.zonas.update', $partido->id) }}" method="POST">
        @csrf
        <div class="row g-3">
            @foreach($zonas as $z)
                <div class="col-md-4">
                    <div class="p-3 border rounded bg-light d-flex align-items-center justify-content-between shadow-sm">
                        <div>
                            <h6 class="mb-0 fw-bold">{{ $z->nombre }}</h6>
                            <span class="badge bg-secondary mt-1">{{ $z->tipo_zona }}</span>
                        </div>
                        <div class="form-check form-switch fs-4">
                            <input class="form-check-input cursor-pointer" type="checkbox" name="zonas[]" value="{{ $z->id }}" {{ in_array($z->id, $zonasAsignadas) ? 'checked' : '' }}>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-4 pt-3 border-top">
            <button type="submit" class="btn btn-success px-4 fw-bold">Guardar Configuración</button>
            <a href="{{ route('admin.partidos.index') }}" class="btn btn-outline-secondary px-4">Regresar</a>
        </div>
    </form>
</div>
@endsection