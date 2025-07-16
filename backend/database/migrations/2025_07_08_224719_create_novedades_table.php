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
        Schema::create('novedades', function (Blueprint $table) {
            $table->id();
            $table->uuid('res_id');
            $table->date('fecha');
            $table->string('tipo');
            $table->text('descripcion');
            $table->unsignedBigInteger('usuario_id');
            $table->timestamps();
            $table->foreign('res_id', 'nov_res_id')
                  ->references('id')
                  ->on('res');
            $table->foreign('usuario_id', 'nov_usuario_id')
                  ->references('id')
                  ->on('users');
            $table->comment('Tabla que almacena las novedades de las reses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('novedades');
    }
};
