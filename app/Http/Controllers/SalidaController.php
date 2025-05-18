<?php

namespace App\Http\Controllers;

use App\Models\Salida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect; 

class SalidaController extends Controller
{
    /**
     * Display a listing of the salidas.
     */
    public function index()
    {
        $salidas = Salida::all();
        return view('salidas.index', compact('salidas')); 
  
    }

    /**
     * Show the form for creating a new salida.
     */
    public function create()
    {
        return view('salidas.create'); // Asegúrate de crear la vista 'salidas.create'
    }

    /**
     * Store a newly created salida in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'salida' => 'nullable|string|max:255',
            'observacion' => 'nullable|string',
            'medio_pago' => 'nullable|string|max:255',
            'valor' => 'required|integer|min:0',
        ]);

        Salida::create($request->all());

        return redirect()->route('salidas.index')->with('success', 'Salida registrada correctamente.');
    }

    /**
     * Show the form for editing the specified salida.
     */
    public function edit(Salida $salida)
    {
        return view('formulario_editar_salida', compact('salida')); // Asegúrate de crear la vista 'salidas.edit'
    }

    /**
     * Update the specified salida in storage.
     */
    public function update(Request $request, Salida $salida)
    {
        $request->validate([
            'fecha' => 'required|date',
            'salida' => 'nullable|string|max:255',
            'observacion' => 'nullable|string',
            'medio_pago' => 'nullable|string|max:255',
            'valor' => 'required|integer|min:0',
        ]);

        $salida->update($request->all());

        return redirect()->route('salidas.index')->with('success', 'Salida actualizada correctamente.');
    }

    /**
     * Remove the specified salida from storage.
     */
    public function destroy(Salida $salida)
    {
        $salida->delete();
        return redirect()->route('salidas.index')->with('success', 'Salida eliminada correctamente.');
    }
    
}