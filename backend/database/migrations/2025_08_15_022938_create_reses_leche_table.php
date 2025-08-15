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
        Schema::create('reses_leche', function (Blueprint $table) {
            $table->id()
                  ->comment('Identificador único del registro de producción de leche');
            $table->unsignedBigInteger('res_id')
                  ->comment('(FK) Identificador de la res asociada a la producción de leche');
            $table->date('fecha')
                  ->comment('Fecha del registro de la producción');
            $table->decimal('cantidad_litros', 5, 2)
                  ->comment('Cantidad de leche producida en litros');
            $table->unsignedBigInteger('usuario_id')
                  ->comment('(FK) Identificador del usuario que registró la producción');
            $table->tinyInteger('estado')
                  ->default(1)
                  ->comment('Estado del registro (1) Activo, (0) Inactivo');
            $table->timestamps();
            $table->foreign('res_id', 'fk_res_lec_res_id')
                  ->references('id')
                  ->on('reses')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('usuario_id', 'fk_res_lec_usuario_id')
                  ->references('id')
                  ->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->comment('Tabla que almacena la informacion de la leche producida por las reses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reses_leche');
    }
};
