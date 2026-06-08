<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zona;
use App\Models\Estadio;

class ZonaController extends Controller
{
    public function store(Request $request, Estadio $estadio) {
        $request->validate(['nombre' => 'required|string|max:255', 'capacidad_max' => 'required|integer']);
        $estadio->zonas()->create($request->all());
        return redirect()->back()->with('success', 'Zona de seguridad agregada.');
    }
}
