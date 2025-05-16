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
    Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
    Route::get('/usuarios/crear', [UsuarioController::class, 'create'])->name('usuarios.create');
    Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');
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
    Route::get('/servicios/registrar', [ServicioController::class, 'create'])->name('servicios.create');
    Route::post('/servicios', [ServicioController::class, 'store'])->name('servicios.store');
    Route::resource('servicios', ServicioController::class);

    // Rutas de ingresos
    // Route::get('/ingresos', [IngresoController::class, 'index'])->name('ingresos.index');
    //Route::get('/ingresos/crear', [IngresoController::class, 'create'])->name('ingresos.create');
    //Route::resource('ingresos', IngresoController::class);
    // Rutas de salidas 
    Route::resource('salidas', SalidaController::class);

    // Rutas de registrar ingresos
    //Route::resource('ingresos', RegistrarIngresoController::class);
    //Route::get('/registro_ingresos', [RegistrarIngresoController::class, 'index'])->name('registro_ingresos.index');
    //Route::get('/registro_ingresos/crear', [RegistrarIngresoController::class, 'create'])->name('registro_ingresos.create');
    //Route::post('/registro_ingresos', [RegistrarIngresoController::class, 'store'])->name('registro_ingresos.store');
    //Route::get('/registro_ingresos/{registro_ingreso}/edit', [RegistrarIngresoController::class, 'edit'])->name('registro_ingresos.edit');
    //Route::put('/registro_ingresos/{registro_ingreso}', [RegistrarIngresoController::class, 'update'])->name('registro_ingresos.update');
    //Route::delete('/registro_ingresos/{registro_ingreso}', [RegistrarIngresoController::class, 'destroy'])->name('registro_ingresos.destroy');
    // Ruta para mostrar la lista de ingresos (asociada a ingresos.blade.php)
    Route::get('/ingresos', [IngresoController::class, 'index'])->name('ingresos.index');

    // Rutas para mostrar el formulario de registrar ingreso y guardar el nuevo ingreso
    Route::get('/registro_ingresos/crear', [RegistrarIngresoController::class, 'create'])->name('registro_ingresos.create');
    Route::post('/registro_ingresos', [RegistrarIngresoController::class, 'store'])->name('registro_ingresos.store');

    // Si necesitas rutas para editar, actualizar y eliminar ingresos,
    // y quieres que las maneje IngresoController, puedes definirlas así:
    //Route::get('/ingresos/{ingreso}/edit', [IngresoController::class, 'edit'])->name('ingresos.edit');
    //Route::put('/ingresos/{ingreso}', [IngresoController::class, 'update'])->name('ingresos.update');
    //Route::delete('/ingresos/{ingreso}', [IngresoController::class, 'destroy'])->name('ingresos.destroy');
    //Route::resource('ingresos', IngresoController::class)->except(['create', 'store']);
    Route::post('/registro_ingresos', [RegistrarIngresoController::class, 'store'])->name('registro_ingresos.store');

    // Ruta para mostrar el formulario de registrar salida y guardar la nueva salida
    //Route::get('/salidas/create', [RegistrarSalidaController::class, 'create'])->name('salidas.registrar');
    //Route::post('/salidas', [RegistrarSalidaController::class, 'store'])->name('salidas.store');
    //Route::resource('salidas', IngresoController::class)->except(['create', 'store']);
    // Rutas de salidas - Usar el controlador correcto
Route::resource('salidas', RegistrarSalidaController::class);

// Rutas de salidas
Route::get('/ingresos/{ingreso}/edit', [IngresoController::class, 'edit'])->name('ingresos.edit');
Route::put('/ingresos/{ingreso}', [IngresoController::class, 'update'])->name('ingresos.update');
Route::delete('/ingresos/{ingreso}', [IngresoController::class, 'destroy'])->name('ingresos.destroy');  
Route::delete('/ingresos/{ingreso}', [IngresoController::class, 'destroy'])->name('ingresos.destroy');

});

// Rutas de autenticación
require __DIR__ . '/auth.php';
