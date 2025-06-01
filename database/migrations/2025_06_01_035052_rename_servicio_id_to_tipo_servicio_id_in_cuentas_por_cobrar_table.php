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
        Schema::table('cuentas_por_cobrar', function (Blueprint $table) {
            // Renombra la columna 'servicio_id' a 'tipo_servicio_id'
            // Solo si 'servicio_id' existe (por si ya la habías renombrado antes manualmente)
            if (Schema::hasColumn('cuentas_por_cobrar', 'servicio_id')) {
                $table->renameColumn('servicio_id', 'tipo_servicio_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cuentas_por_cobrar', function (Blueprint $table) {
            // Si haces un rollback de la migración, renómbrala de nuevo a 'servicio_id'
            // Solo si 'tipo_servicio_id' existe
            if (Schema::hasColumn('cuentas_por_cobrar', 'tipo_servicio_id')) {
                $table->renameColumn('tipo_servicio_id', 'servicio_id');
            }
        });
    }
};
