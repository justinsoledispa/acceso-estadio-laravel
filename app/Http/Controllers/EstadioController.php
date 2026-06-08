<?php

namespace App\Http\Controllers;

use App\Models\Estadio;
use Illuminate\Http\Request;

class EstadioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $estadios = Estadio::all();
        return view('admin.estadios.index', compact('estadios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('admin.estadios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'ciudad' => 'required|string|max:255',
            'capacidad' => 'required|integer|min:1',
        ]);
        Estadio::create($request->all() + ['estado' => 'Activo']);
        return redirect()->route('admin.estadios.index')->with('success', 'Estadio registrado.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Estadio $estadio) {
        $estadio->load('zonas.puntosAcceso'); // Carga relaciones relacionales de manera óptima
        return view('admin.estadios.show', compact('estadio'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
