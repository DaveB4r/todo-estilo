<?php

namespace App\Http\Controllers;

use App\Models\Cliente; // Importa el modelo Cliente
use App\Models\CuentaPorCobrar; // Importa el modelo CuentaPorCobrar
use App\Models\TipoServicio; // Importa el modelo TipoServicio (si lo necesitas para el formulario)
use Illuminate\Http\Request;

class CuentasPorCobrarController extends Controller
{
    /**
     * Muestra el listado de cuentas por cobrar y los clientes.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $cuentasPorCobrar = CuentaPorCobrar::all(); // Obtiene todas las cuentas por cobrar
        $clientes = Cliente::all(); // Obtiene todos los clientes de la base de datos

        return view('cuentas_por_cobrar.index', compact('cuentasPorCobrar', 'clientes'));
    }

    /**
     * Muestra el formulario para crear una nueva cuenta por cobrar.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Aquí pasamos la lista de clientes y tipos de servicio para el formulario
        $clientes = Cliente::all();
        $tiposServicio = TipoServicio::all(); // Asegúrate de importar el modelo TipoServicio
        return view('cuentas_por_cobrar/formulario_registrar_cuenta_por_cobrar', compact('clientes', 'tiposServicio')); // Asegúrate de tener esta vista
    }

    /**
     * Guarda una nueva cuenta por cobrar en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
{
    $request->validate([
        'cliente_id' => 'required|exists:clientes,identificacion',
        'servicio_id' => 'required|exists:tipo_servicios,id',
        'fecha' => 'required|date',
        'valor' => 'required|numeric|min:0', // Cambia 'integer' a 'numeric'
        'observaciones' => 'nullable|string',
    ]);

    CuentaPorCobrar::create($request->all());

    return redirect()->route('cuentas_por_cobrar.index')->with('success', 'Cuenta por cobrar creada exitosamente.');
}

    // Puedes agregar más métodos para editar, eliminar, mostrar detalles de cuentas por cobrar, etc.

    /**
     * Muestra el formulario para editar una cuenta por cobrar existente.
     *
     * @param  \App\Models\CuentaPorCobrar  $cuentaPorCobrar
     * @return \Illuminate\View\View
     */
    public function edit(CuentaPorCobrar $cuentaPorCobrar)
    {
        $clientes = Cliente::all();
        $tiposServicio = TipoServicio::all();
        return view('cuentas_por_cobrar/formulario_editar_cuenta_por_cobrar', compact('cuentaPorCobrar', 'clientes', 'tiposServicio'));
    }

    /**
     * Actualiza la información de una cuenta por cobrar existente en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CuentaPorCobrar  $cuentaPorCobrar
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, CuentaPorCobrar $cuentaPorCobrar)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,identificacion',
            'servicio_id' => 'required|exists:tipo_servicios,id',
            'fecha' => 'required|date',
            'valor' => 'required|numeric|min:0',
            'observaciones' => 'nullable|string',
        ]);

        $cuentaPorCobrar->update($request->all());

        return redirect()->route('cuentas_por_cobrar.index')->with('success', 'Cuenta por cobrar actualizada exitosamente.');
    }

    /**
     * Elimina una cuenta por cobrar de la base de datos.
     *
     * @param  \App\Models\CuentaPorCobrar  $cuentaPorCobrar
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(CuentaPorCobrar $cuentaPorCobrar)
    {
        $cuentaPorCobrar->delete();

        return redirect()->route('cuentas_por_cobrar.index')->with('success', 'Cuenta por cobrar eliminada exitosamente.');
    }
}