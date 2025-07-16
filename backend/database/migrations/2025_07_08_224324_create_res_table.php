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
        Schema::create('res_parentales', function (Blueprint $table) {
            $table->uuid('id')
                  ->primary()
                  ->comment('(PK) Identificador del registro parental');
            $table->uuid('madre_id')
                  ->nullable()
                  ->comment('(FK) Identificador de la madre');
            $table->uuid('padre_id')
                  ->nullable()
                  ->comment('(FK) Identificador del padre');
            $table->string('metodo_reproduccion')
                  ->nullable()
                  ->comment('Metodo usado: natural, inseminación, etc.');
            $table->string('finca_origen')
                  ->nullable()
                  ->comment('Nombre o código de la finca donde nació');
            $table->timestamps()
                  ->comment('Fecha de cracion del registro');
            $table->foreign('madre_id', 'res_par_madre_id')
                  ->references('id')
                  ->on('res')
                  ->nullOnDelete();
            $table->foreign('padre_id', 'res_par_padre_id')
                  ->references('id')
                  ->on('res')
                  ->nullOnDelete();
            $table->comment('Tabla que almacena la informacion de los padres de las reses');
        });

        Schema::create('res', function (Blueprint $table) {
            $table->uuid('id')
                  ->primary()
                  ->comment('Identificador del registro');
            $table->string('codigo')
                  ->unique()
                  ->comment('Codigo de identificacion de la res');
            $table->string('nombre')
                  ->nullable()
                  ->comment('Nombre de la res');
            $table->char('sexo', 1)
                  ->comment('Genero de la res');
            $table->date('fecha_nacimiento')
                  ->nullable()
                  ->comment('Fecha de nacimiento de la res');
            $table->unsignedBigInteger('raza_id')
                  ->comment('(FK) Identificador de la raza que tiene res');
            $table->unsignedBigInteger('tipo_id')
                  ->comment('(FK) Identificador del tipo de res');
            $table->unsignedBigInteger('estado_id')
                  ->comment('(FK) Identificador del estado de la res');
            $table->uuid('res_parental_id')
                  ->nullable()
                  ->comment('(FK) Identificador de los padres');
            $table->string('imagen')
                  ->nullable()
                  ->comment('Identificador de la foto para la res');
            $table->unsignedBigInteger('created_by')
                  ->nullable()
                  ->comment('(FK) Identificador del usuario que creo el registro');
            $table->unsignedBigInteger('updated_by')
                  ->nullable()
                  ->comment('(FK) Identificador del usuario que actualizo el registro');
            $table->timestamps()
                  ->comment('Fecha de cracion del registro');
            $table->foreign('raza_id', 'res_raza_id')
                  ->references('id')
                  ->on('razas');
            $table->foreign('res_parental_id', 'res_res_parental_id')
                  ->references('id')
                  ->on('res_parentales');
            $table->foreign('tipo_id', 'res_tipo_id')
                  ->references('id')
                  ->on('tipos_res');
            $table->foreign('estado_id', 'res_estado_id')
                  ->references('id')
                  ->on('estados_res');
            $table->foreign('created_by', 'res_created_by')
                  ->references('id')
                  ->on('users');
            $table->foreign('updated_by', 'res_updated_by')
                  ->references('id')
                  ->on('users');
            $table->comment('Tabla que almacena la informacion de las reses');
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
