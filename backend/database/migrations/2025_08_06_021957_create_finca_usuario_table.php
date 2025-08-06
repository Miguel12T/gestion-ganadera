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
        Schema::create('finca_usuario', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('finca_id')
                  ->comment('(FK) Finca asociada');
            $table->unsignedBigInteger('user_id')
                  ->comment('(FK) Usuario asignado');
            $table->tinyInteger('estado')
                  ->default(1)
                  ->comment('Estado (1) Activo, (0) Inactivo');
            $table->timestamps();
            $table->foreign('finca_id')
                  ->references('id')
                  ->on('fincas')
                  ->onDelete('restrict');
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('restrict');
            $table->unique(['finca_id', 'user_id'], 'uk_usuario_finca');
            $table->comment('Tabla que vincula las fincas con los usuarios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finca_usuario');
    }
};
