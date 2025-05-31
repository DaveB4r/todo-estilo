<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Crea la tabla 'cuentas_por_pagar'.
     */
    public function up(): void
    {
        Schema::create('cuentas_por_pagar', function (Blueprint $table) {
            $table->id(); // Columna 'id'
            $table->string('descripcion', 500); // Descripción de la cuenta
            $table->decimal('valor', 10, 0); // Valor de la cuenta (10 dígitos, 0 decimales)
            $table->date('fecha_vencimiento')->nullable(); // Fecha de vencimiento
            $table->string('estado')->default('Pendiente'); // Estado de la cuenta

            // Puedes añadir aquí otras columnas si las necesitas (ej. foreign keys)
            // $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->timestamps(); // 'created_at' y 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     * Elimina la tabla 'cuentas_por_pagar' si se hace un rollback.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuentas_por_pagar');
    }
};