<?php

namespace App\Http\Controllers;

use App\Models\Credencial;
use App\Models\Partido;
use App\Models\Rol;
use App\Models\TipoAcreditacion;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class OperadorCredencialController extends Controller
{
    public function index(): View
    {
        $credenciales = Credencial::with(['user', 'tipoAcreditacion', 'partido'])
            ->latest()
            ->get();

        return view('operador.credenciales.index', compact('credenciales'));
    }

    public function create(): View
    {
        $rolUsuarioFinal = Rol::where('nombre', 'Usuario final')->firstOrFail();

        $usuarios = User::where('role_id', $rolUsuarioFinal->id)
            ->where('estado', 'activo')
            ->orderBy('name')
            ->get();

        $tiposAcreditacion = TipoAcreditacion::orderBy('nombre')->get();

        $partidos = Partido::where('estado', 'activo')
            ->orderBy('fecha')
            ->orderBy('hora_inicio')
            ->get();

        return view('operador.credenciales.create', compact(
            'usuarios',
            'tiposAcreditacion',
            'partidos'
        ));
    }

    public function store(Request $request): RedirectResponse
    {
        $rolUsuarioFinal = Rol::where('nombre', 'Usuario final')->firstOrFail();

        $datos = $request->validate([
            'user_id' => [
                'required',
                Rule::exists('users', 'id')->where(function ($query) use ($rolUsuarioFinal) {
                    $query->where('role_id', $rolUsuarioFinal->id)
                        ->where('estado', 'activo');
                }),
            ],
            'tipo_acreditacion_id' => ['required', 'exists:tipos_acreditacion,id'],
            'partido_id' => [
                'required',
                'exists:partidos,id',
                Rule::unique('credenciales', 'partido_id')->where(function ($query) use ($request) {
                    $query->where('user_id', $request->input('user_id'));
                }),
            ],
            'fecha_emision' => ['required', 'date'],
            'fecha_vencimiento' => ['required', 'date', 'after_or_equal:fecha_emision'],
            
        ], [
            'user_id.required' => 'Debe seleccionar un usuario.',
            'user_id.exists' => 'El usuario seleccionado no es válido.',
            'tipo_acreditacion_id.required' => 'Debe seleccionar un tipo de acreditación.',
            'partido_id.required' => 'Debe seleccionar un partido.',
            'partido_id.unique' => 'Este usuario ya tiene una credencial para ese partido.',
            'fecha_vencimiento.after_or_equal' => 'La fecha de vencimiento no puede ser anterior a la fecha de emisión.',
        ]);

        $credencial = Credencial::create([
            'user_id' => $datos['user_id'],
            'tipo_acreditacion_id' => $datos['tipo_acreditacion_id'],
            'partido_id' => $datos['partido_id'],
            'codigo_credencial' => $this->generarCodigoCredencial(),
            'fecha_emision' => $datos['fecha_emision'],
            'fecha_vencimiento' => $datos['fecha_vencimiento'],
            'estado' => 'activa',
        ]);

        return redirect()
            ->route('operador.credenciales.show', $credencial)
            ->with('success', 'Credencial emitida correctamente.');
    }

    public function show(Credencial $credencial): View
    {
        $credencial->load(['user', 'tipoAcreditacion', 'partido.estadio']);

        return view('operador.credenciales.show', compact('credencial'));
    }

    public function edit(Credencial $credencial): View
    {
        $credencial->load(['user', 'tipoAcreditacion', 'partido']);

        return view('operador.credenciales.edit', compact('credencial'));
    }

    public function update(Request $request, Credencial $credencial): RedirectResponse
    {
        $datos = $request->validate([
            'estado' => ['required', Rule::in(['activa', 'suspendida', 'vencida'])],
            
        ], [
            'estado.required' => 'Debe seleccionar un estado.',
            'estado.in' => 'El estado seleccionado no es válido.',
        ]);

        $credencial->update([
    'estado' => $datos['estado'],
]);

        return redirect()
            ->route('operador.credenciales.show', $credencial)
            ->with('success', 'Credencial actualizada correctamente.');
    }

    private function generarCodigoCredencial(): string
    {
        $numero = (Credencial::max('id') ?? 0) + 1;

        do {
            $codigo = 'CRD-2026-' . str_pad($numero, 5, '0', STR_PAD_LEFT);
            $numero++;
        } while (Credencial::where('codigo_credencial', $codigo)->exists());

        return $codigo;
    }
}