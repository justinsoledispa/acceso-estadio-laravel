<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware(['auth', 'role:Administrador'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    });
});

Route::middleware(['auth', 'role:Operador de acreditación'])->group(function () {
    Route::get('/operador/dashboard', function () {
        return view('operador.dashboard');
    });
});

Route::middleware(['auth', 'role:Usuario final'])->group(function () {
    Route::get('/usuario/credencial', function () {
        return view('usuario.credencial');
    });
});