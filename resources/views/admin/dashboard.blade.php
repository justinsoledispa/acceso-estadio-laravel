@extends('layouts.app')

@section('title', 'Dashboard administrador')

@section('content')
<h1 class="mb-4">Dashboard Administrador</h1>

<div class="row g-3">
    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h6 class="text-muted">Partidos activos</h6>
                <h3>{{ $partidosActivos ?? 0 }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h6 class="text-muted">Credenciales</h6>
                <h3>{{ $credenciales ?? 0 }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h6 class="text-muted">Accesos aprobados</h6>
                <h3>{{ $aprobados ?? 0 }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h6 class="text-muted">Accesos rechazados</h6>
                <h3>{{ $rechazados ?? 0 }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="card mt-4 shadow-sm border-0">
    <div class="card-body">
        <h5>Accesos por zona</h5>

        <p class="mb-1">Zona de Prensa</p>
        <div class="progress mb-3">
            <div class="progress-bar" style="width: 60%">60%</div>
        </div>

        <p class="mb-1">Tribuna Norte</p>
        <div class="progress mb-3">
            <div class="progress-bar" style="width: 40%">40%</div>
        </div>

        <p class="mb-1">Camerinos</p>
        <div class="progress">
            <div class="progress-bar" style="width: 20%">20%</div>
        </div>
    </div>
</div>
@endsection