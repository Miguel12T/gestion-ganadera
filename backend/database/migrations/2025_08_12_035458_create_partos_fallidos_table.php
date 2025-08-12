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
        Schema::create('partos_fallidos', function (Blueprint $table) {
            $table->id()
                   ->comment('Identificador único del registro de un parto fallido o cría fallecida');
            $table->unsignedBigInteger('parto_id')
                  ->comment('(FK) Identificador del parto asociado');
            $table->unsignedBigInteger('clasificacion_id')
                  ->comment('(FK) Clasificación de la cría fallecida');
            $table->unsignedBigInteger('motivo_muerte_id')
                  ->comment('(FK) Motivo de muerte registrado');
            $table->decimal('peso_estimado', 5, 2)
                  ->nullable()
                  ->comment('Peso estimado de la cría fallecida al nacer en kilogramos');
            $table->tinyInteger('estado')
                  ->default(1)
                  ->comment('Estado del registro: (1) Activo, (0) Inactivo');
            $table->text('observaciones')
                  ->nullable()
                  ->comment('Observaciones adicionales sobre el parto fallido');
            $table->timestamps();
            $table->foreign('parto_id')
                  ->references('id')
                  ->on('partos')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('clasificacion_id', 'fk_par_fal_clasificacion_id')
                  ->references('id')
                  ->on('clasificaciones_res')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('motivo_muerte_id', 'fk_par_fal_motivo_muerte_id')
                  ->references('id')
                  ->on('tipos_muertes')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->comment('Tabla que almacena los partos fallidos, abortos o crías fallecidas, con detalle de clasificación y motivo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partos_fallidos');
    }
};
