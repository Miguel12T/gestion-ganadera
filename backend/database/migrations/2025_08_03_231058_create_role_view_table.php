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
        Schema::create('role_view', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id')
                  ->comment('(FK) Role assigned to the user');
            $table->unsignedBigInteger('view_id')
                  ->comment('(FK) View assigned to the user');
            $table->tinyInteger('status')
                  ->default(1)
                  ->comment('Status (1) Active, (0) Inactive');
            $table->unsignedBigInteger('created_by')
                  ->nullable()
                  ->comment('(FK) User who created this record');
            $table->unsignedBigInteger('updated_by')
                  ->nullable()
                  ->comment('(FK) User who last updated this record');
            $table->timestamps();
            $table->primary(['role_id', 'view_id'], 'pk_role_view');
            $table->foreign('role_id', 'fk_rol_vie_role_id')
                  ->references('id')
                  ->on('roles')
                  ->onDelete('restrict');
            $table->foreign('view_id' , 'fk_rol_vie_view_id')
                  ->references('id')
                  ->on('views')
                  ->onDelete('restrict');
            $table->foreign('created_by', 'fk_rol_vie_created_by')
                  ->references('id')
                  ->on('users')
                  ->onDelete('restrict');
            $table->foreign('updated_by', 'fk_rol_vie_updated_by')
                  ->references('id')
                  ->on('users')
                  ->onDelete('restrict');
            $table->comment('Intermediate table defining which views each role can access');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_view');
    }
};
