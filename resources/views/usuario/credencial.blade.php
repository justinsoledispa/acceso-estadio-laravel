@extends('layouts.app')

@section('title', 'Mi credencial')

@section('content')
<h1 class="mb-4">Mi credencial</h1>

<div class="card shadow-sm border-0" style="max-width: 500px;">
    <div class="card-body">
        <h4>{{ auth()->user()->name }} {{ auth()->user()->apellido }}</h4>
        <p class="text-muted mb-3">{{ auth()->user()->email }}</p>

        <div class="border rounded p-4 text-center bg-light">
            <h5>CREDENCIAL DIGITAL</h5>
            <p class="mb-1">Código simulado:</p>
            <h3 class="fw-bold">CRD-2026-00045</h3>
            <span class="badge bg-success">ACTIVA</span>
        </div>
    </div>
</div>
@endsection