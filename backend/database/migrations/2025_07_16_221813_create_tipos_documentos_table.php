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
            $table->string('tipo_documento_id')
                  ->primary()
                  ->comment('(PK) Tipo de documento');
            $table->string('nombre_documento')
                  ->unique()
                  ->comment('Nombre del tipo de documento');
            $table->timestamps()
                  ->comment('Fecha de cracion del registro');
            $table->comment('Tabla que almacena los roles del sistema');
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
