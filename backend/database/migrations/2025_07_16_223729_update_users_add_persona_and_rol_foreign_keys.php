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
        Schema::table('users', function (Blueprint $table) {
          $table->foreignId('persona_id')
                ->nullable()
                ->after('id')
                ->constrained('personas')
                ->name('use_persona_id')
                ->onDelete('cascade')
                ->comment('(FK) Persona asignada al usuario');
          $table->foreignId('rol_id')
                ->nullable()
                ->after('persona_id')
                ->constrained('roles')
                ->name('use_rol_id')
                ->nullOnDelete()
                ->comment('(FK) Rol asignado al usuario');
          $table->enum('estado', ['activo', 'inactivo', 'suspendido'])
                ->default('activo')
                ->after('rol_id')
                ->comment('Estado del usuario');
          $table->unsignedBigInteger('created_by')
                ->nullable()
                ->after('remember_token')
                ->comment('(FK) Usuario que creó este registro');
          $table->unsignedBigInteger('updated_by')
                ->nullable()
                ->comment('(FK) Usuario que actualizó este registro');
          $table->foreign('created_by')
                ->references('id')->on('users')
                ->nullOnDelete();
          $table->foreign('updated_by')
                ->references('id')->on('users')
                ->nullOnDelete();
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
