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
        Schema::create('vistas', function (Blueprint $table) {
            $table->id()
                  ->comment('(PK) Unique identifier of the view');
            $table->string('code', 50)
                  ->unique()
                  ->comment('Component code or name');
            $table->string('view_name')
                  ->unique()
                  ->comment('View name');
            $table->text('description')
                  ->nullable()
                  ->comment('View description');
            $table->tinyInteger('status')
                  ->default(1)
                  ->comment('Record status (1) Active, (0) Inactive');
            $table->unsignedBigInteger('created_by')
                  ->nullable()
                  ->comment('(FK) User who created this record');
            $table->unsignedBigInteger('updated_by')
                  ->nullable()
                  ->comment('(FK) User who last updated this record');
            $table->timestamps();
            $table->foreign('created_by')
                  ->references('id')
                  ->on('users')
                  ->onDelete('restrict');
            $table->foreign('updated_by')
                  ->references('id')
                  ->on('users')
                  ->onDelete('restrict');
            $table->comment('Table storing system views accessible to roles');
            
            $table->id()
                  ->comment('(PK) Identificador de la vista');
            $table->string('codigo', 50)
                  ->unique()
                  ->comment('Codigo o nombre del componente');
            $table->string('nombre_vista')
                  ->unique()
                  ->comment('Nombre de la vista');
            $table->text('descripcion')
                  ->nullable()
                  ->comment('Descripción de la vista');
            $table->tinyInteger('estado')
                  ->default(1)
                  ->comment('Estado del registro (1) Activo, (0) Inactivo');
            $table->unsignedBigInteger('usuario_creacion')
                  ->comment('(FK) Usuario que creo el registro');
            $table->timestamps();
            $table->foreign('usuario_creacion', 'fk_vis_usuario_creacion')
                  ->references('id')
                  ->on('users')
                  ->onDelete('restrict');
            $table->comment('Tabla que almacena las vistas del sistema a las que pueden acceder los roles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vistas');
    }
};
