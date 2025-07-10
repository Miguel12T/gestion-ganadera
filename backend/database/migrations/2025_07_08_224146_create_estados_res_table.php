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
        Schema::create('estados_res', function (Blueprint $table) {
            $table->id()
                  ->comment('Identificador del registro');
            $table->string('nombre')
                  ->unique()
                  ->comment('Estado de la res');
            $table->timestamps()
                  ->comment('Fecha de cracion del registro');
            $table->comment('Guarda los estados de las reses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estados_res');
    }
};
