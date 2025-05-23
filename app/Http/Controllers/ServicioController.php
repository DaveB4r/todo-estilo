<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use App\Models\User;
use App\Models\TipoServicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log; // Importa la fachada Log

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
        Log::info('Datos recibidos en store (antes de validación):', $request->all());

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
                // ¡Añadir validación para porcentaje y precio!
                'porcentaje'        => 'required|numeric|between:0,100', // Asumo que es un porcentaje de 0 a 100
                'precio'            => 'required|numeric|min:0', // Asumo que el precio debe ser un número positivo
            ]);

            Log::info('Datos validados:', $validatedData);

            // Buscar tipo de servicio seleccionado
            // Aunque se busca, no usaremos sus valores de porcentaje y precio para la asignación final
            $tipoServicio = TipoServicio::findOrFail($validatedData['tipo_servicio_id']);

            // Crear y guardar el nuevo servicio
            $servicio = new Servicio();
            $servicio->fecha            = $validatedData['fecha'];
            $servicio->user_id          = $validatedData['user_id'];
            $servicio->categoria        = $validatedData['categoria'];
            $servicio->tipo_servicio_id = $validatedData['tipo_servicio_id']; // Usamos el ID del tipo de servicio
            $servicio->metodo_pago      = $validatedData['metodo_pago'];
            $servicio->observaciones    = $validatedData['observaciones'] ?? null;

            // ¡Aquí es el cambio crucial! Tomar los valores del request (validatedData)
            $servicio->porcentaje = $validatedData['porcentaje'] / 100; // Guarda el valor del formulario
            $servicio->precio = $validatedData['precio'];           // Guarda el valor del formulario

            $servicio->save();

            DB::commit();

            return redirect()
                ->route('dashboard')
                ->with('success', 'Servicio registrado exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error en store:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all() // Agrega los datos del request al log para depuración
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error al registrar el servicio: ' . $e->getMessage());
        }
    }

    /**
     * Mostrar el formulario para editar un servicio específico.
     */
    public function edit(Servicio $servicio)
    {
        $estilistas = User::all();
        $categorias = ['Peluquería', 'Uñas', 'Maquillaje'];
        $tipoServicios = TipoServicio::all();
        return view('formulario_editar_servicio', compact('servicio', 'estilistas', 'categorias', 'tipoServicios'));
    }

    /**
     * Actualizar el servicio especificado en la base de datos.
     */
    public function update(Request $request, Servicio $servicio)
    {
        Log::info('Datos recibidos en update para el servicio ' . $servicio->id . ':', $request->all());

        try {
            DB::beginTransaction();

            $validatedData = $request->validate([
                'fecha'             => 'required|date',
                'user_id'           => 'required|exists:users,id',
                'categoria'         => 'required|string|in:Peluquería,Uñas,Maquillaje',
                'tipo_servicio_id'  => 'required|exists:tipo_servicios,id',
                'metodo_pago'       => 'required|string|in:Efectivo,Transferencia',
                'observaciones'     => 'nullable|string|max:1000',
                // ¡Añadir validación para porcentaje y precio en update también!
                'porcentaje'        => 'required|numeric|between:0,100',
                'precio'            => 'required|numeric|min:0',
            ]);

            Log::info('Datos validados para update:', $validatedData);

            // Aunque se busca, no usaremos sus valores de porcentaje y precio para la asignación final
            $tipoServicio = TipoServicio::findOrFail($validatedData['tipo_servicio_id']);

            $servicio->fecha            = $validatedData['fecha'];
            $servicio->user_id          = $validatedData['user_id'];
            $servicio->categoria        = $validatedData['categoria'];
            $servicio->tipo_servicio_id = $validatedData['tipo_servicio_id']; // Usamos el ID del tipo de servicio
            $servicio->metodo_pago      = $validatedData['metodo_pago'];
            $servicio->observaciones    = $validatedData['observaciones'] ?? null;

            // ¡Aquí es el cambio crucial en update! Tomar los valores del request (validatedData)
            $servicio->porcentaje = $validatedData['porcentaje'] / 100; // Guarda el valor del formulario
            $servicio->precio = $validatedData['precio'];           // Guarda el valor del formulario

            $servicio->save();

            DB::commit();

            return Redirect::route('dashboard')->with('success', 'Servicio actualizado exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error en update para el servicio ' . $servicio->id . ':', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all() // Agrega los datos del request al log para depuración
            ]);

            return Redirect::back()->withInput()->with('error', 'Error al actualizar el servicio: ' . $e->getMessage());
        }
    }

    /**
     * Eliminar el servicio especificado de la base de datos.
     */
    public function destroy(Servicio $servicio)
    {
        try {
            $servicio->delete();
            return Redirect::route('dashboard')->with('success', 'Servicio eliminado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al eliminar el servicio ' . $servicio->id . ':', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return Redirect::back()->with('error', 'Error al eliminar el servicio: ' . $e->getMessage());
        }
    }
}