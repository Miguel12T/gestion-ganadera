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
        Schema::create('clasificaciones_res', function (Blueprint $table) {
            $table->id()
                  ->comment('Identificador del registro');
            $table->string('nombre')
                  ->unique()
                  ->comment('Clasificacion de la res (Becerro, Novilla, Vaca, Toro)');
            $table->enum('sexo', ['macho', 'hembra'])
                  ->comment('Sexo asociado a la etapa');
            $table->text('descripcion')
                  ->nullable()
                  ->comment('Descripción de la etapa');
            $table->tinyInteger('estado')
                  ->default(1)
                  ->comment('Estado (1) Activo, (0) Inactivo');
            $table->timestamps();
            $table->comment('Tabla que clasifica las reses por etapa de crecimiento y sexo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clasificaciones_res');
    }
};
