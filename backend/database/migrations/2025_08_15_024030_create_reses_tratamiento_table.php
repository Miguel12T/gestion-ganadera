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
        Schema::create('reses_tratamiento', function (Blueprint $table) {
            $table->id()
                  ->comment('Identificador único del tratamiento aplicado a la res');
            $table->unsignedInteger('res_id')
                  ->comment('(FK) Identificador de la res que recibe el tratamiento');
            $table->unsignedInteger('tipo_sustancia_id')
                  ->comment('(FK) Identificador del tipo de sustancia administrada');
            $table->decimal('dosis', 8, 2)
                  ->comment('Cantidad y unidad administrada del tratamiento');
            $table->date('fecha_aplicacion')
                  ->comment('Fecha en que se aplicó el tratamiento');
            $table->string('veterinario')
                  ->nullable()
                  ->comment('Nombre del veterinario o persona responsable de la aplicación');
            $table->text('observaciones')
                  ->nullable()
                  ->comment('Observaciones adicionales del tratamiento');
            $table->tinyInteger('estado')
                  ->default(1)
                  ->comment('Estado del registro: (1) Activo, (0) Inactivo');
            $table->timestamps();
            $table->foreign('res_id', 'fk_res_tra_res_id')
                  ->references('id')
                  ->on('reses')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('tipo_sustancia_id', 'fk_res_tra_tipo_sustancia_id')
                  ->references('id')
                  ->on('tipos_sustancias')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->comment('Tabla que almacena los tratamientos aplicados a cada res, incluyendo vacunas, medicamentos y suplementos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reses_tratamiento');
    }
};
