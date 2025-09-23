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
        Schema::create('cattle_farms', function (Blueprint $table) {
            $table->id()
                  ->comment('(PK) Unique identifier of the cattle-farm relation');
            $table->unsignedBigInteger('cattle_id')
                  ->comment('(FK) Cattle identifier');
            $table->unsignedBigInteger('farm_id')
                  ->comment('(FK) Farm identifier');
            $table->unsignedBigInteger('cattle_state_id')
                  ->comment('(FK) Current state of the cattle in the farm');
            $table->date('entry_date')
                  ->comment('Date when the cattle entered the farm');
            $table->date('exit_date')
                  ->nullable()
                  ->comment('Date when the cattle left the farm');
            $table->tinyInteger('status')
                  ->default(1)
                  ->comment('Status (1) Active, (0) Inactive');
            $table->string('exit_reason')
                  ->nullable()
                  ->comment('Reason why the cattle left the farm');
            $table->text('observations')
                  ->nullable()
                  ->comment('Additional observations about the cattle in the farm');
            $table->unsignedBigInteger('created_by')
                  ->nullable()
                  ->comment('(FK) User who created the record');
            $table->unsignedBigInteger('updated_by')
                  ->nullable()
                  ->comment('(FK) User who updated the record');
            $table->foreign('cattle_id', 'fk_cat_far_cattle_id')
                  ->references('id')
                  ->on('cattle')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('farm_id', 'fk_cat_far_farm_id')
                  ->references('id')
                  ->on('farms')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('cattle_state_id', 'fk_cat_far_state_id')
                  ->references('id')
                  ->on('cattle_statuses')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('created_by', 'fk_cat_far_created_by')
                  ->references('id')
                  ->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('updated_by', 'fk_cat_far_updated_by')
                  ->references('id')
                  ->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->comment('Table that stores the relationship of cattle with farms and their history of permanence');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cattle_farms');
    }
};
