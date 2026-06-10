<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class OperadorUsuarioController extends Controller
{
    public function index(): View
    {
        $rolUsuarioFinal = Rol::where('nombre', 'Usuario final')->firstOrFail();

        $usuarios = User::where('role_id', $rolUsuarioFinal->id)
            ->withCount('credenciales')
            ->orderBy('name')
            ->get();

        return view('operador.usuarios.index', compact('usuarios'));
    }

    public function create(): View
    {
        return view('operador.usuarios.create');
    }

public function store(Request $request): RedirectResponse
{
    $datos = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'apellido' => ['nullable', 'string', 'max:50'],
        'email' => ['required', 'email', 'max:255', 'unique:users,email'],
        'documento' => ['required', 'string', 'max:10', 'unique:users,documento'],
        'telefono' => ['nullable', 'regex:/^09[0-9]{8}$/'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ], [
        'telefono.regex' => 'El teléfono debe tener 10 dígitos y empezar con 09. Ejemplo: 0977777777.',
    ]);

    $rolUsuarioFinal = Rol::where('nombre', 'Usuario final')->firstOrFail();

    User::create([
        'role_id' => $rolUsuarioFinal->id,
        'name' => $datos['name'],
        'apellido' => $datos['apellido'] ?? null,
        'email' => $datos['email'],
        'documento' => $datos['documento'] ?? null,
        'telefono' => $datos['telefono'] ?? null,
        'password' => Hash::make($datos['password']),
        'estado' => 'activo',
    ]);

    return redirect()
        ->route('operador.usuarios.index')
        ->with('success', 'Usuario final registrado correctamente.');

}}