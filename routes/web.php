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
Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
Route::get('/productos/{id}', [ProductoController::class, 'show'])->name('productos.show');

// Rutas protegidas (requieren autenticación)
Route::middleware(['check.session'])->group(function () {
    
    // Dashboard del administrador
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    
    // Gestión de productos (admin)
    Route::prefix('admin')->group(function () {
        
        // CRUD completo de productos
        Route::resource('productos', ProductoController::class)->except(['index', 'show']);
        
        // CRUD completo de tipos de producto
        Route::resource('tiposProducto', TipoproductoController::class)->names([
            'index' => 'tiposProducto.index',
            'create' => 'tiposProducto.create',
            'store' => 'tiposProducto.store',
            'edit' => 'tiposProducto.edit',
            'update' => 'tiposProducto.update',
            'destroy' => 'tiposProducto.destroy',
            'show' => 'tiposProducto.show',
        ]);
    });
});