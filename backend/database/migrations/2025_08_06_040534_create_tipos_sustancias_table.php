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
        Schema::create('tipos_sustancias', function (Blueprint $table) {
            $table->id()
                  ->comment('Identificador del registro');
            $table->string('nombre')
                  ->unique()
                  ->comment('Nombre de la sustancia');
            $table->text('descripcion')
                  ->nullable()
                  ->comment('Descripción de la sustancia');
            $table->unsignedBigInteger('tipo_id')
                  ->comment('(FK) tipo de sustancia');
            $table->unsignedBigInteger('via_administracion_id')
                  ->nullable()
                  ->comment('(FK) vía de administración');
            $table->tinyInteger('estado')
                  ->default(1)
                  ->comment('Estado (1) Activo, (0) Inactivo');
            $table->timestamps();
            $table->foreign('tipo_id', 'fk_tip_sus_tipo_id')
                  ->references('id')
                  ->on('tipos_productos')
                  ->onDelete('restrict');
            $table->foreign('via_administracion_id', 'fk_tip_sus_via_administracion_id')
                  ->references('id')
                  ->on('vias_administracion')
                  ->onDelete('restrict');
            $table->comment('Tabla que almacena el catálogo de sustancias administradas a las reses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipos_sustancias');
    }
};
