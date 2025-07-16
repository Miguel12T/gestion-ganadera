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
        Schema::create('muertes', function (Blueprint $table) {
            $table->id();
            $table->uuid('res_id');
            $table->date('fecha');
            $table->text('causa');
            $table->text('observaciones')->nullable();
            $table->timestamps();
            $table->foreign('res_id', 'mue_res_id')
                  ->references('id')
                  ->on('res');
            $table->comment('Tabla que almacena la informacion de las muertes de las reses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('muertes');
    }
};
