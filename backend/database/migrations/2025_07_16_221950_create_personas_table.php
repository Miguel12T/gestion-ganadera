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
        Schema::create('personas', function (Blueprint $table) {
            $table->id()
                  ->comment('(PK) Identificador único de la persona');
            $table->unsignedBigInteger('tipo_documento_id')
                  ->comment('(FK) Tipo de documento');
            $table->string('numero_documento')
                  ->unique()
                  ->comment('Número de documento');
            $table->string('nombre')
                  ->comment('Nombre completo de la persona');
            $table->string('telefono')
                  ->nullable()
                  ->comment('Número de teléfono');
            $table->string('email')
                  ->unique()
                  ->comment('Correo electrónico del usuario');
            $table->string('imagen')
                  ->nullable()
                  ->comment('Foto o avatar de la persona');
            $table->timestamps()
                  ->comment('Fecha de cracion del registro');
            $table->foreign('tipo_documento_id', 'per_tipo_documento_id')
                  ->references('id')
                  ->on('tipos_documentos');
            $table->comment('Tabla que almacena la información general de las personas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};
