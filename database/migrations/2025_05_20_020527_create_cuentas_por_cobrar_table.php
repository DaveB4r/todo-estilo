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
        Schema::create('cuentas_por_cobrar', function (Blueprint $table) {
            $table->id(); // Crea una columna 'id' como clave primaria autoincremental
            $table->foreignId('cliente_id')->constrained('clientes', 'identificacion')->onDelete('cascade');
            $table->foreignId('servicio_id')->constrained('tipo_servicios')->onDelete('restrict');
            $table->date('fecha');
            $table->integer('valor');
            $table->string('observaciones')->nullable();
            $table->timestamps(); // Crea las columnas 'created_at' y 'updated_at' para el seguimiento de tiempo
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuentas_por_cobrar');
    }
};