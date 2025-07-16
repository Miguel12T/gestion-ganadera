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
            $table->id();
            $table->unsignedBigInteger('rol_id')
                  ->comment('(FK) Rol asignado al usuario');
            $table->unsignedBigInteger('vista_id')
                  ->comment('(FK) Vista asignada al usuario');
            $table->foreign('rol_id', 'rol_vis_rol_id')
                  ->references('id')
                  ->on('roles')
                  ->onDelete('cascade');
            $table->foreign('vista_id', 'rol_vis_vista_id')
                  ->references('id')
                  ->on('vistas')
                  ->onDelete('cascade');
            $table->timestamps()
                  ->comment('Fecha de cracion del registro');
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
