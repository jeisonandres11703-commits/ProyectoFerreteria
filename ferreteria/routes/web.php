<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\TipoproductoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Rutas de autenticación (públicas)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Página de inicio pública - muestra productos
Route::get('/', [ProductoController::class, 'index'])->name('home');

// Rutas públicas para ver productos (solo lectura)


// Rutas protegidas (requieren autenticación)
Route::middleware(['check.session'])->group(function () {
    
    // Dashboard del administrador
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    
    // Gestión de productos (admin)
    Route::prefix('admin')->group(function () {
        
           

       

              // Ruta para obtener datos de productos vía AJAX 
Route::resource('productos', ProductoController::class);
Route::get('productos/data/ajax', [ProductoController::class, 'getData'])->name('productos.data');

    });
});

