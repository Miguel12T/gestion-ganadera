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
        Schema::create('reses_compras', function (Blueprint $table) {
            $table->id()
                  ->comment('Identificador único de la compra');
            $table->unsignedBigInteger('res_id')
                  ->comment('(FK) Identificador de la res adquirida');
            $table->unsignedBigInteger('finca_vendedora_id')
                  ->nullable()
                  ->comment('(FK) Identificador de la finca que vende la res (si está registrada en el sistema)');
            $table->string('vendedor_externo')
                  ->nullable()
                  ->comment('Nombre del vendedor si no está registrado como finca');
            $table->date('fecha_compra')
                  ->comment('Fecha en que se realizó la compra');
            $table->decimal('precio', 12, 2)
                  ->comment('Precio de compra de la res');
            $table->tinyInteger('estado')
                  ->default(1)
                  ->comment('Estado de la compra: (1) Activa, (0) Anulada');
            $table->text('observaciones')
                  ->nullable()
                  ->comment('Observaciones adicionales de la compra');
            $table->timestamps();
            // Relaciones
            $table->foreign('res_id', 'fk_com_res_id')
                  ->references('id')
                  ->on('reses')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('finca_vendedora_id', 'fk_com_finca_vendedora_id')
                  ->references('id')
                  ->on('fincas')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->comment('Tabla que almacena las compras de reses, permitiendo rastrear el historial entre fincas registradas o externas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reses_compras');
    }
};
