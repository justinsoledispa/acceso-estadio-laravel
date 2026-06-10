<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Zona;

class PuntoAccesoController extends Controller
{
    public function store(Request $request, Zona $zona) {
        $request->validate(['nombre' => 'required|string|max:255']);
        $zona->puntosAcceso()->create($request->all() + ['estado' => 'Activo']);
        return redirect()->back()->with('success', 'Punto de acceso físico vinculado.');
    }
}
