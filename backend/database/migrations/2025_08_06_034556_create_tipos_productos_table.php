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
        Schema::create('tipos_productos', function (Blueprint $table) {
            $table->id()
                  ->comment('Identificador del registro');
            $table->string('nombre')
                  ->unique()
                  ->comment('Nombre del producto (Vacuna, Antibiótico, Vitamina, Suplemento)');
            $table->tinyInteger('estado')
                  ->default(1)
                  ->comment('Estado (1) Activo, (0) Inactivo');
            $table->timestamps();
            $table->comment('Tabla que almacena el catálogo de tipos de productos veterinarios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipos_productos');
    }
};
