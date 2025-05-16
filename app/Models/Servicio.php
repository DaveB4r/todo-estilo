<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha',
        'user_id',
        'categoria',
        'tipo_servicio_id',
        'metodo_pago',       
        'observaciones',
        'porcentaje',
        'precio',
    ];

    // Relación con el estilista (usuario)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relación con el tipo de servicio
    public function tipoServicio()
    {
        return $this->belongsTo(TipoServicio::class, 'tipo_servicio_id');
    }
}