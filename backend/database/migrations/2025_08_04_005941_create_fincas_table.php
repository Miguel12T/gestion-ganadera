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
        Schema::create('fincas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')
                  ->unique()
                  ->comment('Nombre oficial o comercial de la finca');
            $table->string('codigo')
                  ->unique()
                  ->comment('Código interno de identificación');
            $table->string('direccion')
                  ->comment('Dirección física o referencia');
            $table->string('pais')
                  ->comment('Pais donde se encuentra la finca');
            $table->string('departamento')
                  ->comment('Departamento o región');
            $table->string('municipio')
                  ->comment('Ubicación geográfica');
            $table->decimal('hectareas', 8, 2)
                  ->nullable()
                  ->comment('Área total en hectáreas');
            $table->unsignedBigInteger('propietario_id')
                  ->comment('(FK) Nombre del dueño o empresa');
            $table->text('descripcion')
                  ->nullable()
                  ->comment('Notas o características de la finca');
           $table->tinyInteger('estado')
                  ->default(1)
                  ->comment('Estado de la finca (1) Activa, (0) Inactiva');
            $table->unsignedBigInteger('created_by')
                  ->nullable()
                  ->comment('FK Usuario que registró');
            $table->unsignedBigInteger('updated_by')
                  ->nullable()
                  ->comment('FK Último editor');
            $table->timestamps();
            $table->foreign('propietario_id', 'fk_fin_propietario_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('restrict');
            $table->foreign('created_by')
                  ->references('id')
                  ->on('users')
                  ->onDelete('restrict');
            $table->foreign('updated_by')
                  ->references('id')
                  ->on('users')
                  ->onDelete('restrict');
            $table->comment('Tabla que almacena información de las fincas ganaderas registradas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fincas');
    }
};
