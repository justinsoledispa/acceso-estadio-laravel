<?php

namespace App\Http\Controllers;

use App\Models\Partido;
use App\Models\Estadio;
use App\Models\Zona;
use Illuminate\Http\Request;

class PartidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $partidos = Partido::with('estadio')->get();
        return view('admin.partidos.index', compact('partidos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $estadios = Estadio::all();
        return view('admin.partidos.create', compact('estadios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'fecha' => 'required|date',
            'hora_inicio' => 'required',
            'estadio_id' => 'required|exists:estadios,id'
        ]);
        
        Partido::create($request->all() + ['estado' => 'Activo']);
        return redirect()->route('admin.partidos.index')->with('success', 'Partido agendado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editZonas($id) {
        $partido = Partido::findOrFail($id);
        $zonas = Zona::where('estadio_id', $partido->estadio_id)->get();
        $zonasAsignadas = $partido->zonas()->pluck('zonas.id')->toArray();
        return view('admin.partidos.zonas', compact('partido', 'zonas', 'zonasAsignadas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateZonas(Request $request, $id) {
        $partido = Partido::findOrFail($id);
        $partido->zonas()->sync($request->input('zonas', [])); 
        return redirect()->route('admin.partidos.index')->with('success', 'Zonas operativas guardadas con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
