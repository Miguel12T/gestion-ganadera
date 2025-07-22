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
                  ->nullable()
                  ->comment('Dirección física o referencia');
            $table->string('municipio')
                  ->nullable()
                  ->comment('Ubicación geográfica');
            $table->string('departamento')
                  ->nullable()
                  ->comment('Departamento o región');
            $table->decimal('hectareas', 8, 2)
                  ->nullable()
                  ->comment('Área total en hectáreas');
            $table->string('propietario')
                  ->nullable()
                  ->comment('Nombre del dueño o empresa');
            $table->text('descripcion')
                  ->nullable()
                  ->comment('Notas o características de la finca');
            $table->unsignedBigInteger('created_by')
                  ->nullable()
                  ->comment('FK Usuario que registró');
            $table->unsignedBigInteger('updated_by')
                  ->nullable()
                  ->comment('FK Último editor');
            $table->timestamps();
            $table->foreign('created_by')
                  ->references('id')
                  ->on('users')
                  ->nullOnDelete();
            $table->foreign('updated_by')
                  ->references('id')
                  ->on('users')
                  ->nullOnDelete();
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
