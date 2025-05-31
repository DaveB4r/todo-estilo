<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoServicio extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'categoria',
        'descripcion',
        'porcentaje',
        'precio',
    ];

    // ¡Añade esta propiedad para el "casting" de atributos!
    protected $casts = [
        'precio' => 'integer',
        // Si tu campo 'porcentaje' en la BD es DECIMAL (ej. DECIMAL(5,2)),
        // también es buena práctica añadirlo aquí para que PHP lo trate como float.
        // 'porcentaje' => 'decimal:2', // o el número de decimales que uses
    ];


    public function servicios()
    {
        return $this->hasMany(Servicio::class);
    }
}
