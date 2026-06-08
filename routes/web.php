<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EstadioController;
use App\Http\Controllers\ZonaController;
use App\Http\Controllers\PuntoAccesoController;
use App\Http\Controllers\PartidoController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware(['auth', 'role:Administrador'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/reportes', [AdminController::class, 'reportes'])->name('reportes');

    Route::resource('estadios', EstadioController::class);
    Route::resource('partidos', PartidoController::class);

    Route::post('/estadios/{estadio}/zonas', [ZonaController::class, 'store'])->name('zonas.store');
    Route::post('/zonas/{zona}/puntos', [PuntoAccesoController::class, 'store'])->name('puntos.store');

    Route::get('/partidos/{partid}/zonas', [PartidoController::class, 'editZonas'])->name('partidos.zonas');
    Route::post('/partidos/{partid}/zonas', [PartidoController::class, 'updateZonas'])->name('partidos.zonas.update');
    Route::get('/tipos-acreditacion/zonas', [AdminController::class, 'editTiposZonas'])->name('tipos_acreditacion.zonas');
    Route::post('/tipos-acreditacion/zonas', [AdminController::class, 'updateTiposZonas'])->name('tipos_acreditacion.zonas.update');
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