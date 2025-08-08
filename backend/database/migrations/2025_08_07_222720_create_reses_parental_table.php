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
        Schema::create('reses_parentales', function (Blueprint $table) {
            $table->id()
                  ->comment('(PK) Identificador del registro parental');
            $table->unsignedBigInteger('res_id')
                  ->comment('(FK) Identificador del hijo(a)');
            $table->unsignedBigInteger('madre_id')
                  ->nullable()
                  ->comment('(FK) Identificador de la madre');
            $table->unsignedBigInteger('padre_id')
                  ->nullable()
                  ->comment('(FK) Identificador del padre');
            $table->unsignedBigInteger('metodo_reproduccion_id')
                  ->nullable()
                  ->comment('(FK) Identificador del método de reproducción');
            $table->timestamps();
            $table->foreign('res_id', 'fk_res_parenteal_res')
                  ->references('id')
                  ->on('reses')
                  ->onDelete('restrict');
            $table->foreign('madre_id', 'fk_res_parenteal_madre')
                  ->references('id')
                  ->on('reses')
                  ->onDelete('restrict');
            $table->foreign('padre_id', 'fk_res_parenteal_padre')
                  ->references('id')
                  ->on('reses')
                  ->onDelete('restrict');
            $table->foreign('metodo_reproduccion_id', 'fk_res_parenteal_metodo')
                  ->references('id')
                  ->on('metodos_reproduccion')
                  ->onDelete('restrict');
            $table->comment('Tabla que almacena la información genealógica de las reses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reses_parental');
    }
};
