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
        Schema::create('reses_fincas', function (Blueprint $table) {
            $table->id()
                  ->comment('Identificador único de la relación res-finca');
            $table->unsignedBigInteger('res_id')
                  ->comment('(FK) Identificador de la res');
            $table->unsignedBigInteger('finca_id')
                  ->comment('(FK) Identificador de la finca');
            $table->unsignedBigInteger('estado_res_id')
                  ->comment('(FK) Estado actual de la res en la finca');
            $table->date('fecha_ingreso')
                  ->comment('Fecha en la que la res ingresó a la finca');
            $table->date('fecha_salida')
                  ->nullable()
                  ->comment('Fecha en la que la res salió de la finca');
            $table->tinyInteger('estado')
                  ->default(1)
                  ->comment('Estado del registro: (1) Activo, (0) Inactivo');
            $table->string('motivo_salida')
                  ->nullable()
                  ->comment('Motivo por el cual la res salió de la finca');
            $table->text('observaciones')
                  ->nullable()
                  ->comment('Observaciones adicionales sobre la res en la finca');
            $table->timestamps();
            $table->foreign('res_id', 'fk_res_finca_res_id')
                  ->references('id')
                  ->on('reses')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('finca_id', 'fk_res_finca_finca_id')
                  ->references('id')
                  ->on('fincas')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('estado_res_id', 'fk_res_finca_estado_res_id')
                  ->references('id')
                  ->on('estados_res')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->comment('Tabla que almacena la relación de las reses con las fincas y su historial de permanencia');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reses_fincas');
    }
};
