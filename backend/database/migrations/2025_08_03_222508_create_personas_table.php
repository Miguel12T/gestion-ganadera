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
        Schema::create('people', function (Blueprint $table) {
            $table->id()
                  ->comment('(PK) Unique identifier of the person');
            $table->unsignedBigInteger('document_type_id')
                  ->comment('(FK) Document type');
            $table->string('document_number')
                  ->comment('Document number');
            $table->string('name')
                  ->comment('Full name');
            $table->string('phone', 20)
                  ->nullable()
                  ->comment('Phone number');
            $table->string('email')
                  ->unique()
                  ->comment('Email address');
            $table->string('avatar')
                  ->nullable()
                  ->comment('Photo or avatar');
            $table->tinyInteger('status')
                  ->default(1)
                  ->comment('Record status (1) Active, (0) Inactive');
            $table->unsignedBigInteger('created_by')
                  ->nullable()
                  ->comment('(FK) User who created this record');
            $table->unsignedBigInteger('updated_by')
                  ->nullable()
                  ->comment('(FK) User who last updated this record');
            $table->timestamps();
            $table->foreign('document_type_id', 'peo_document_type_id')
                  ->references('id')
                  ->on('document_types')
                  ->onDelete('restrict');
            $table->foreign('created_by')
                  ->references('id')
                  ->on('users')
                  ->onDelete('restrict');
            $table->foreign('updated_by')
                  ->references('id')
                  ->on('users')
                  ->onDelete('restrict');
            $table->unique(['document_type_id', 'document_number'], 'uk_person_document');
            $table->comment('Table storing general information of people');


            $table->id()
                  ->comment('(PK) Identificador único de la persona');
            $table->unsignedBigInteger('tipo_documento_id')
                  ->comment('(FK) Tipo de documento');
            $table->string('numero_documento')
                  ->comment('Número de documento');
            $table->string('nombre')
                  ->comment('Nombre completo de la persona');
            $table->string('telefono', 20)
                  ->nullable()
                  ->comment('Número de teléfono');
            $table->string('email')
                  ->unique()
                  ->comment('Correo electrónico del usuario');
            $table->string('imagen')
                  ->nullable()
                  ->comment('Foto o avatar de la persona');
            $table->tinyInteger('estado')
                  ->default(1)
                  ->comment('Estado del registro (1) Activo, (0) Inactivo');
            $table->unsignedBigInteger('usuario_creacion')
                  ->comment('(FK) Usuario que creo el registro');
            $table->timestamps();
            $table->foreign('tipo_documento_id', 'per_tipo_documento_id')
                  ->references('id')
                  ->on('tipos_documentos')
                  ->onDelete('restrict');
            $table->foreign('usuario_creacion', 'fk_per_usuario_creacion')
                  ->references('id')
                  ->on('users')
                  ->onDelete('restrict');
            // Clave única compuesta para tipo + número de documento
              $table->unique(['tipo_documento_id', 'numero_documento'], 'uk_persona_documento');
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
