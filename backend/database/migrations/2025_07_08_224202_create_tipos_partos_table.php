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
        Schema::create('tipos_partos', function (Blueprint $table) {
            $table->id()
                  ->comment('Identificador del registro');
            $table->string('nombre')
                  ->unique()
                  ->comment('Tipos de partos');
            $table->timestamps()
                  ->comment('Fecha de cracion del registro');
            $table->comment('Tabla que almacena los tipos de partos de las reses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipos_partos');
    }
};
