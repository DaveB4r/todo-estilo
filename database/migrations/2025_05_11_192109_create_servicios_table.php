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
        Schema::create('servicios', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');                                 // Campo de fecha
            $table->string('categoria');                           // Campo categoría (string)
            $table->string('metodo_pago');                         // Método de pago (string)
            $table->text('observaciones')->nullable();             // Observaciones (nullable)
            $table->decimal('porcentaje', 5, 2);                   // Porcentaje (decimal)
            $table->decimal('precio', 10, 2);                      // Precio (decimal)
            $table->foreignId('tipo_servicio_id')                 // Clave foránea a tipo_servicios.id
                  ->constrained('tipo_servicios')
                  ->onDelete('cascade');
            $table->foreignId('user_id')                          // Clave foránea a users.id
                  ->constrained('users')
                  ->onDelete('cascade');
            $table->timestamps();                                 // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicios');
    }
};
