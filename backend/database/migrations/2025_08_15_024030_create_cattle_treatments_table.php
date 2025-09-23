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
        Schema::create('cattle_treatments', function (Blueprint $table) {
            $table->id()
                  ->comment('(PK) Unique identifier of the treatment applied to the cattle');
            $table->unsignedBigInteger('cattle_id')
                  ->comment('(FK) Identifier of the cattle receiving the treatment');
            $table->unsignedBigInteger('substance_type_id')
                  ->comment('(FK) Identifier of the administered substance type');
            $table->decimal('dose', 8, 2)
                  ->comment('Amount and unit of the administered treatment');
            $table->date('application_date')
                  ->comment('Date the treatment was applied');
            $table->string('veterinarian')
                  ->nullable()
                  ->comment('Name of the veterinarian or responsible person');
            $table->text('observations')
                  ->nullable()
                  ->comment('Additional notes on the treatment');
            $table->tinyInteger('status')
                  ->default(1)
                  ->comment('Record status: (1) Active, (0) Inactive');
            $table->unsignedBigInteger('created_by')
                  ->nullable()
                  ->comment('(FK) User who created the record');
            $table->unsignedBigInteger('updated_by')
                  ->nullable()
                  ->comment('(FK) User who updated the record');
            $table->foreign('cattle_id', 'fk_cat_tre_cattle_id')
                  ->references('id')
                  ->on('cattle')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('substance_type_id', 'fk_cat_tre_substance_type_id')
                  ->references('id')
                  ->on('substance_types')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('created_by', 'fk_cat_tre_created_by')
                  ->references('id')
                  ->on('users')
                  ->onDelete('restrict');
            $table->foreign('updated_by', 'fk_cat_tre_updated_by')
                  ->references('id')
                  ->on('users')
                  ->onDelete('restrict');
            $table->comment('Table that stores treatments applied to cattle, including vaccines, medications, and supplements');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cattle_treatments');
    }
};
