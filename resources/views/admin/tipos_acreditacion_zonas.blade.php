@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2>Seguridad: Permisos de Acceso</h2>
        <p class="text-muted mb-0">Cruza los Roles de Acreditación con las Zonas Físicas permitidas en cada Estadio.</p>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success py-2">{{ session('success') }}</div>
@endif

<form action="{{ route('admin.tipos_acreditacion.zonas.update') }}" method="POST">
    @csrf
    
    <div class="row g-4">
        @foreach($tiposAcreditacion as $tipo)
            <div class="col-md-6">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header bg-dark text-white fw-bold">
                        💼 Perfil: {{ $tipo->nombre }}
                    </div>
                    
                    <div class="card-body bg-white">
                        <p class="text-secondary small">Selecciona a qué áreas físicas puede ingresar este perfil:</p>
                        
                        @php 
                            // Obtenemos los IDs de las zonas que este perfil ya tiene autorizadas actualmente
                            $idZonasAutorizadas = $tipo->zonas->pluck('id')->toArray(); 
                        @endphp

                        @foreach($estadios as $estadio)
                            @if($estadio->zonas->count() > 0)
                                <div class="mb-3">
                                    <h6 class="fw-bold text-primary small border-bottom pb-1">
                                        🏟️ {{ $estadio->nombre }} ({{ $estadio->ciudad }})
                                    </h6>
                                    
                                    <div class="row row-cols-2 g-2">
                                        @foreach($estadio->zonas as $zona)
                                            <div class="col">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input border-secondary" 
                                                           type="checkbox" 
                                                           name="permisos[{{ $tipo->id }}][]" 
                                                           value="{{ $zona->id }}"
                                                           id="chk_{{ $tipo->id }}_{{ $zona->id }}"
                                                           {{ in_array($zona->id, $idZonasAutorizadas) ? 'checked' : '' }}>
                                                    <label class="form-check-label small cursor-pointer" for="chk_{{ $tipo->id }}_{{ $zona->id }}">
                                                        {{ $zona->nombre }} <span class="text-muted">({{ $zona->tipo_zona }})</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endforeach

                        @if($estadios->flatMap->zonas->count() == 0)
                            <div class="text-center text-muted py-3 small">
                                No hay zonas creadas en ningún estadio todavía.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-4 pt-3 border-top text-end">
        <button type="submit" class="btn btn-success fw-bold px-5 shadow">
            Guardar Matriz de Permisos Global
        </button>
    </div>
</form>
@endsection