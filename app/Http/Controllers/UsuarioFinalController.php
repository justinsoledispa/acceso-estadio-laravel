<?php

namespace App\Http\Controllers;

use App\Models\Credencial;
use App\Models\PuntoAcceso;
use App\Models\RegistroIntento;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UsuarioFinalController extends Controller
{
    public function credencial(): View
    {
        $credenciales = Auth::user()
            ->credenciales()
            ->with(['tipoAcreditacion', 'partido.estadio'])
            ->latest()
            ->get();

        return view('usuario.credencial', compact('credenciales'));
    }

    public function simularIngreso(Credencial $credencial): View
    {
        $this->validarPropietarioCredencial($credencial);

        $credencial->load(['tipoAcreditacion.zonas', 'partido.estadio', 'partido.zonas']);

        $puntosAcceso = PuntoAcceso::with('zona')
            ->where('estado', 'activo')
            ->whereHas('zona', function ($query) use ($credencial) {
                $query->where('estado', 'activa')
                    ->whereHas('partidos', function ($subquery) use ($credencial) {
                        $subquery->where('partidos.id', $credencial->partido_id)
                            ->where('partido_zona.habilitada', true);
                    });
            })
            ->orderBy('nombre')
            ->get();

        $zonasHabilitadas = $credencial->partido
            ->zonas()
            ->wherePivot('habilitada', true)
            ->orderBy('nombre')
            ->get();

        $zonasGenerales = $zonasHabilitadas->filter(function ($zona) {
            return $this->esZonaGeneral($zona->tipo_zona);
        });

        $zonasPermitidas = $credencial->tipoAcreditacion
            ->zonas()
            ->whereIn('zonas.id', $zonasHabilitadas->pluck('id'))
            ->orderBy('nombre')
            ->get();

        return view('usuario.simular-ingreso', compact(
            'credencial',
            'puntosAcceso',
            'zonasGenerales',
            'zonasPermitidas'
        ));
    }

    public function procesarIngreso(Request $request, Credencial $credencial): RedirectResponse
    {
        $this->validarPropietarioCredencial($credencial);

        $datos = $request->validate([
            'punto_acceso_id' => ['required', 'exists:puntos_acceso,id'],
        ], [
            'punto_acceso_id.required' => 'Debe seleccionar un punto de acceso.',
            'punto_acceso_id.exists' => 'El punto de acceso seleccionado no es válido.',
        ]);

        $credencial->load(['tipoAcreditacion', 'partido']);
        $puntoAcceso = PuntoAcceso::with('zona')->findOrFail($datos['punto_acceso_id']);

        [$resultado, $motivo] = $this->validarAcceso($credencial, $puntoAcceso);

        RegistroIntento::create([
            'credencial_id' => $credencial->id,
            'partido_id' => $credencial->partido_id,
            'punto_acceso_id' => $puntoAcceso->id,
            'fecha_hora' => now(),
            'resultado' => $resultado,
            'motivo_rechazo' => $resultado === 'rechazado' ? $motivo : null,
        ]);

        return redirect()
            ->route('usuario.simular-ingreso', $credencial)
            ->with('resultado_acceso', [
                'resultado' => $resultado,
                'motivo' => $motivo,
                'punto' => $puntoAcceso->nombre,
                'zona' => $puntoAcceso->zona->nombre ?? 'Sin zona',
            ]);
    }

    public function historial(): View
    {
        $registros = RegistroIntento::with([
                'credencial.tipoAcreditacion',
                'partido',
                'puntoAcceso.zona',
            ])
            ->whereHas('credencial', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->latest('fecha_hora')
            ->get();

        return view('usuario.historial', compact('registros'));
    }

    public function seleccionarCredencial(): View
{
    $credenciales = Auth::user()
        ->credenciales()
        ->with(['tipoAcreditacion', 'partido.estadio'])
        ->latest()
        ->get();

    return view('usuario.seleccionar-credencial', compact('credenciales'));
}

    private function validarAcceso(Credencial $credencial, PuntoAcceso $puntoAcceso): array
    {
        if ($credencial->estado !== 'activa') {
            return ['rechazado', 'Credencial no activa'];
        }

        if ($puntoAcceso->estado !== 'activo') {
            return ['rechazado', 'Punto de acceso no disponible'];
        }

        if (! $puntoAcceso->zona) {
            return ['rechazado', 'El punto de acceso no tiene zona asociada'];
        }

        $zona = $puntoAcceso->zona;

        if ($zona->estado !== 'activa') {
            return ['rechazado', 'Zona no disponible'];
        }

        $zonaHabilitadaParaPartido = $credencial->partido
            ->zonas()
            ->where('zonas.id', $zona->id)
            ->wherePivot('habilitada', true)
            ->exists();

        if (! $zonaHabilitadaParaPartido) {
            return ['rechazado', 'Zona no habilitada para este partido'];
        }

        if ($this->esZonaGeneral($zona->tipo_zona)) {
            return ['aprobado', 'Acceso aprobado a zona general'];
        }

        $tipoPermitidoParaZona = $credencial->tipoAcreditacion
            ->zonas()
            ->where('zonas.id', $zona->id)
            ->exists();

        if (! $tipoPermitidoParaZona) {
            return ['rechazado', 'Tipo de acreditación sin permiso para esta zona'];
        }

        return ['aprobado', 'Acceso aprobado a zona autorizada'];
    }

    private function validarPropietarioCredencial(Credencial $credencial): void
    {
        if ($credencial->user_id !== Auth::id()) {
            abort(403);
        }
    }

    private function esZonaGeneral(string $tipoZona): bool
    {
        return in_array(strtolower($tipoZona), ['general', 'publica', 'pública']);
    }
}