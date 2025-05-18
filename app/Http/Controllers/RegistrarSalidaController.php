<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salida; // Asegúrate de que el nombre del modelo sea Salida
use Illuminate\Support\Facades\Redirect; // ¡Añade esta línea!

class RegistrarSalidaController extends Controller
{
    /**
     * Muestra el formulario para registrar una nueva salida.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $salidas = Salida::all(); // Obtiene todas las salidas de la base de datos
        return view('salidas.index', compact('salidas')); // Carga la vista 'salidas.index' y le pasa los datos
    }

    public function create()
    {
        return view('formulario_registrar_salida'); // Asegúrate de que el nombre de la vista coincida
    }

    /**
     * Guarda una nueva salida en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Valida los datos del formulario (opcional, pero recomendado)
        $request->validate([
            'fecha' => 'required|date',
            'salida' => 'required|string|max:255',
            'observacion' => 'nullable|string',
            'medio_pago' => 'required|string|max:255',
            'valor' => 'required|numeric|min:0',
        ]);

        // Crea una nueva instancia del modelo Salida
        $salida = new Salida();
        $salida->fecha = $request->input('fecha');
        $salida->salida = $request->input('salida');
        $salida->observacion = $request->input('observacion');
        $salida->medio_pago = $request->input('medio_pago');
        $salida->valor = $request->input('valor');

        // Guarda la salida en la base de datos
        $salida->save();

        // Redirige con un mensaje de éxito
        return redirect('/salidas')->with('success', 'Salida registrada correctamente.');

    }

    public function destroy(Salida $salida) // O podrías recibir el ID directamente: destroy($id)
    {
        // Lógica para eliminar la salida de la base de datos
        $salida->delete();

        // Redireccionar a la ruta nombrada 'salidas.index' con un mensaje de éxito
        return Redirect::route('salidas.index')->with('success', 'Salida eliminada correctamente.');
    }

    public function edit(Salida $salida)
    {
        return view('formulario_editar_salida', compact('salida'));
    }

    /**
     * Actualiza la salida especificada en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Salida  $salida
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Salida $salida)
    {
        // Valida los datos del formulario (opcional, pero recomendado)
        $request->validate([
            'fecha' => 'required|date',
            'salida' => 'required|string|max:255',
            'observacion' => 'nullable|string',
            'medio_pago' => 'required|string|max:255',
            'valor' => 'required|numeric|min:0',
        ]);

        // Actualiza los atributos del modelo Salida con los datos del formulario
        $salida->fecha = $request->input('fecha');
        $salida->salida = $request->input('salida');
        $salida->observacion = $request->input('observacion');
        $salida->medio_pago = $request->input('medio_pago');
        $salida->valor = $request->input('valor');

        // Guarda los cambios en la base de datos
        $salida->save();

        // Redirige con un mensaje de éxito
        return redirect()->route('salidas.index')->with('success', 'Salida actualizada correctamente.');
    }
}