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
        Schema::create('tipos_documentos', function (Blueprint $table) {
            $table->id()
                  ->comment('(PK) Identificador único del tipo de documento');
            $table->string('codigo')
                  ->unique()
                  ->comment('Código del tipo de documento (CC, TI, NIT, etc.)');
            $table->string('nombre_documento')
                  ->comment('Nombre del tipo de documento');
            $table->tinyInteger('estado')
                  ->default(1)
                  ->comment('Estado del registro (1) Activo, (0) Inactivo');
            $table->unsignedBigInteger('usuario_creacion')
                  ->comment('(FK) Usuario que creo el registro');
            $table->timestamps();
            $table->foreign('usuario_creacion', 'fk_tip_doc_usuario_creacion')
                  ->references('id')
                  ->on('users')
                  ->onDelete('restrict');
            $table->comment('Tabla que almacena los tipos de documentos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipos_documentos');
    }
};
