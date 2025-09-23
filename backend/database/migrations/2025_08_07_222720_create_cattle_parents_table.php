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
        Schema::create('cattle_parents', function (Blueprint $table) {
            $table->id()
                  ->comment('(PK) Parental record identifier');
            $table->unsignedBigInteger('cattle_id')
                  ->comment('(FK) Calf identifier');
            $table->unsignedBigInteger('mother_id')
                  ->nullable()
                  ->comment('(FK) Mother identifier');
            $table->unsignedBigInteger('father_id')
                  ->nullable()
                  ->comment('(FK) Father identifier');
            $table->unsignedBigInteger('reproduction_method_id')
                  ->nullable()
                  ->comment('(FK) Reproduction method identifier');
            $table->tinyInteger('status')
                  ->default(1)
                  ->comment('Status (1) Active, (0) Inactive');
            $table->unsignedBigInteger('created_by')
                  ->nullable()
                  ->comment('(FK) User who created the record');
            $table->unsignedBigInteger('updated_by')
                  ->nullable()
                  ->comment('(FK) User who updated the record');
            $table->foreign('cattle_id', 'fk_cat_par_cattle')
                  ->references('id')
                  ->on('cattle')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('mother_id', 'fk_cat_par_mother')
                  ->references('id')
                  ->on('cattle')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('father_id', 'fk_cat_par_father')
                  ->references('id')
                  ->on('cattle')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('reproduction_method_id', 'fk_cat_par_method')
                  ->references('id')
                  ->on('reproduction_methods')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('created_by', 'fk_cat_par_created_by')
                  ->references('id')
                  ->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('updated_by', 'fk_cat_par_updated_by')
                  ->references('id')
                  ->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->comment('Stores genealogical information of cattle');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cattle_parents');
    }
};
