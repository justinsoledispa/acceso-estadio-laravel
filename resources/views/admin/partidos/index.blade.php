@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Programación de Eventos / Partidos</h2>
    <a href="{{ route('admin.partidos.create') }}" class="btn btn-primary">Nuevo Partido</a>
</div>
<div class="card shadow-sm border-0">
    <table class="table table-hover mb-0">
        <thead class="table-dark">
            <tr><th>Nombre del Evento</th><th>Sede / Estadio</th><th>Fecha</th><th>Hora</th><th>Zonas Operativas</th></tr>
        </thead>
        <tbody>
            @foreach($partidos as $p)
            <tr>
                <td>{{ $p->nombre }}</td>
                <td>{{ $p->estadio->nombre }}</td>
                <td>{{ $p->fecha }}</td>
                <td>{{ $p->hora_inicio }}</td>
                <td>
                    <a href="{{ route('admin.partidos.zonas', $p->id) }}" class="btn btn-sm btn-warning fw-bold text-dark">
                        Habilitar Zonas (N:M)
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection