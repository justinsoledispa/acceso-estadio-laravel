@extends('layouts.app')

@section('title', 'Historial de accesos')

@section('content')
<div class="page-header">
    <div>
        <div class="page-kicker">Registro de intentos</div>
        <h1 class="page-title">Historial de accesos</h1>
        <p class="page-subtitle">
            Intentos de ingreso realizados con tus credenciales digitales.
        </p>
    </div>

    <a href="{{ route('usuario.credencial') }}" class="btn btn-outline-primary">
        Volver a mis credenciales
    </a>
</div>

<div class="card data-card">
    <div class="data-toolbar">
        <div>
            <div class="data-toolbar-title">Intentos registrados</div>
            <p class="data-toolbar-subtitle">
                Consulta fecha, punto de acceso, zona, resultado y motivo de cada validación.
            </p>
        </div>
    </div>

    <div class="card-body">
        @if($registros->isEmpty())
            <div class="empty-state">
                <h5 class="empty-state-title">Todavía no tienes intentos registrados</h5>
                <p class="empty-state-text">
                    Cuando realices una simulación de ingreso, el resultado aparecerá en este historial.
                </p>

                <a href="{{ route('usuario.credencial') }}" class="btn btn-primary">
                    Ir a mis credenciales
                </a>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-clean align-middle">
                    <thead>
                        <tr>
                            <th>Fecha y hora</th>
                            <th>Credencial</th>
                            <th class="text-start">Partido</th>
                            <th class="text-start">Punto</th>
                            <th class="text-start">Zona</th>
                            <th>Resultado</th>
                            <th class="text-start">Motivo</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($registros as $registro)
                            <tr>
                                <td class="text-center">
                                    {{ $registro->fecha_hora->format('d/m/Y H:i') }}
                                </td>

                                <td class="text-center">
                                    <span class="code-pill">
                                        {{ $registro->credencial->codigo_credencial }}
                                    </span>
                                </td>

                                <td>
                                    {{ $registro->partido->nombre }}
                                </td>

                                <td>
                                    {{ $registro->puntoAcceso->nombre }}
                                </td>

                                <td>
                                    {{ $registro->puntoAcceso->zona->nombre ?? 'Sin zona' }}
                                </td>

                                <td class="text-center">
                                    @if($registro->resultado === 'aprobado')
                                        <span class="badge badge-estado-aprobado">Aprobado</span>
                                    @else
                                        <span class="badge badge-estado-rechazado">Rechazado</span>
                                    @endif
                                </td>

                                <td>
                                    {{ $registro->motivo_rechazo ?? 'Acceso permitido' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection