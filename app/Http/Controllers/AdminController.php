<?php

namespace App\Http\Controllers;

use App\Models\Partido;
use App\Models\Credencial;
use App\Models\Zona;
use App\Models\TipoAcreditacion;
use Illuminate\Http\Request;
use App\Models\Estadio;

class AdminController extends Controller
{
    public function dashboard()
    {
        $partidosActivos = Partido::where('estado', 'Activo')->count();
        $credenciales = Credencial::count();
        $aprobados = Credencial::where('estado', 'Activa')->count();
        $rechazados = 0; // cambiar esto despues

        return view('admin.dashboard', compact('partidosActivos', 'credenciales', 'aprobados', 'rechazados'));
    }

    public function reportes()
    {
        $totalEstadios = Estadio::count();
        $totalPartidos = Partido::count();
        return view('admin.reportes', compact('totalEstadios', 'totalPartidos'));
    }
}