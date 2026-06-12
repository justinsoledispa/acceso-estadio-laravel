@extends('layouts.app')

@section('title', 'Reportes generales')

@section('content')
<div class="page-header">
    <div>
        <div class="page-kicker">Reportes</div>
        <h1 class="page-title">Reportes de infraestructura y logística</h1>
        <p class="page-subtitle">
            Resumen general de estadios registrados y partidos programados en la plataforma.
        </p>
    </div>

    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary">
        Volver al dashboard
    </a>
</div>

<div class="admin-panel">
    <div class="admin-panel-header">
        <div class="admin-panel-title">Resumen del sistema</div>
        <p class="admin-panel-subtitle">
            Indicadores administrativos principales para validar el avance de configuración del sistema.
        </p>
    </div>

    <div class="admin-panel-body">
        <div class="report-summary-grid">
            <div class="report-summary-card">
                <div class="report-summary-label">Estadios registrados</div>
                <div class="report-summary-value">{{ $totalEstadios }}</div>
                <p class="text-muted mb-0">
                    Infraestructuras disponibles para configurar zonas, puntos de acceso y partidos.
                </p>
            </div>

            <div class="report-summary-card">
                <div class="report-summary-label">Partidos programados</div>
                <div class="report-summary-value">{{ $totalPartidos }}</div>
                <p class="text-muted mb-0">
                    Eventos configurados para emisión de credenciales y simulación de ingreso.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection