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
        Schema::create('sitios_bloqueados', function (Blueprint $table) {
        $table->id();
        $table->foreignId('clase_id')->constrained('clases'); // Relación con la tabla clases
        $table->string('url');
        $table->string('razon_bloqueo');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sitios_bloqueados');
    }
};
