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
        Schema::create('people', function (Blueprint $table) {
            $table->id()
                  ->comment('(PK) Unique identifier of the person');
            $table->unsignedBigInteger('document_type_id')
                  ->comment('(FK) Document type');
            $table->string('document_number')
                  ->comment('Document number');
            $table->string('name')
                  ->comment('Full name');
            $table->string('phone', 20)
                  ->nullable()
                  ->comment('Phone number');
            $table->string('email')
                  ->unique()
                  ->comment('Email address');
            $table->string('image')
                  ->nullable()
                  ->comment('Photo or avatar');
            $table->tinyInteger('status')
                  ->default(1)
                  ->comment('Record status (1) Active, (0) Inactive');
            $table->unsignedBigInteger('created_by')
                  ->nullable()
                  ->comment('(FK) User who created this record');
            $table->unsignedBigInteger('updated_by')
                  ->nullable()
                  ->comment('(FK) User who last updated this record');
            $table->timestamps();
            $table->foreign('document_type_id', 'peo_document_type_id')
                  ->references('id')
                  ->on('document_types')
                  ->onDelete('restrict');
            $table->foreign('created_by', 'peo_created_by')
                  ->references('id')
                  ->on('users')
                  ->onDelete('restrict');
            $table->foreign('updated_by', 'peo_updated_by')
                  ->references('id')
                  ->on('users')
                  ->onDelete('restrict');
            $table->unique(['document_type_id', 'document_number'], 'uk_person_document'); // Clave única compuesta para tipo + número de documento
            $table->comment('Table storing general information of people');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};
