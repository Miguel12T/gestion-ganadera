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
        Schema::create('reses_novedades', function (Blueprint $table) {
            $table->id()
                  ->comment('Identificador único de la novedad');
            $table->unsignedBigInteger('res_id')
                  ->comment('(FK) Identificador de la res asociada a la novedad');
            $table->unsignedBigInteger('tipo_novedad_id')
                  ->comment('(FK) Tipo de novedad registrada');
            $table->date('fecha')
                  ->comment('Fecha en la que se registró la novedad');
            $table->text('descripcion')
                  ->comment('Descripción detallada de la novedad');
            $table->unsignedBigInteger('usuario_id')
                  ->comment('(FK) Usuario que registró la novedad');
            $table->tinyInteger('estado')
                  ->default(1)
                  ->comment('Estado del registro: (1) Activo, (0) Inactivo');
            $table->timestamps();
            $table->foreign('res_id', 'fk_nov_res_id')
                  ->references('id')
                  ->on('reses')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('tipo_novedad_id', 'fk_nov_tipo_novedad_id')
                  ->references('id')
                  ->on('tipos_novedades')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('usuario_id', 'fk_nov_usuario_id')
                  ->references('id')
                  ->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->comment('Tabla que almacena las novedades registradas en las reses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reses_novedades');
    }
};
