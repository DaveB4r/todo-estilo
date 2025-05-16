<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tipo_servicios', function (Blueprint $table) {
            $table->id();
            $table->string('categoria');         // Columna para la categoría
            $table->string('descripcion');       // Columna para la descripción
            $table->string('nombre');            // Columna para el nombre
            $table->decimal('porcentaje', 5, 2); // Columna para el porcentaje con 2 decimales
            $table->decimal('precio', 10, 2);    // Columna para el precio con 2 decimales
            $table->timestamps();               // Timestamps (created_at y updated_at)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_servicios');
    }
};
