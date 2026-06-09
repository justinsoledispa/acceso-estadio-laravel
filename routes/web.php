<?php
use App\Http\Controllers\OperadorCredencialController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OperadorUsuarioController;
use App\Http\Controllers\UsuarioFinalController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:Administrador'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

Route::middleware(['auth', 'role:Operador de acreditación'])->group(function () {
    Route::get('/operador/dashboard', function () {
        return view('operador.dashboard');
    })->name('operador.dashboard');

    Route::get('/operador/usuarios', [OperadorUsuarioController::class, 'index'])
        ->name('operador.usuarios.index');

    Route::get('/operador/usuarios/create', [OperadorUsuarioController::class, 'create'])
        ->name('operador.usuarios.create');

    Route::post('/operador/usuarios', [OperadorUsuarioController::class, 'store'])
        ->name('operador.usuarios.store');

    Route::get('/operador/credenciales', [OperadorCredencialController::class, 'index'])
    ->name('operador.credenciales.index');

Route::get('/operador/credenciales/create', [OperadorCredencialController::class, 'create'])
    ->name('operador.credenciales.create');

Route::post('/operador/credenciales', [OperadorCredencialController::class, 'store'])
    ->name('operador.credenciales.store');

Route::get('/operador/credenciales/{credencial}', [OperadorCredencialController::class, 'show'])
    ->name('operador.credenciales.show');

Route::get('/operador/credenciales/{credencial}/edit', [OperadorCredencialController::class, 'edit'])
    ->name('operador.credenciales.edit');

Route::put('/operador/credenciales/{credencial}', [OperadorCredencialController::class, 'update'])
    ->name('operador.credenciales.update');
});

Route::middleware(['auth', 'role:Usuario final'])->group(function () {
    Route::get('/usuario/credencial', [UsuarioFinalController::class, 'credencial'])
        ->name('usuario.credencial');

    Route::get('/usuario/simular-ingreso', [UsuarioFinalController::class, 'seleccionarCredencial'])
        ->name('usuario.simular-ingreso.seleccionar');

    Route::get('/usuario/credenciales/{credencial}/simular-ingreso', [UsuarioFinalController::class, 'simularIngreso'])
        ->name('usuario.simular-ingreso');

    Route::post('/usuario/credenciales/{credencial}/simular-ingreso', [UsuarioFinalController::class, 'procesarIngreso'])
        ->name('usuario.simular-ingreso.procesar');

    Route::get('/usuario/historial', [UsuarioFinalController::class, 'historial'])
        ->name('usuario.historial');
});