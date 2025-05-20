<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Servicio;
use App\Models\TipoServicio;

class LiquidacionesController extends Controller
{
    public function index(Request $request)
    {
        $usuarios = User::all();
        $fechaInicio = $request->input('fecha_inicio');
        $fechaFin = $request->input('fecha_fin');

        $serviciosPorUsuario = [];
        $totalesPorUsuario = [];

        foreach ($usuarios as $usuario) {
            $query = Servicio::where('user_id', $usuario->id)
                ->join('tipo_servicios', 'servicios.tipo_servicio_id', '=', 'tipo_servicios.id')
                ->select('servicios.fecha', 'tipo_servicios.nombre as tipo_servicio', 'servicios.precio', 'servicios.porcentaje');

            if ($fechaInicio && $fechaFin) {
                $query->whereBetween('servicios.fecha', [$fechaInicio, $fechaFin]);
            } elseif ($fechaInicio) {
                $query->where('servicios.fecha', '>=', $fechaInicio);
            } elseif ($fechaFin) {
                $query->where('servicios.fecha', '<=', $fechaFin);
            }

            $servicios = $query->get();
            $serviciosPorUsuario[$usuario->name] = $servicios;

            // Calcular el total de liquidación para este usuario
            $totalLiquidacion = 0;
            foreach ($servicios as $servicio) {
                $totalLiquidacion += $servicio->precio * $servicio->porcentaje;
            }
            $totalesPorUsuario[$usuario->name] = $totalLiquidacion;
        }

        return view('liquidaciones.index', compact('serviciosPorUsuario', 'fechaInicio', 'fechaFin', 'totalesPorUsuario'));
    }
}