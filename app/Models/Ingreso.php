<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    use HasFactory;
    protected $fillable = [
        'fecha',
        'entrada',
        'observacion',
        'medio_pago',
        'valor',
        // Agrega aquí cualquier otro campo que quieras permitir asignar masivamente
    ];
}