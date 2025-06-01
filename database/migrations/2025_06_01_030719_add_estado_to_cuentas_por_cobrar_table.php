<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    


    public function up()
    {
        Schema::table('cuentas_por_cobrar', function (Blueprint $table) {
            $table->string('estado')->default('Pendiente')->after('observaciones'); // O después del campo que prefieras
        });
    }

    public function down()
    {
        Schema::table('cuentas_por_cobrar', function (Blueprint $table) {
            $table->dropColumn('estado');
        });
    }
};
