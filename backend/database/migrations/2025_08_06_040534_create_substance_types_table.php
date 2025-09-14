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
        Schema::create('substance_types', function (Blueprint $table) {
            $table->id()
                  ->comment('(PK) Substance identifier');
            $table->string('name')
                  ->unique()
                  ->comment('Substance name');
            $table->text('description')
                  ->nullable()
                  ->comment('Substance description');
            $table->unsignedBigInteger('product_type_id')
                  ->comment('(FK) Product type');
            $table->unsignedBigInteger('administration_route_id')
                  ->nullable()
                  ->comment('(FK) Administration route');
            $table->tinyInteger('status')
                  ->default(1)
                  ->comment('Status (1) Active, (0) Inactive');
            $table->unsignedBigInteger('created_by')
                  ->nullable()
                  ->comment('(FK) User who created the record');
            $table->unsignedBigInteger('updated_by')
                  ->nullable()
                  ->comment('(FK) User who updated the record');
            $table->foreign('product_type_id', 'fk_sub_typ_product_type_id')
                  ->references('id')
                  ->on('product_types')
                  ->onDelete('restrict');
            $table->foreign('administration_route_id', 'fk_sub_typ_administration_route_id')
                  ->references('id')
                  ->on('administration_routes')
                  ->onDelete('restrict');
            $table->foreign('created_by', 'fk_sub_typ_created_by')
                  ->references('id')
                  ->on('users')
                  ->onDelete('restrict');
            $table->foreign('updated_by' , 'fk_sub_typ_updated_by')
                  ->references('id')
                  ->on('users')
                  ->onDelete('restrict');
            $table->comment('Table that stores the catalog of substances that can be administered to cattle');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('substance_types');
    }
};
