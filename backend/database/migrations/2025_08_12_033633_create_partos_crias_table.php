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
        Schema::create('partos_crias', function (Blueprint $table) {
            $table->id()
                  ->comment('Identificador único del registro de cría por parto');
            $table->unsignedBigInteger('parto_id')
                  ->comment('(FK) Identificador del parto');
            $table->unsignedBigInteger('cria_id')
                  ->comment('(FK) Identificador de la cría');
            $table->decimal('peso_nacimiento', 5, 2)
                  ->nullable()
                  ->comment('Peso de la cría al nacer en kilogramos');
            $table->tinyInteger('estado')
                  ->default(1)
                  ->comment('Estado del registro: (1) Activo, (0) Inactivo');
            $table->text('observaciones')
                  ->nullable()
                  ->comment('Observaciones adicionales sobre la cría');
            $table->timestamps();
            $table->foreign('parto_id', 'par_cri_parto_id')
                  ->references('id')
                  ->on('partos')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('cria_id', 'par_cri_cria_id')
                  ->references('id')
                  ->on('reses')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->comment('Tabla que almacena la relación entre partos y crías, permitiendo manejar partos múltiples y detalles de cada cría');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partos_crias');
    }
};
