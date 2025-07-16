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
