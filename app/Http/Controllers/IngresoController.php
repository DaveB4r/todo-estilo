<?php

namespace App\Http\Controllers;

use App\Models\Ingreso; // Asegúrate de importar el modelo Ingreso
use Illuminate\Http\Request;

class IngresoController extends Controller
{
    /**
     * Display a listing of the ingresos.
     */
    public function index()
    {
        $ingresos = Ingreso::all(); // Obtiene todos los ingresos de la base de datos
        return view('ingresos', compact('ingresos')); // Carga la vista 'ingresos' y le pasa los datos
    }

    /**
     * Show the form for creating a new ingreso.
     */
    public function create()
    {
        return view('crear_ingreso'); // Crea un nuevo formulario para crear ingresos
    }

    /**
     * Store a newly created ingreso in storage.
     */
    public function store(Request $request)
    {
        // Aquí va la lógica para validar y guardar un nuevo ingreso
        $request->validate([
            'fecha' => 'required|date',
            'entrada' => 'nullable|string|max:255',
            'observacion' => 'nullable|string',
            'medio_pago' => 'nullable|string|max:255',
            'valor' => 'required|integer|min:0',
        ]);

        Ingreso::create($request->all());

        return redirect()->route('ingresos.index')->with('success', 'Ingreso registrado correctamente.');
    }

    /**
     * Show the form for editing the specified ingreso.
     */
    public function edit(Ingreso $ingreso)
    {
        return view('formulario_editar_ingreso', compact('ingreso')); // Muestra el formulario para editar un ingreso
    }

    /**
     * Update the specified ingreso in storage.
     */
    public function update(Request $request, Ingreso $ingreso)
    {
        // Aquí va la lógica para validar y actualizar el ingreso
        $request->validate([
            'fecha' => 'required|date',
            'entrada' => 'nullable|string|max:255',
            'observacion' => 'nullable|string',
            'medio_pago' => 'nullable|string|max:255',
            'valor' => 'required|integer|min:0',
        ]);

        $ingreso->update($request->all());

        return redirect()->route('ingresos.index')->with('success', 'Ingreso actualizado correctamente.');
    }

    /**
     * Remove the specified ingreso from storage.
     */
    public function destroy(Ingreso $ingreso)
    {
        $ingreso->delete();
        return redirect()->route('ingresos.index')->with('success', 'Ingreso eliminado correctamente.');
    }
}