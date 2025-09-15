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
        Schema::create('birth_calves', function (Blueprint $table) {
            $table->id()
                  ->comment('(PK) Unique identifier of the calf record by birth');
            $table->unsignedBigInteger('birth_id')
                  ->comment('(FK) Birth identifier');
            $table->unsignedBigInteger('calf_id')
                  ->comment('(FK) Calf identifier');
            $table->decimal('birth_weight', 5, 2)
                  ->nullable()
                  ->comment('Calf weight at birth in kilograms');
            $table->tinyInteger('status')
                  ->default(1)
                  ->comment('Record status: (1) Active, (0) Inactive');
            $table->text('observations')
                  ->nullable()
                  ->comment('Additional observations about the calf');
            $table->unsignedBigInteger('created_by')
                  ->nullable()
                  ->comment('(FK) User who created the record');
            $table->unsignedBigInteger('updated_by')
                  ->nullable()
                  ->comment('(FK) User who updated the record');
            $table->foreign('birth_id', 'fk_bir_cal_birth_id')
                  ->references('id')
                  ->on('births')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('calf_id', 'fk_bir_cal_calf_id')
                  ->references('id')
                  ->on('cattle')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('created_by', 'fk_bir_cal_created_by')
                  ->references('id')
                  ->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('updated_by', 'fk_bir_cal_updated_by')
                  ->references('id')
                  ->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->comment('Table that stores the relationship between births and calves, allowing to manage multiple births and details of each calf');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('birth_calves');
    }
};
