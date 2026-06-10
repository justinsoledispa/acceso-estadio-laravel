@extends('layouts.app')
@section('title', 'Reportes Generales')
@section('content')

<h1 class="mb-4">Reportes de Infraestructura y Logística</h1>
<div class="card shadow-sm border-0 p-4">
    <h5 class="text-secondary">Resumen del Sistema</h5>
    <ul>
        <li>Estadios total registrados en la plataforma: <strong>{{ $totalEstadios }}</strong></li>
        <li>Eventos / Partidos programados: <strong>{{ $totalPartidos }}</strong></li>
    </ul>
</div>
@endsection