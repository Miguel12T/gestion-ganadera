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
        Schema::create('cattle_classifications', function (Blueprint $table) {
            $table->id()
                  ->comment('(PK) Classification identifier');
            $table->string('name')
                  ->unique()
                  ->comment('Classification (Calf, Heifer, Cow, Bull)');
            $table->enum('sex', ['male', 'female'])
                  ->comment('Associated sex');
            $table->text('description')
                  ->nullable()
                  ->comment('Stage description');
            $table->tinyInteger('status')
                  ->default(1)
                  ->comment('Status (1) Active, (0) Inactive');
           $table->unsignedBigInteger('created_by')
                  ->nullable()
                  ->comment('(FK) User who created the record');
            $table->unsignedBigInteger('updated_by')
                  ->nullable()
                  ->comment('(FK) User who updated the record');
            $table->foreign('created_by', 'fk_cat_cla_created_by')
                  ->references('id')
                  ->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('updated_by' , 'fk_cat_cla_updated_by')
                  ->references('id')
                  ->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->comment('Table classifying cattle by growth stage and sex');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cattle_classifications');
    }
};
