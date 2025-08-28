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
                ->name('fk_use_persona_id')
                ->onDelete('restrict')
                ->comment('(FK) Persona asignada al usuario');
          $table->foreignId('rol_id')
                ->nullable()
                ->after('persona_id')
                ->constrained('roles')
                ->name('fk_use_rol_id')
                ->nullOnDelete()
                ->comment('(FK) Rol asignado al usuario');
          $table->tinyInteger('estado')
                ->default(1)
                ->after('rol_id')
                ->comment('Estado del usuario (1) Activo, (0) Inactivo');
          $table->unsignedBigInteger('created_by')
                ->nullable()
                ->after('remember_token')
                ->comment('(FK) Usuario que creó este registro');
          $table->unsignedBigInteger('updated_by')
                ->nullable()
                ->comment('(FK) Usuario que actualizó este registro');
          $table->foreign('created_by')
                ->references('id')->on('users')
                ->onDelete('restrict');
          $table->foreign('updated_by')
                ->references('id')->on('users')
                ->onDelete('restrict');
          // Índices opcionales
          $table->index('created_by');
          $table->index('updated_by');
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
