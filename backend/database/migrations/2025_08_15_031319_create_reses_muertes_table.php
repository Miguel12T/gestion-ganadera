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
        Schema::create('reses_muertes', function (Blueprint $table) {
            $table->id()
                  ->comment('Identificador único del registro de muerte');
            $table->unsignedBigInteger('res_id')
                  ->comment('(FK) Identificador de la res fallecida');
            $table->unsignedBigInteger('motivo_muerte_id')
                  ->comment('(FK) Identificador del motivo de muerte');
            $table->date('fecha')
                  ->comment('Fecha en que ocurrió la muerte');
            $table->text('observaciones')
                  ->nullable()
                  ->comment('Observaciones adicionales sobre la muerte');
            $table->tinyInteger('estado')
                  ->default(1)
                  ->comment('Estado del registro: (1) Activo, (0) Inactivo');
            $table->timestamps();
            $table->foreign('res_id', 'fk_res_mue_res_id')
                  ->references('id')
                  ->on('reses')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('motivo_muerte_id', 'fk_res_mue_motivo_muerte_id')
                  ->references('id')
                  ->on('tipos_muertes')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->comment('Tabla que almacena la información de las muertes de las reses con su motivo y fecha');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reses_muertes');
    }
};
