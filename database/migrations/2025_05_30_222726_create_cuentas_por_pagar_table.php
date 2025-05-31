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
            $table->id(); // Columna 'id' (BIGINT AUTO_INCREMENT PRIMARY KEY)
            $table->string('descripcion', 500); // Descripción de la cuenta, hasta 500 caracteres
            $table->decimal('valor', 10, 0); // Valor de la cuenta. 10 dígitos en total, 0 decimales (ej. 15000)
                                            // Esto coincide con 'integer' en tu controlador y modelo
            $table->date('fecha_vencimiento')->nullable(); // Fecha de vencimiento, puede ser nula
            $table->string('estado')->default('Pendiente'); // Estado de la cuenta (ej. 'Pendiente', 'Pagado', 'Vencido')

            // Si tienes relaciones con otras tablas (por ejemplo, con usuarios o proveedores),
            // descomenta y ajusta las siguientes líneas:
            // $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // $table->foreignId('proveedor_id')->nullable()->constrained()->onDelete('set null');

            $table->timestamps(); // Columnas 'created_at' y 'updated_at'
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