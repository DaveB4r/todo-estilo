<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CuentaPorCobrar extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cuentas_por_cobrar';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'cliente_id',
        'tipo_servicio_id', // ¡CAMBIO AQUÍ! Consistentemente a 'tipo_servicio_id'
        'fecha',
        'valor',
        'observaciones',
        'estado',
    ];

    /**
     * Define the relationship with the Cliente model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cliente(): BelongsTo
    {
        // El segundo parámetro es la clave foránea en CuentasPorCobrar ('cliente_id').
        // El tercer parámetro es la clave primaria en Cliente que 'cliente_id' referencia ('identificacion').
        return $this->belongsTo(Cliente::class, 'cliente_id', 'identificacion');
    }

    /**
     * Define the relationship with the TipoServicio model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipoServicio(): BelongsTo
    {
        // ¡CAMBIO AQUÍ! Si el campo en la tabla 'cuentas_por_cobrar' es 'tipo_servicio_id'
        // y el ID en 'tipo_servicios' es 'id' (lo predeterminado), no se necesita el tercer parámetro.
        return $this->belongsTo(TipoServicio::class, 'tipo_servicio_id');
    }
}