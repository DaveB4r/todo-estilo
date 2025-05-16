<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/admin';  // Cambiado de '/home' a '/' para redirigir a la página principal

    public function boot(): void
    {
        // Configuración del limitador de velocidad para la API
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        // Registrar las rutas web y API
        $this->routes(function () {
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));
        });

        // Deshabilitar completamente el registro
        Route::middleware('web')->group(function () {
            // Redirigir cualquier intento de acceso a la página de registro
            Route::match(['get', 'post'], 'register', function () {
                return redirect('/');
            });

            // Deshabilitar la ruta de registro
            Route::any('register', function () {
                abort(404);
            });
        });
    }
}
