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
        Schema::create('roles', function (Blueprint $table) {
            $table->id()
                  ->comment('(PK) Identificador único del rol');
            $table->string('nombre')
                  ->unique()
                  ->comment('Nombre del rol (admin, veterinario, etc.)');
            $table->text('descripcion')
                  ->nullable()
                  ->comment('Descripción del rol');
            $table->timestamps()
                  ->comment('Fecha de cracion del registro');
            $table->comment('Guarda los roles');
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id()
                  ->comment('(PK) Identificador único del usuario');
            $table->string('name')
                  ->comment('Nombre completo del usuario');
            $table->string('email')
                  ->unique()
                  ->comment('Direccion de correo electronico');
            $table->string('telefono')
                  ->comment('Numero de teléfono del usuario');
            $table->string('documento')
                  ->comment('Numero de documento de identidad');
            $table->string('documento')
                  ->comment('Numero de documento de identidad');
            $table->unsignedBigInteger('rol_id')
                  ->comment('(FK) Rol asignado al usuario');
            $table->enum('estado', ['activo', 'inactivo', 'suspendido'])
                  ->default('activo')
                  ->comment('Estado del usuario');
            $table->string('imagen')
                  ->nullable()
                  ->comment('Ruta de la imagen de perfil');
            $table->timestamp('email_verified_at')
                  ->nullable()
                  ->comment('Fecha de verificación del correo');
            $table->string('password')
                  ->comment('Contraseña del usuario');
            $table->rememberToken()
                  ->comment('Token de recordarme para sesiones');
            $table->unsignedBigInteger('created_by')
                  ->comment('(FK) Identificador del usuario que creó este registro');
            $table->unsignedBigInteger('updated_by')
                  ->comment('(FK) Identificador del usuario que actualizó este registro');
            $table->timestamps()
                  ->comment('Fecha de cracion del registro');
            $table->comment('Guarda los usuarios');
            $table->foreignId('rol_id')->constrained(
              table     : 'roles',
              indexName : 'rol_rol_id'
            )->nullOnDelete();
            $table->foreignId('created_by')->constrained(
              table     : 'users',
              indexName : 'use_created_by'
            )->nullOnDelete();
            $table->foreignId('updated_by')->constrained(
              table     : 'users',
              indexName : 'use_updated_by'
            )->nullOnDelete();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')
                  ->primary()
                  ->comment('Correo del usuario que solicita el cambio');
            $table->string('token')
                  ->comment('Token de recuperación');
            $table->timestamp('created_at')
                  ->nullable()
                  ->comment('Fecha de creación del token');
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')
                  ->primary()
                  ->comment('(PK) Identificador de la sesión');
            $table->foreignId('user_id')
                  ->nullable()
                  ->index()
                  ->comment('(PK) Identificador del usuario');
            $table->string('ip_address', 45)
                  ->nullable()
                  ->comment('Dirección IP del usuario');
            $table->text('user_agent')
                  ->nullable()
                  ->comment('Agente de usuario del navegador');
            $table->longText('payload')
                  ->comment('Datos de la sesión');
            $table->integer('last_activity')
                  ->index()
                  ->comment('Ultima actividad de la sesión');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
