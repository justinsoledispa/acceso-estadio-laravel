@extends('layouts.app')

@section('title', 'Dashboard administrador')

@section('content')
@php
    $aprobadosCount = $aprobados ?? 0;
    $rechazadosCount = $rechazados ?? 0;
    $totalIntentos = $aprobadosCount + $rechazadosCount;

    $porcentajeAprobados = $totalIntentos > 0
        ? round(($aprobadosCount / $totalIntentos) * 100)
        : 0;

    $porcentajeRechazados = $totalIntentos > 0
        ? round(($rechazadosCount / $totalIntentos) * 100)
        : 0;
@endphp

<div class="page-header">
    <div>
        <div class="page-kicker">Administrador</div>
        <h1 class="page-title">Panel administrativo</h1>
        <p class="page-subtitle">
            Vista general del sistema de acreditación, partidos y control de intentos de acceso.
        </p>
    </div>

    <a href="{{ route('admin.reportes') }}" class="btn btn-outline-primary">
        Ver reportes
    </a>
</div>

<div class="admin-metric-grid">
    <div class="admin-metric-card">
        <div class="admin-metric-label">Partidos activos</div>
        <div class="admin-metric-value">{{ $partidosActivos ?? 0 }}</div>
        <p class="admin-metric-hint">
            Partidos disponibles para emisión y validación de credenciales.
        </p>
    </div>

    <div class="admin-metric-card">
        <div class="admin-metric-label">Credenciales</div>
        <div class="admin-metric-value">{{ $credenciales ?? 0 }}</div>
        <p class="admin-metric-hint">
            Total de credenciales emitidas dentro del sistema.
        </p>
    </div>

    <div class="admin-metric-card">
        <div class="admin-metric-label">Accesos aprobados</div>
        <div class="admin-metric-value">{{ $aprobadosCount }}</div>
        <p class="admin-metric-hint">
            Intentos aceptados por las reglas de validación.
        </p>
    </div>

    <div class="admin-metric-card">
        <div class="admin-metric-label">Accesos rechazados</div>
        <div class="admin-metric-value">{{ $rechazadosCount }}</div>
        <p class="admin-metric-hint">
            Intentos bloqueados por estado, punto, zona o permisos.
        </p>
    </div>
</div>

<div class="row g-4 mt-1">
    <div class="col-lg-8">
        <div class="admin-panel h-100">
            <div class="admin-panel-header">
                <div class="admin-panel-title">Resumen de validaciones</div>
                <p class="admin-panel-subtitle">
                    Comparación real entre intentos aprobados y rechazados registrados en el sistema.
                </p>
            </div>

            <div class="admin-panel-body">
                @if($totalIntentos === 0)
                    <div class="empty-state py-4">
                        <h5 class="empty-state-title">Todavía no hay intentos registrados</h5>
                        <p class="empty-state-text">
                            Cuando un usuario final realice una simulación de ingreso, los resultados aparecerán en este panel.
                        </p>
                    </div>
                @else
                    <div class="admin-progress-item">
                        <div class="admin-progress-label">
                            <span>Accesos aprobados</span>
                            <small>{{ $aprobadosCount }} intentos · {{ $porcentajeAprobados }}%</small>
                        </div>

                        <div class="admin-progress">
                            <div class="admin-progress-bar" style="width: {{ $porcentajeAprobados }}%"></div>
                        </div>
                    </div>

                    <div class="admin-progress-item">
                        <div class="admin-progress-label">
                            <span>Accesos rechazados</span>
                            <small>{{ $rechazadosCount }} intentos · {{ $porcentajeRechazados }}%</small>
                        </div>

                        <div class="admin-progress">
                            <div class="admin-progress-bar" style="width: {{ $porcentajeRechazados }}%"></div>
                        </div>
                    </div>

                    <div class="row g-3 mt-3">
                        <div class="col-md-6">
                            <div class="report-summary-card h-100">
                                <div class="report-summary-label">Validaciones registradas</div>
                                <div class="report-summary-value">{{ $totalIntentos }}</div>
                                <p class="text-muted mb-0">
                                    Total de intentos de acceso guardados en el historial.
                                </p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="report-summary-card h-100">
                                <div class="report-summary-label">Resultado dominante</div>

                                @if($aprobadosCount > $rechazadosCount)
                                    <div class="report-summary-value">Aprobados</div>
                                    <p class="text-muted mb-0">
                                        La mayoría de intentos registrados fueron permitidos.
                                    </p>
                                @elseif($rechazadosCount > $aprobadosCount)
                                    <div class="report-summary-value">Rechazados</div>
                                    <p class="text-muted mb-0">
                                        La mayoría de intentos registrados fueron bloqueados.
                                    </p>
                                @else
                                    <div class="report-summary-value">Equilibrado</div>
                                    <p class="text-muted mb-0">
                                        Los intentos aprobados y rechazados están igualados.
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="admin-panel h-100">
            <div class="admin-panel-header">
                <div class="admin-panel-title">Accesos rápidos</div>
                <p class="admin-panel-subtitle">
                    Gestión principal del administrador.
                </p>
            </div>

            <div class="admin-panel-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.estadios.index') }}" class="btn btn-outline-primary">
                        Gestionar estadios
                    </a>

                    <a href="{{ route('admin.partidos.index') }}" class="btn btn-outline-primary">
                        Gestionar partidos
                    </a>

                    <a href="{{ route('admin.tipos_acreditacion.zonas') }}" class="btn btn-outline-primary">
                        Permisos por tipo
                    </a>

                    <a href="{{ route('admin.reportes') }}" class="btn btn-primary">
                        Ver reportes
                    </a>
                </div>

                <div class="form-help-box mt-4">
                    <strong>Datos reales</strong>
                    <p class="mb-0 mt-2">
                        Este panel usa únicamente registros guardados en la tabla de intentos de acceso.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection