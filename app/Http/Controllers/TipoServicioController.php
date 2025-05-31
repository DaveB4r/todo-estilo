<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoServicio;

class TipoServicioController extends Controller
{
    public function index()
    {
        $tiposServicio = TipoServicio::all();
        return view('tipo_servicios', compact('tiposServicio'));
    }

    public function create()
    {
        return view('formulario_crear_tipo_servicios');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'categoria' => 'required|string|max:255',
            'descripcion' => 'required|string|max:500',
            'porcentaje' => 'required|numeric|min:0|max:100',
            'precio' => 'required|integer|min:0',
        ]);

        TipoServicio::create([
            'nombre' => $request->nombre,
            'categoria' => $request->categoria,
            'descripcion' => $request->descripcion,
            'porcentaje' => $request->porcentaje,
            'precio' => $request->precio,
        ]);

        return redirect()->route('tipo_servicios.index')->with('success', 'Servicio creado exitosamente.');
    }

    public function edit(TipoServicio $tipoServicio)
    {
        return view('formulario_editar_tipo_servicios', compact('tipoServicio'));
    }

    public function update(Request $request, TipoServicio $tipoServicio)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'categoria' => 'required|string|max:255',
            'descripcion' => 'required|string|max:500',
            'porcentaje' => 'required|numeric|min:0|max:100',
            'precio' => 'required|integer|min:0',
        ]);

        $tipoServicio->update($request->all());

        return redirect()->route('tipo_servicios.index')->with('success', 'Servicio actualizado exitosamente.');
    }

    public function destroy(TipoServicio $tipoServicio)
    {
        $tipoServicio->delete();
        return redirect()->route('tipo_servicios.index')->with('success', 'Servicio eliminado exitosamente.');
    }
}
