<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\CuentaPorCobrar;
use App\Models\TipoServicio;
use Illuminate\Http\Request;

class CuentasPorCobrarController extends Controller
{
    /**
     * Muestra el listado de cuentas por cobrar y los clientes, con opción de filtro por estado.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Inicia una consulta para CuentaPorCobrar e incluye las relaciones Cliente y TipoServicio
        $query = CuentaPorCobrar::query()->with(['cliente', 'tipoServicio']);

        // Aplica el filtro por estado si se proporciona en la URL
        if ($request->has('estado') && $request->input('estado') != '') {
            $query->where('estado', $request->input('estado'));
        }

        // Obtiene las cuentas por cobrar filtradas o todas si no hay filtro
        $cuentasPorCobrar = $query->get();

        // Obtiene todos los clientes y tipos de servicio para pasarlos a la vista, si son necesarios (ej. para el sidebar o futuros selectores)
        $clientes = Cliente::all();
        $tiposServicio = TipoServicio::all();

        return view('cuentas_por_cobrar.index', compact('cuentasPorCobrar', 'clientes', 'tiposServicio'));
    }

    /**
     * Muestra el formulario para crear una nueva cuenta por cobrar.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $clientes = Cliente::all();
        $tiposServicio = TipoServicio::all();
        // Asumiendo que la vista para crear es 'cuentas_por_cobrar.formulario_registrar_cuenta_por_cobrar'
        return view('cuentas_por_cobrar.formulario_registrar_cuenta_por_cobrar', compact('clientes', 'tiposServicio'));
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
            // ¡CAMBIO CLAVE AQUÍ!
            // Ahora validamos que el cliente_id enviado exista en la columna 'identificacion' de la tabla 'clientes'.
            'cliente_id' => 'required|exists:clientes,identificacion',
            // VALIDADO: Validamos que el tipo_servicio_id enviado exista en la columna 'id' de la tabla 'tipo_servicios'.
            'tipo_servicio_id' => 'required|exists:tipo_servicios,id',
            'fecha' => 'required|date',
            'valor' => 'required|numeric|min:0',
            'observaciones' => 'nullable|string|max:255',
            // VALIDADO: Validamos que el estado sea 'Pendiente' o 'Paga'.
            'estado' => 'required|in:Pendiente,Paga',
        ]);

        CuentaPorCobrar::create($request->all());

        return redirect()->route('cuentas_por_cobrar.index')->with('success', 'Cuenta por cobrar creada exitosamente.');
    }

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
        // Asumiendo que la vista para editar es 'cuentas_por_cobrar.formulario_editar_cuenta_por_cobrar'
        return view('cuentas_por_cobrar.formulario_editar_cuenta_por_cobrar', compact('cuentaPorCobrar', 'clientes', 'tiposServicio'));
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
            // ¡CAMBIO CLAVE AQUÍ!
            // Ahora validamos que el cliente_id enviado exista en la columna 'identificacion' de la tabla 'clientes'.
            'cliente_id' => 'required|exists:clientes,identificacion',
            // VALIDADO: Validamos que el tipo_servicio_id enviado exista en la columna 'id' de la tabla 'tipo_servicios'.
            'tipo_servicio_id' => 'required|exists:tipo_servicios,id',
            'fecha' => 'required|date',
            'valor' => 'required|numeric|min:0',
            'observaciones' => 'nullable|string|max:255',
            // VALIDADO: Validamos que el estado sea 'Pendiente' o 'Paga'.
            'estado' => 'required|in:Pendiente,Paga',
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