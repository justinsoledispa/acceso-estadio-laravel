@extends('layouts.app')

@section('content')
<h2>Recinto: {{ $estadio->nombre }} ({{ $estadio->ciudad }})</h2>
<hr>
<div class="row">
    <div class="col-md-4">
        <h5 class="fw-bold">Crear Nueva Zona</h5>
        <form action="{{ route('admin.zonas.store', $estadio->id) }}" method="POST" class="card p-3 border-0 shadow-sm mb-4">
            @csrf
            <div class="mb-2">
                <label class="small fw-semibold">Nombre de la Zona</label>
                <input type="text" name="nombre" class="form-control form-control-sm" placeholder="Ej: General Norte" required>
            </div>
            
            <div class="mb-2">
                <label class="small fw-semibold">Tipo de Zona</label>
                <select name="tipo_zona" class="form-select form-select-sm" required>
                    <option value="Gradas">Gradas</option>
                    <option value="Palcos/Suites">Palcos/Suites</option>
                    <option value="Prensa">Prensa</option>
                    <option value="Cancha/Gramado">Cancha/Gramado</option>
                    <option value="Camerinos">Camerinos</option>
                    <option value="Exteriores">Exteriores</option>
                </select>
            </div>

            <div class="mb-2">
                <label class="small fw-semibold">Descripción</label>
                <input type="text" name="descripcion" class="form-control form-control-sm" placeholder="Ej: Puerta de acceso 4 y 5">
            </div>

            <button class="btn btn-sm btn-dark w-100">Añadir Zona</button>
        </form>
    </div>

    <div class="col-md-8">
        <h5 class="fw-bold">Zonas de Seguridad y sus Puntos de Control Físico</h5>
        @foreach($estadio->zonas as $z)
            <div class="card mb-3 border-0 shadow-sm">
                <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                    <span><strong>{{ $z->nombre }}</strong></span>
                    <span class="badge bg-light text-dark text-uppercase small" style="font-size: 0.75rem;">{{ $z->tipo_zona }}</span>
                </div>
                
                <div class="card-body bg-white">
                    @if($z->descripcion)
                        <p class="text-muted small mb-3">
                            <strong>Descripción:</strong> {{ $z->descripcion }}
                        </p>
                    @endif

                    <h6 class="small fw-bold text-dark">Puntos de Molinetes / Puertas asociadas:</h6>
                    <ul class="mb-3">
                        @foreach($z->puntosAcceso as $p) 
                            <li>{{ $p->nombre }} <span class="badge bg-success">Activo</span></li> 
                        @endforeach
                    </ul>

                    <form action="{{ route('admin.puntos.store', $z->id) }}" method="POST" class="d-flex gap-2 mt-2">
                        @csrf
                        <input type="text" name="nombre" class="form-control form-control-sm" placeholder="Nombre de puerta/filtro físico" required>
                        <button class="btn btn-sm btn-outline-primary text-nowrap">Asociar Puerta</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection