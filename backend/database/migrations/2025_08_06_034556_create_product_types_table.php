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
        Schema::create('product_types', function (Blueprint $table) {
            $table->id()
                  ->comment('(PK) Product type identifier');
            $table->string('name')
                  ->unique()
                  ->comment('Name (Vaccine, Antibiotic, Vitamin, Supplement)');
            $table->tinyInteger('status')
                  ->default(1)
                  ->comment('Status (1) Active, (0) Inactive');
            $table->unsignedBigInteger('created_by')
                  ->nullable()
                  ->comment('(FK) User who created the record');
            $table->unsignedBigInteger('updated_by')
                  ->nullable()
                  ->comment('(FK) User who updated the record');
            $table->foreign('created_by', 'fk_pro_typ_created_by')
                  ->references('id')
                  ->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('updated_by' , 'fk_pro_typ_updated_by')
                  ->references('id')
                  ->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->comment('Table that stores the catalog of types of veterinary products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_types');
    }
};
