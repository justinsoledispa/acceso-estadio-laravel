<?php

namespace App\Http\Controllers;

use App\Models\Partido;
use App\Models\Credencial;
use App\Models\Estadio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $partidosActivos = Partido::where('estado', 'Activo')->count();

        $credenciales = Credencial::count();

        $aprobados = DB::table('registro_intentos')
            ->where('resultado', 'aprobado')
            ->count();

        $rechazados = DB::table('registro_intentos')
            ->where('resultado', 'rechazado')
            ->count();

        return view('admin.dashboard', compact(
            'partidosActivos',
            'credenciales',
            'aprobados',
            'rechazados'
        ));
    }

    public function reportes()
    {
        $totalEstadios = Estadio::count();
        $totalPartidos = Partido::count();
        $totalCredenciales = Credencial::count();

        $totalIntentos = DB::table('registro_intentos')->count();

        $intentosAprobados = DB::table('registro_intentos')
            ->where('resultado', 'aprobado')
            ->count();

        $intentosRechazados = DB::table('registro_intentos')
            ->where('resultado', 'rechazado')
            ->count();

        $ultimosIntentos = DB::table('registro_intentos')
            ->join('credenciales', 'registro_intentos.credencial_id', '=', 'credenciales.id')
            ->join('users', 'credenciales.user_id', '=', 'users.id')
            ->join('partidos', 'registro_intentos.partido_id', '=', 'partidos.id')
            ->join('puntos_acceso', 'registro_intentos.punto_acceso_id', '=', 'puntos_acceso.id')
            ->join('zonas', 'puntos_acceso.zona_id', '=', 'zonas.id')
            ->select(
                'registro_intentos.fecha_hora',
                'registro_intentos.resultado',
                'registro_intentos.motivo_rechazo',
                'credenciales.codigo_credencial',
                'users.name',
                'users.apellido',
                'partidos.nombre as partido',
                'puntos_acceso.nombre as punto_acceso',
                'zonas.nombre as zona'
            )
            ->orderByDesc('registro_intentos.fecha_hora')
            ->limit(10)
            ->get();

        return view('admin.reportes', compact(
            'totalEstadios',
            'totalPartidos',
            'totalCredenciales',
            'totalIntentos',
            'intentosAprobados',
            'intentosRechazados',
            'ultimosIntentos'
        ));
    }

    public function editTiposZonas()
    {
        $tiposAcreditacion = \App\Models\TipoAcreditacion::with('zonas')->get();
        $estadios = \App\Models\Estadio::with('zonas')->get();

        return view('admin.tipos_acreditacion_zonas', compact('tiposAcreditacion', 'estadios'));
    }

    public function updateTiposZonas(Request $request)
    {
        $matrices = $request->input('permisos', []);
        $todosLosTipos = \App\Models\TipoAcreditacion::all();

        foreach ($todosLosTipos as $tipo) {
            $zonasPermitidas = $matrices[$tipo->id] ?? [];
            $tipo->zonas()->sync($zonasPermitidas);
        }

        return redirect()->back()->with('success', 'Matriz de permisos de acceso actualizada correctamente.');
    }
}