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
        Schema::create('reses_ventas', function (Blueprint $table) {
            $table->id()
                  ->comment('Identificador único de la venta');
            $table->unsignedBigInteger('res_id')
                  ->comment('(FK) Identificador de la res vendida');
            $table->unsignedBigInteger('finca_compradora_id')
                  ->nullable()
                  ->comment('(FK) Identificador de la finca que compra la res (si está registrada en el sistema)');
            $table->date('fecha_venta')
                  ->comment('Fecha en que se realizó la venta');
            $table->string('comprador_externo')
                  ->nullable()
                  ->comment('Nombre del comprador si no está registrado como finca');
            $table->decimal('precio', 12, 2)
                  ->comment('Precio de venta de la res');
            $table->tinyInteger('estado')
                  ->default(1)
                  ->comment('Estado de la venta: (1) Activa, (0) Anulada');
            $table->text('observaciones')
                  ->nullable()
                  ->comment('Observaciones adicionales de la venta');
            $table->timestamps();
            // Relaciones
            $table->foreign('res_id', 'fk_res_ven_res_id')
                  ->references('id')
                  ->on('reses')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('finca_compradora_id', 'fk_res_ven_finca_compradora_id')
                  ->references('id')
                  ->on('fincas')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->comment('Tabla que almacena las ventas de reses, incluyendo las realizadas entre fincas registradas para permitir el seguimiento histórico');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reses_ventas');
    }
};
