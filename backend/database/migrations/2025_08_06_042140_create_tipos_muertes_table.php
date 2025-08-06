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
        Schema::create('tipos_muertes', function (Blueprint $table) {
            $table->id()
                  ->comment('Identificador del registro');
            $table->string('nombre')
                  ->unique()
                  ->comment('Nombre del tipo de muerte, (Enfermedad, Accidente, Desnutrición)');
            $table->text('descripcion')
                  ->nullable()
                  ->comment('Descripción detallada de la causa de muerte');
            $table->tinyInteger('estado')
                  ->default(1)
                  ->comment('Estado (1) Activo, (0) Inactivo');
            $table->timestamps();
            $table->comment('Tabla que almacena los distintos tipos de muerte de una res');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipos_muertes');
    }
};
