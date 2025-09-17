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
        Schema::create('cattle_deaths', function (Blueprint $table) {
            $table->id()
                  ->comment('(PK) Unique identifier of the death record');
            $table->unsignedBigInteger('cattle_id')
                  ->comment('(FK) Identifier of the deceased cattle');
            $table->unsignedBigInteger('death_reason_id')
                  ->comment('(FK) Identifier of the cause of death');
            $table->date('date')
                  ->comment('Date when the death occurred');
            $table->text('observations')
                  ->nullable()
                  ->comment('Additional observations about the death');
            $table->tinyInteger('status')
                  ->default(1)
                  ->comment('Record status: (1) Active, (0) Inactive');
            $table->unsignedBigInteger('created_by')
                  ->nullable()
                  ->comment('(FK) User who created the record');
            $table->unsignedBigInteger('updated_by')
                  ->nullable()
                  ->comment('(FK) User who updated the record');
            $table->foreign('cattle_id', 'fk_cat_dea_cattle_id')
                  ->references('id')
                  ->on('cattle')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('death_reason_id', 'fk_cat_dea_reason_id')
                  ->references('id')
                  ->on('death_types')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('created_by', 'fk_cat_dea_created_by')
                  ->references('id')
                  ->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('updated_by', 'fk_cat_dea_updated_by')
                  ->references('id')
                  ->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->comment('Table that stores cattle deaths with cause and date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cattle_deaths');
    }
};
