<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ClienteController extends Controller
{
    /**
     * Display a listing of the clientes.
     */
    public function index()
    {
        $clientes = Cliente::all();
        return view('cuentasPorCobrar.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new cliente.
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created cliente in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'identificacion' => 'required|integer|unique:clientes',
            'nombre' => 'required|string|max:255',
            'apellido' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
            'observaciones' => 'nullable|string',
        ]);

        Cliente::create($request->all());

        return Redirect::route('cuentasPorCobrar.index')->with('success', 'Cliente creado exitosamente.');
    }

    /**
     * Display the specified cliente.
     */
    public function show(Cliente $cliente)
    {
        return view('clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified cliente.
     */
    public function edit(Cliente $cliente)
    {
        return view('clientes/formulario_editar_cliente', compact('cliente'));
    }

    /**
     * Update the specified cliente in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'identificacion' => 'required|integer|unique:clientes,identificacion,' . $cliente->identificacion . ',identificacion',
            'nombre' => 'required|string|max:255',
            'apellido' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
            'observaciones' => 'nullable|string',
        ]);

        $cliente->update($request->all());

        return Redirect::route('cuentasPorCobrar.index')->with('success', 'Cliente actualizado exitosamente.');
    }


    /**
     * Remove the specified cliente from storage.
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();

        return Redirect::route('cuentasPorCobrar.index')->with('success', 'Cliente eliminado exitosamente.');
    }
}
