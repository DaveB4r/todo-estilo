<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;
use App\Models\CuentaPorCobrar; // ¡AQUÍ ESTÁ EL CAMBIO CLAVE! Quitamos la 's' al final del nombre del modelo

class IndicadoresController extends Controller
{
    public function index(Request $request)
    {
        // 1. Obtener el mes y el año de la solicitud, o usar el actual por defecto
        $mesSeleccionado = $request->input('mes', date('n'));
        $anoSeleccionado = $request->input('ano', date('Y'));

        // 2. Calcular los Ingresos del Mes (filtrado por mes y año)
        $ingresosMes = Servicio::whereMonth('created_at', $mesSeleccionado)
                               ->whereYear('created_at', $anoSeleccionado)
                               ->sum('precio');

        // 3. Calcular el Total de Cuentas por Cobrar (sumatoria total, sin filtro de mes/año)
        $totalCuentasPorCobrar = CuentaPorCobrar::sum('valor'); // Esto ya está bien

        // Array de meses para los select en la vista
        $meses = [
            1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril', 5 => 'Mayo', 6 => 'Junio',
            7 => 'Julio', 8 => 'Agosto', 9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
        ];

        return view('indicadores', compact('ingresosMes', 'totalCuentasPorCobrar', 'meses'));
    }
}