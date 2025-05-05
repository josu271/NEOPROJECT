<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FacturacionController;
use App\Http\Controllers\EstadoCuentaController;
use App\Http\Controllers\CobranzasController;
use App\Http\Controllers\ServicioMasivoController;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\ComprasController;
use App\Http\Controllers\CierreCajaController;

Route::get('/', function() {
    return redirect()->route('login');
});

// Login
Route::get('/login', [AuthController::class, 'showLoginForm'])
     ->name('login');
Route::post('/login', [AuthController::class, 'login'])
     ->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])
     ->name('logout');

// Rutas protegidas por autenticación
Route::middleware('auth')->group(function() {

    // Dashboard (Menú Principal)
    Route::get('/dashboard', fn() => view('auth.menu'))
         ->name('dashboard');

    // Módulo Clientes (CRUD)
    Route::resource('clientes', ClienteController::class);

    // Facturación Masiva
    Route::get('facturacion/masiva', [FacturacionController::class, 'masiva'])
         ->name('facturacion.masiva');

    // Estado de Cuenta
    Route::get('estado/cuenta', [EstadoCuentaController::class, 'index'])
         ->name('estado.cuenta');

    // Cobranzas (CRUD)
    Route::resource('cobranzas', CobranzasController::class);

    // Servicio Masivo
    Route::get('servicio/masivo', [ServicioMasivoController::class, 'index'])
         ->name('servicio.masivo');

    // Servicios (CRUD)
    Route::resource('servicios', ServiciosController::class);

    // Gestión y Compras (CRUD)
    Route::resource('compras', ComprasController::class);

    // Cierre de Caja
    Route::get('cierre/caja', [CierreCajaController::class, 'index'])
         ->name('cierre.caja');

});