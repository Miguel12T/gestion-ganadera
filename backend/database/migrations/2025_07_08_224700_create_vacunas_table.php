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
        Schema::create('vacunas', function (Blueprint $table) {
            $table->id();
            $table->uuid('res_id');
            $table->unsignedInteger('tipo_vacuna_id');
            $table->date('fecha_aplicacion');
            $table->string('dosis');
            $table->string('veterinario');
            $table->timestamps();
            $table->foreign('res_id')->references('id')->on('res');
            $table->foreign('tipo_vacuna_id')->references('id')->on('tipos_vacunas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacunas');
    }
};
