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
        Schema::create('clientes', function (Blueprint $table) {
            $table->integer('identificacion')->primary(); // Campo de identificación (entero, clave primaria)
            $table->string('nombre');
            $table->string('apellido')->nullable(); // Permite valores nulos
            $table->string('telefono')->nullable(); // Permite valores nulos
            $table->string('direccion')->nullable(); // Permite valores nulos
            $table->text('observaciones')->nullable(); // Permite valores nulos para texto largo
            $table->timestamps(); // Crea automáticamente created_at y updated_at
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
