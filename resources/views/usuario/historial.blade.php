@extends('layouts.app')

@section('title', 'Historial de accesos')

@section('content')
<div class="mb-4">
    <h1 class="mb-1">Historial de accesos</h1>
    <p class="text-muted mb-0">Intentos de ingreso realizados con tus credenciales.</p>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        @if($registros->isEmpty())
            <div class="alert alert-info mb-0">
                Todavía no tienes intentos registrados.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th>Fecha y hora</th>
                            <th>Credencial</th>
                            <th>Partido</th>
                            <th>Punto</th>
                            <th>Zona</th>
                            <th>Resultado</th>
                            <th>Motivo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $registro)
                            <tr>
                                <td>{{ $registro->fecha_hora->format('d/m/Y H:i') }}</td>
                                <td>{{ $registro->credencial->codigo_credencial }}</td>
                                <td>{{ $registro->partido->nombre }}</td>
                                <td>{{ $registro->puntoAcceso->nombre }}</td>
                                <td>{{ $registro->puntoAcceso->zona->nombre ?? 'Sin zona' }}</td>
                                <td>
                                    @if($registro->resultado === 'aprobado')
                                        <span class="badge bg-success">Aprobado</span>
                                    @else
                                        <span class="badge bg-danger">Rechazado</span>
                                    @endif
                                </td>
                                <td>{{ $registro->motivo_rechazo ?? 'Acceso permitido' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection