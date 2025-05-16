<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingreso; // O use App\Models\RegistrarIngreso;

class RegistrarIngresoController extends Controller


{
    /**
     * Muestra el formulario para registrar un nuevo ingreso.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('formulario_registrar_ingreso'); // Asegúrate de que la vista esté en resources/views/ingresos/create.blade.php
    }

    /**
     * Guarda un nuevo ingreso en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Recupera los datos del formulario
        $fecha = $request->input('fecha');
        $entrada = $request->input('entrada');
        $observacion = $request->input('observacion');
        $medioPago = $request->input('medio_pago'); // ¡Cuidado con la ortografía!
        $valor = $request->input('valor');

        // Crea una nueva instancia del modelo
        $ingreso = new Ingreso(); // Si tu modelo se llama Ingreso
        // Si tu modelo se llama RegistrarIngreso, usa:
        // $ingreso = new RegistrarIngreso();

        // Asigna los valores a los atributos del modelo
        $ingreso->fecha = $fecha;
        $ingreso->entrada = $entrada;
        $ingreso->observacion = $observacion;
        $ingreso->medio_pago = $medioPago;
        $ingreso->valor = $valor;

        // Guarda el modelo en la base de datos
        $ingreso->save();

        // Redirige con un mensaje de éxito
        return redirect('/dashboard')->with('success', 'Ingreso registrado correctamente.');
    }
}
