<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salida extends Model // ¡Cambiado de 'Ingreso' a 'Salida'!
{
    use HasFactory;

    // Si tu tabla de salidas no se llama 'salidas', debes especificarla
    // protected $table = 'nombre_de_tu_tabla_de_salidas';

    protected $fillable = [
        'fecha',
        'entrada', // Si 'entrada' es un campo real en Salidas, si no, puedes quitarlo
        'observacion',
        'medio_pago',
        'valor',
        // Agrega aquí cualquier otro campo que quieras permitir asignar masivamente
    ];
}