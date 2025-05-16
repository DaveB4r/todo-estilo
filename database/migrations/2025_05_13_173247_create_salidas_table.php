<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salidas', function (Blueprint $table) {
            $table->id(); // Crea una columna 'id' como clave primaria autoincremental (BIGINT UNSIGNED)
            $table->date('fecha'); // Campo para la fecha (tipo DATE)
            $table->string('salida')->nullable(); // Campo para la entrada (VARCHAR), puede ser nulo
            $table->string('observacion')->nullable(); // Campo para la observación (VARCHAR), puede ser nulo
            $table->string('medio_pago')->nullable(); // Campo para el medio de pago (VARCHAR), puede ser nulo
            $table->integer('valor'); // Campo para el valor (INT)
            $table->timestamps(); // Crea las columnas 'created_at' y 'updated_at' para el seguimiento de tiempo
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salidas'); // Elimina la tabla 'ingresos' si la migración se revierte
    }
}

