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
        Schema::create('partos', function (Blueprint $table) {
            $table->id();
            $table->uuid('res_id');
            $table->date('fecha_parto');
            $table->time('hora_parto')
                  ->nullable();
            $table->unsignedBigInteger('tipo_parto_id');
            $table->text('observaciones')
                  ->nullable();
            $table->unsignedBigInteger('created_by')
                  ->nullable();
            $table->unsignedBigInteger('updated_by')
                  ->nullable();
            $table->timestamps();
            $table->foreign('res_id', 'par_res_id')
                  ->references('id')
                  ->on('res');
            $table->foreign('tipo_parto_id', 'par_tipo_parto_id')
                  ->references('id')
                  ->on('tipos_partos');
            $table->foreign('created_by', 'par_created_by')
                  ->references('id')
                  ->on('users');
            $table->foreign('updated_by', 'par_updated_by')
                  ->references('id')
                  ->on('users');
            $table->comment('Tabla que almacena la informacion de los partos de las reses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partos');
    }
};
