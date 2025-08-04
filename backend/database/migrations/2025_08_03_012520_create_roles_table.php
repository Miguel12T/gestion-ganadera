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
            $table->tinyInteger('estado')
                  ->default(1)
                  ->comment('Estado del registro (1) Activo (0) Inactivo');
            $table->unsignedBigInteger('usuario_creacion')
                  ->comment('(FK) Usuario que creo el registro');
            $table->timestamps();
            $table->foreign('usuario_creacion', 'fk_rol_usuario_creacion')
                  ->references('id')
                  ->on('users')
                  ->onDelete('restrict');
            $table->comment('Tabla que almacena los roles del sistema');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
