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
        Schema::create('partos', function (Blueprint $table) {
            $table->id()
                  ->comment('Identificador único del parto');
            $table->unsignedBigInteger('madre_id')
                  ->comment('(FK) Identificador de la res responsable del parto');
            $table->unsignedBigInteger('finca_id')
                  ->comment('(FK) Identificador de la finca');
            $table->date('fecha_parto')
                  ->comment('Fecha del parto');
            $table->time('hora_parto')
                  ->nullable()
                  ->comment('Hora del parto');
            $table->tinyInteger('estado')
                  ->default(1)
                  ->comment('Estado del registro: (1) Activo, (0) Inactivo');
            $table->text('observaciones')
                  ->nullable()
                  ->comment('Observaciones adicionales sobre el parto');
            $table->timestamps();
            $table->foreign('madre_id', 'par_madre_id')
                  ->references('id')
                  ->on('reses')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('finca_id', 'fk_par_finca_id')
                  ->references('id')
                  ->on('fincas')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->comment('Tabla que almacena la informacion de los partos de las reses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partos');
    }
};
