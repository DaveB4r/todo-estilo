<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes'; // Especifica el nombre de la tabla si no sigue la convención (plural del nombre del modelo)
    protected $primaryKey = 'identificacion'; // Especifica la clave primaria si no es 'id'
    public $incrementing = false; // Indica que la clave primaria no es autoincremental (si la identificación no es automática)
    protected $keyType = 'int'; // Especifica el tipo de dato de la clave primaria

    protected $fillable = [
        'identificacion',
        'nombre',
        'apellido',
        'telefono',
        'direccion',
        'observaciones',
    ];
}