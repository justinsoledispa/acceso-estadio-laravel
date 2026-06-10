<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zona;
use App\Models\Estadio;

class ZonaController extends Controller
{
    public function store(Request $request, Estadio $estadio) {
        $request->validate([
            'nombre' => 'required|string|max:50',
            'tipo_zona' => 'required|string|max:250',
            'descripcion' => 'nullable|string|max:250',
        ]);
        $estadio->zonas()->create($request->all() + ['estado' => 'Activo']);
        return redirect()->back()->with('success', 'Zona de seguridad agregada con éxito.');
    }
}
