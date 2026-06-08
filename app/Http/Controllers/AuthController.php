<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credenciales = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credenciales)) {
            $request->session()->regenerate();

            $rol = Auth::user()->rol->nombre ?? null;

            if ($rol === 'Administrador') {
                return redirect('/admin/dashboard');
            }

            if ($rol === 'Operador de acreditación') {
                return redirect('/operador/dashboard');
            }

            if ($rol === 'Usuario final') {
                return redirect('/usuario/credencial');
            }

            Auth::logout();
            return redirect('/login')->with('error', 'El usuario no tiene un rol válido.');
        }

        return back()->with('error', 'Correo o contraseña incorrectos.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}