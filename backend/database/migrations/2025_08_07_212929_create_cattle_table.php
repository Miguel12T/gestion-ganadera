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
        Schema::create('cattle', function (Blueprint $table) {
            $table->id()
                  ->comment('(PK) Unique identifier of the cattle');
            $table->string('code')
                  ->unique()
                  ->nullable()
                  ->comment('Unique identification code of the cattle');
            $table->string('name')
                  ->nullable()
                  ->comment('Cattle name');
            $table->date('birth_date')
                  ->nullable()
                  ->comment('Cattle birth date');
            $table->unsignedBigInteger('breed_id')
                  ->comment('(FK) Breed identifier');
            $table->unsignedBigInteger('classification_id')
                  ->comment('(FK) Classification identifier');
            $table->string('image')
                  ->nullable()
                  ->comment('URL or path of the photo of the res');
            $table->tinyInteger('status')
                  ->default(1)
                  ->comment('Status (1) Active, (0) Inactive');
            $table->unsignedBigInteger('created_by')
                  ->nullable()
                  ->comment('(FK) User who created the record');
            $table->unsignedBigInteger('updated_by')
                  ->nullable()
                  ->comment('(FK) User who updated the record');
            $table->foreign('breed_id', 'fk_cat_breed_id')
                  ->references('id')
                  ->on('breeds')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('classification_id', 'fk_cat_classification_id')
                  ->references('id')
                  ->on('cattle_classifications')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('created_by', 'fk_cat_created_by')
                  ->references('id')
                  ->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('updated_by', 'fk_cat_updated_by')
                  ->references('id')
                  ->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->comment('Table that stores information about cattle');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cattle');
    }
};
