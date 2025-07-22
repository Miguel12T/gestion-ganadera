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
        Schema::create('finca_usuario_rol', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')
                  ->comment('(FK) Usuario asignado');
            $table->unsignedBigInteger('finca_id')
                  ->comment('(FK) Finca asociada');
            $table->unsignedBigInteger('rol_id')
                  ->comment('(FK) Rol del usuario en la finca');
            $table->boolean('is_activo')
                  ->default(true)
                  ->comment('Estado de la asignación');
            $table->timestamps();
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            $table->foreign('finca_id')
                  ->references('id')
                  ->on('fincas')
                  ->onDelete('cascade');
            $table->foreign('rol_id')
                  ->references('id')
                  ->on('roles')
                  ->onDelete('cascade');
            $table->unique(['user_id', 'finca_id'], 'usuario_finca_unico');
            $table->comment('Tabla que vincula usuarios, roles y fincas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finca_usuario_rol');
    }
};
