<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuentaPorPagar extends Model
{
    use HasFactory;

    // Define las columnas que pueden ser asignadas masivamente (mass assignable).
    protected $fillable = [
        'descripcion',
        'valor',
        'fecha_vencimiento',
        'estado',
        // Asegúrate de agregar aquí cualquier otra columna que tengas en tu migración,
        // como 'user_id' o 'proveedor_id', si las estás usando.
    ];

    // Define cómo Laravel debe "castear" (convertir) los tipos de datos de las columnas.
    protected $casts = [
        'valor' => 'float', // Coincide con DECIMAL en BD, aunque con 0 decimales, float es lo apropiado en PHP
        'fecha_vencimiento' => 'date', // Para manejarla como objeto Carbon
    ];

    // ¡¡¡IMPORTANTE: AÑADE ESTA LÍNEA!!!
    // Le dice a Laravel que este modelo usa la tabla 'cuentas_por_pagar' (en singular)
    protected $table = 'cuentas_por_pagar';
}
    // Si el nombre de tu tabla no es 'cuentas_por_pagars' (plural de 'CuentaPorPagar'),
    // puedes especificarlo explícitamente:
    // protected $table = 'nombre_de_tu_tabla_de_cuentas';

    // Si no usas los timestamps 'created_at' y 'updated_at':
    // public $timestamps = false;
