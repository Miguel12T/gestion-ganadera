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
        Schema::create('res', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('codigo')->unique();
            $table->string('nombre')->nullable();
            $table->char('sexo', 1);
            $table->date('fecha_nacimiento')->nullable();
            $table->unsignedBigInteger('raza_id');
            $table->unsignedBigInteger('tipo_id');
            $table->unsignedBigInteger('estado_id');
            $table->uuid('madre_id')->nullable();
            $table->uuid('padre_id')->nullable();
            $table->string('imagen')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->foreign('raza_id')->references('id')->on('razas');
            $table->foreign('tipo_id')->references('id')->on('tipos_res');
            $table->foreign('estado_id')->references('id')->on('estados_res');
            $table->foreign('madre_id')->references('id')->on('res');
            $table->foreign('padre_id')->references('id')->on('res');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('res');
    }
};
