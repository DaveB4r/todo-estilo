<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrarSalida extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'salidas'; // ¡Importante: Usa 'salidas' si ese es el nombre de tu tabla!

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id'; // Por defecto es 'id'

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true; // Por defecto es true (created_at y updated_at)

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fecha',
        'salida',
        'observacion',
        'medio_pago',
        'valor',
        // Agrega aquí cualquier otro campo que tengas en tu formulario
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        //
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'fecha' => 'date', // Para que la fecha se convierta en un objeto Carbon
        'valor' => 'decimal:2', // Si quieres formatear el valor como decimal con 2 lugares
    ];
}