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
        Schema::create('rol_vista', function (Blueprint $table) {
          // Columnas
            $table->unsignedBigInteger('rol_id')
                  ->comment('(FK) Rol asignado al usuario');
            $table->unsignedBigInteger('vista_id')
                  ->comment('(FK) Vista asignada al usuario');
            $table->tinyInteger('estado')
                  ->default(1)
                  ->comment('Estado del registro (1) Activo, (0) Inactivo');
            $table->unsignedBigInteger('usuario_creacion')
                  ->comment('(FK) Usuario que creo el registro');
            $table->timestamps();
          // Clave primaria compuesta
            $table->primary(['rol_id', 'vista_id'], 'pk_rol_vista');
          // Relaciones
            $table->foreign('rol_id', 'fk_rol_vis_rol_id')
                  ->references('id')
                  ->on('roles')
                  ->onDelete('restrict');
            $table->foreign('vista_id', 'fk_rol_vis_vista_id')
                  ->references('id')
                  ->on('vistas')
                  ->onDelete('restrict');
            $table->foreign('usuario_creacion', 'fk_rol_vis_usuario_creacion')
                  ->references('id')
                  ->on('users')
                  ->onDelete('restrict');
          // Documentacion de la tabla
            $table->comment('Tabla intermedia que define qué vistas puede ver cada rol');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rol_vista');
    }
};
