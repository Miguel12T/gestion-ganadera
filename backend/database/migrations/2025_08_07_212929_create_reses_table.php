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
        Schema::create('reses', function (Blueprint $table) {
            $table->id()
                  ->comment('Identificador único de la res');
            $table->string('codigo')
                  ->unique()
                  ->nullable()
                  ->comment('Código único de identificación de la res');
            $table->string('nombre')
                  ->nullable()
                  ->comment('Nombre de la res');
            $table->date('fecha_nacimiento')
                  ->nullable()
                  ->comment('Fecha de nacimiento de la res');
            $table->unsignedBigInteger('raza_id')
                  ->comment('(FK) Identificador de la raza');
            $table->unsignedBigInteger('clasificacion_id')
                  ->comment('(FK) Identificador de la clasificación de la res');
            $table->string('imagen')
                  ->nullable()
                  ->comment('URL o ruta de la foto de la res');
            $table->timestamps();
            $table->foreign('raza_id', 'fk_res_raza_id')
                  ->references('id')
                  ->on('razas')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('clasificacion_id', 'fk_res_clasificacion_id')
                  ->references('id')
                  ->on('clasificaciones_res')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->comment('Tabla que almacena la información de las reses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('res_parental');
    }
};
