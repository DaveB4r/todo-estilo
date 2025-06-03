<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\CuentaPorCobrar;
use App\Models\TipoServicio;
use App\Models\Servicio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
        $query = CuentaPorCobrar::query()->with(['cliente', 'tipoServicio']);

        if ($request->has('estado') && $request->input('estado') != '') {
            $query->where('estado', $request->input('estado'));
        }

        $cuentasPorCobrar = $query->get();
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
            'cliente_id' => 'required|exists:clientes,identificacion',
            'tipo_servicio_id' => 'required|exists:tipo_servicios,id',
            'fecha' => 'required|date',
            'valor' => 'required|numeric|min:0',
            'observaciones' => 'nullable|string|max:255',
            'estado' => 'required|in:Pendiente,Paga',
        ]);

        CuentaPorCobrar::create($request->all());

        return redirect()->route('cuentasPorCobrar.index')->with('success', 'Cuenta por cobrar creada exitosamente.');
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
            'cliente_id' => 'required|exists:clientes,identificacion',
            'tipo_servicio_id' => 'required|exists:tipo_servicios,id',
            'fecha' => 'required|date',
            'valor' => 'required|numeric|min:0',
            'observaciones' => 'nullable|string|max:255',
            'estado' => 'required|in:Pendiente,Paga',
        ]);

        $cuentaPorCobrar->update($request->all());

        return redirect()->route('cuentasPorCobrar.index')->with('success', 'Cuenta por cobrar actualizada exitosamente.');
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

        return redirect()->route('cuentasPorCobrar.index')->with('success', 'Cuenta por cobrar eliminada exitosamente.');
    }


    /**
     * Muestra el formulario para registrar un pago (como un servicio) de una cuenta por cobrar.
     *
     * @param  \App\Models\CuentaPorCobrar  $cuentaPorCobrar
     * @return \Illuminate\View\View
     */
    public function createPago(CuentaPorCobrar $cuentaPorCobrar)
    {
        $estilistas = User::all();
        $categorias = TipoServicio::pluck('categoria')->unique()->toArray();
        $tipoServicios = TipoServicio::all();

        return view('cuentas_por_cobrar.pago', [
            'cuenta' => $cuentaPorCobrar,
            'estilistas' => $estilistas,
            'categorias' => $categorias,
            'tipoServicios' => $tipoServicios,
        ]);
    }

    /**
     * Procesa el pago, crea un registro de servicio y actualiza el estado de la cuenta por cobrar.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storePago(Request $request)
    {
        $request->validate([
            'cuenta_por_cobrar_id' => 'required|exists:cuentas_por_cobrar,id',
            'fecha' => 'required|date',
            'user_id' => 'required|exists:users,id',
            'categoria' => ['required', 'string', Rule::in(TipoServicio::pluck('categoria')->unique()->toArray())],
            'tipo_servicio_id' => 'required|exists:tipo_servicios,id',
            'metodo_pago' => 'required|string|in:Efectivo,Transferencia,Tarjeta',
            'observaciones' => 'nullable|string|max:500',
            'porcentaje' => 'required|numeric|min:0|max:100', // Sigue validando el entero (0-100)
            'precio' => 'required|numeric|min:0',
        ]);

        $cuenta = CuentaPorCobrar::findOrFail($request->cuenta_por_cobrar_id);

        // --- AJUSTE CLAVE AQUÍ: Convertir el porcentaje de entero a decimal ---
        $porcentajeDecimal = $request->porcentaje / 100;

        Servicio::create([
            'fecha' => $request->fecha,
            'user_id' => $request->user_id,
            'categoria' => $request->categoria,
            'tipo_servicio_id' => $request->tipo_servicio_id,
            'metodo_pago' => $request->metodo_pago,
            'observaciones' => $request->observaciones,
            'porcentaje' => $porcentajeDecimal, // Guardamos el valor decimal
            'precio' => $request->precio,
        ]);

        $cuenta->estado = 'Pagada';
        $cuenta->save();

        return redirect()->route('cuentasPorCobrar.index')->with('success', 'Pago registrado como servicio y cuenta por cobrar marcada como pagada.');
    }
}
