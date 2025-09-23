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
        Schema::create('births', function (Blueprint $table) {
            $table->id()
                  ->comment('(PK) Unique identifier of the birth record');
            $table->unsignedBigInteger('mother_id')
                  ->comment('(FK) Identifier of the cow responsible for the birth');
            $table->unsignedBigInteger('farm_id')
                  ->comment('(FK) Identifier of the farm where the birth occurred');
            $table->date('birth_date')
                  ->comment('Date of the birth');
            $table->time('birth_time')
                  ->nullable()
                  ->comment('Time of the birth');
            $table->tinyInteger('status')
                  ->default(1)
                  ->comment('Record status: (1) Active, (0) Inactive');
            $table->text('observations')
                  ->nullable()
                  ->comment('Additional observations about the birth');
            $table->unsignedBigInteger('created_by')
                  ->nullable()
                  ->comment('(FK) User who created the record');
            $table->unsignedBigInteger('updated_by')
                  ->nullable()
                  ->comment('(FK) User who updated the record');
            $table->foreign('mother_id', 'fk_bir_mother_id')
                  ->references('id')
                  ->on('cattle')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('farm_id', 'fk_bir_farm_id')
                  ->references('id')
                  ->on('farms')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('created_by', 'fk_bir_created_by')
                  ->references('id')
                  ->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('updated_by', 'fk_bir_updated_by')
                  ->references('id')
                  ->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->comment('Table that stores information about cattle births');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('births');
    }
};
