<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Servicio;
use App\Models\Ingreso;
use App\Models\Salida;

class CuadreDeCajaController extends Controller
{
    public function index(Request $request)
    {
        // 1. Obtener el mes y el año de la solicitud, con valores por defecto seguros
        // Si no se envían, usaremos el mes y año actuales como enteros.
        $mes = (int) $request->input('mes', date('n'));
        $ano = (int) $request->input('ano', date('Y'));

        // Ya no necesitamos filter_var aquí porque request->input con un segundo argumento
        // ya nos asegura un valor por defecto. La conversión a (int) es la última garantía.

        // Asegurarse de que el mes esté en el rango 1-12
        if ($mes < 1 || $mes > 12) {
            $mes = (int) date('n'); // Aseguramos que el valor por defecto también sea int
        }

        // Obtener el primer y último día del mes y año seleccionados
        // Carbon ahora recibirá siempre INTs válidos.
        $fechaInicio = Carbon::create($ano, $mes, 1)->startOfDay();
        $fechaFin = Carbon::create($ano, $mes)->endOfMonth()->endOfDay();

        // 2. Calcular el Saldo Total en Efectivo
        $ingresosServiciosEfectivo = Servicio::where('metodo_pago', 'Efectivo')
            ->whereBetween('fecha', [$fechaInicio, $fechaFin])
            ->sum('precio');

        $ingresosAdicionalesEfectivo = Ingreso::where('medio_pago', 'Efectivo')
            ->whereBetween('fecha', [$fechaInicio, $fechaFin])
            ->sum('valor');

        $salidasEfectivo = Salida::where('medio_pago', 'Efectivo')
            ->whereBetween('fecha', [$fechaInicio, $fechaFin])
            ->sum('valor');

        $saldoEfectivo = ($ingresosServiciosEfectivo + $ingresosAdicionalesEfectivo) - $salidasEfectivo;

        // 3. Calcular el Saldo Total en Transferencia
        $ingresosServiciosTransferencia = Servicio::where('metodo_pago', 'Transferencia')
            ->whereBetween('fecha', [$fechaInicio, $fechaFin])
            ->sum('precio');

        $ingresosAdicionalesTransferencia = Ingreso::where('medio_pago', 'Transferencia')
            ->whereBetween('fecha', [$fechaInicio, $fechaFin])
            ->sum('valor');

        $salidasTransferencia = Salida::where('medio_pago', 'Transferencia')
            ->whereBetween('fecha', [$fechaInicio, $fechaFin])
            ->sum('valor');

        $saldoTransferencia = ($ingresosServiciosTransferencia + $ingresosAdicionalesTransferencia) - $salidasTransferencia;

        // 4. Pasar los saldos a la vista
        return view('cuadre_de_caja', compact('saldoEfectivo', 'saldoTransferencia'));
    }
}
