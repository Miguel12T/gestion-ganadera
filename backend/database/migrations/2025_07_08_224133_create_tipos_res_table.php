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
        Schema::create('tipos_res', function (Blueprint $table) {
            $table->id()
                  ->comment('Identificador del registro');
            $table->string('nombre')
                  ->unique()
                  ->comment('Nombre del tipo de res');
            $table->timestamps()
                  ->comment('Fecha de cracion del registro');
            $table->comment('Guarda los tipos de reses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipos_res');
    }
};
