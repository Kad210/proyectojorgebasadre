<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sitios_bloqueados', function (Blueprint $table) {
            // 1. Eliminar la llave foránea antigua
            $table->dropForeign(['clase_id']);

            // 2. Volver a crear la llave foránea con borrado en cascada
            $table->foreign('clase_id')
                  ->references('id')
                  ->on('clases')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('sitios_bloqueados', function (Blueprint $table) {
            // Opcional: Código para revertir el cambio
            $table->dropForeign(['clase_id']);
            $table->foreign('clase_id')
                  ->references('id')
                  ->on('clases');
        });
    }
};
