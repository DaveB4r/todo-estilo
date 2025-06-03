<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CuentaPorPagar;

class CuentasPorPagarController extends Controller
{
    public function create()
    {
        return view('cuentas_por_pagar.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'valor' => 'required|numeric|min:0',
            'fecha_vencimiento' => 'required|date',
            'estado' => 'required|in:Pendiente,Paga',
        ]);

        CuentaPorPagar::create($request->only(['descripcion', 'valor', 'fecha_vencimiento', 'estado']));

        return redirect()->route('cuentas-por-pagar.index')->with('success', 'Cuenta por pagar registrada exitosamente.');
    }

    public function index(Request $request)
    {
        $estado = $request->input('estado');

        $cuentasPorPagar = CuentaPorPagar::when($estado, function ($query, $estado) {
            return $query->where('estado', $estado);
        })->get();

        return view('cuentas_por_pagar', compact('cuentasPorPagar'));
    }
    public function destroy(CuentaPorPagar $cuentaPorPagar)
    {
        $cuentaPorPagar->delete();
        return redirect()->route('cuentas-por-pagar.index')->with('success', 'Cuenta por pagar eliminada exitosamente.');
    }

    public function edit($id)
    {
        $cuentaPorPagar = CuentaPorPagar::findOrFail($id);
        return view('cuentas_por_pagar.edit', compact('cuentaPorPagar'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'valor' => 'required|numeric|min:0',
            'fecha_vencimiento' => 'required|date',
            'estado' => 'required|in:Pendiente,Paga',
        ]);

        $cuenta = CuentaPorPagar::findOrFail($id);

        $cuenta->descripcion = $request->input('descripcion');
        $cuenta->valor = $request->input('valor');
        $cuenta->fecha_vencimiento = $request->input('fecha_vencimiento');
        $cuenta->estado = $request->input('estado');
        $cuenta->save();

        return redirect()->route('cuentas-por-pagar.index')->with('success', 'Cuenta actualizada exitosamente.');
    }
}
