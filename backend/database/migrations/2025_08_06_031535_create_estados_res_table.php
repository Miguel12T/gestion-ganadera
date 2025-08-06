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
        Schema::create('estados_res', function (Blueprint $table) {
            $table->id()
                  ->comment('Identificador del registro');
            $table->string('nombre')
                  ->unique()
                  ->comment('Nombre del estado de la res (Viva, Muerta, Vendida, Robada)');
            $table->tinyInteger('estado')
                  ->default(1)
                  ->comment('Estado (1) Activo, (0) Inactivo');
            $table->timestamps();
            $table->comment('Tabla que almacena los estados de las reses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estados_res');
    }
};
