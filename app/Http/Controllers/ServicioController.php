<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use App\Models\User;
use App\Models\TipoServicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServicioController extends Controller
{
    /**
     * Mostrar el formulario de registro de servicio.
     */
    public function create()
    {
        // Cargar todos los estilistas
        $estilistas = User::all();

        // Categorías fijas
        $categorias = ['Peluquería', 'Uñas', 'Maquillaje'];

        // Cargar todos los servicios para filtrarlos luego con JS
        $tipoServicios = TipoServicio::all();

        return view('formulario_registrar_servicios', compact('estilistas', 'categorias', 'tipoServicios'));
    }

    /**
     * Guardar el nuevo servicio en la base de datos.
     */
    public function store(Request $request)
    {
        \Log::info('Datos recibidos en store:', $request->all());

        try {
            DB::beginTransaction();

            // Validar datos del formulario
            $validatedData = $request->validate([
                'fecha'             => 'required|date',
                'user_id'           => 'required|exists:users,id',
                'categoria'         => 'required|string|in:Peluquería,Uñas,Maquillaje',
                'tipo_servicio_id'  => 'required|exists:tipo_servicios,id',
                'metodo_pago'       => 'required|string|in:Efectivo,Transferencia',
                'observaciones'     => 'nullable|string|max:1000',
            ]);

            // Buscar tipo de servicio seleccionado
            $tipoServicio = TipoServicio::findOrFail($validatedData['tipo_servicio_id']);

            // Crear y guardar el nuevo servicio
            $servicio = new Servicio();
            $servicio->fecha             = $validatedData['fecha'];
            $servicio->user_id           = $validatedData['user_id'];
            $servicio->categoria         = $validatedData['categoria'];
            $servicio->tipo_servicio_id  = $tipoServicio->id;
            $servicio->metodo_pago       = $validatedData['metodo_pago'];
            $servicio->observaciones     = $validatedData['observaciones'] ?? null;
            $servicio->porcentaje        = $tipoServicio->porcentaje / 100;
            $servicio->precio            = $tipoServicio->precio;

            $servicio->save();

            DB::commit();

            return redirect()
                ->route('dashboard')
                ->with('success', 'Servicio registrado exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();

            \Log::error('Error en store:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error al registrar el servicio: ' . $e->getMessage());
        }
    }
}