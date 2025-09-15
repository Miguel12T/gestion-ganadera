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
        Schema::create('failed_births', function (Blueprint $table) {
            $table->id()
                  ->comment('(PK) Unique identifier of a failed birth or stillborn calf');
            $table->unsignedBigInteger('birth_id')
                  ->comment('(FK) Associated birth identifier');
            $table->unsignedBigInteger('classification_id')
                  ->comment('(FK) Classification of the stillborn calf');
            $table->unsignedBigInteger('death_cause_id')
                  ->comment('(FK) Cause of death identifier');
            $table->decimal('estimated_weight', 5, 2)
                  ->nullable()
                  ->comment('Estimated weight of the calf at birth in kilograms');
            $table->tinyInteger('status')
                  ->default(1)
                  ->comment('Record status: (1) Active, (0) Inactive');
            $table->text('observations')
                  ->nullable()
                  ->comment('Additional observations about the failed birth');
            $table->unsignedBigInteger('created_by')
                  ->nullable()
                  ->comment('(FK) User who created the record');
            $table->unsignedBigInteger('updated_by')
                  ->nullable()
                  ->comment('(FK) User who updated the record');
            $table->foreign('birth_id', 'fk_fai_bir_birth_id')
                  ->references('id')
                  ->on('births')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('classification_id', 'fk_fai_bir_classification_id')
                  ->references('id')
                  ->on('cattle_classifications')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('death_cause_id', 'fk_fai_bir_death_cause_id')
                  ->references('id')
                  ->on('death_types')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('created_by', 'fk_fai_bir_created_by')
                  ->references('id')
                  ->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('updated_by', 'fk_fai_bir_updated_by')
                  ->references('id')
                  ->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->comment('Table that stores failed births, abortions, or stillborn calves, detailing classification and cause');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('failed_births');
    }
};
