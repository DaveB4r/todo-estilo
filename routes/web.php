<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\TipoServicioController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\IngresoController;
use App\Http\Controllers\SalidaController;
use App\Http\Controllers\RegistrarIngresoController;
use App\Http\Controllers\RegistrarSalidaController;


// Rutas públicas
Route::get('/', function () {
    return view('principal');
});

// Rutas protegidas que requieren autenticación
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('admin');
    })->name('dashboard');

    // Rutas del perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas de usuarios
     Route::resource('usuarios', UsuarioController::class);
  

    // Rutas de tipo de servicios (usando resource)
    Route::resource('tipo_servicios', TipoServicioController::class);
    // Esto cubre:
    // GET    /tipo_servicios             → index
    // GET    /tipo_servicios/create     → create
    // POST   /tipo_servicios            → store
    // GET    /tipo_servicios/{id}       → show (si se implementa)
    // GET    /tipo_servicios/{id}/edit  → edit
    // PUT    /tipo_servicios/{id}       → update
    // DELETE /tipo_servicios/{id}       → destroy

    // Rutas de servicios
    Route::resource('/servicios', ServicioController::class);


   // Rutas de salidas 
   // Route::resource('salidas', SalidaController::class);

    // Rutas de registrar ingresos

    Route::get('/ingresos', [IngresoController::class, 'index'])->name('ingresos.index');

    // Rutas para mostrar el formulario de registrar ingreso y guardar el nuevo ingreso
    Route::get('/registro_ingresos/crear', [RegistrarIngresoController::class, 'create'])->name('registro_ingresos.create');
    Route::post('/registro_ingresos', [RegistrarIngresoController::class, 'store'])->name('registro_ingresos.store');

    // Si necesitas rutas para editar, actualizar y eliminar ingresos,
   
    Route::post('/registro_ingresos', [RegistrarIngresoController::class, 'store'])->name('registro_ingresos.store');

    // Ruta para mostrar el formulario de registrar salida y guardar la nueva salida

    Route::resource('salidas', RegistrarSalidaController::class);

    // Rutas de salidas
    Route::get('/ingresos/{ingreso}/edit', [IngresoController::class, 'edit'])->name('ingresos.edit');
    Route::put('/ingresos/{ingreso}', [IngresoController::class, 'update'])->name('ingresos.update');
    Route::delete('/ingresos/{ingreso}', [IngresoController::class, 'destroy'])->name('ingresos.destroy');  
    Route::delete('/ingresos/{ingreso}', [IngresoController::class, 'destroy'])->name('ingresos.destroy');

});

// Rutas de autenticación
require __DIR__ . '/auth.php';
