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
        Schema::create('reproduction_methods', function (Blueprint $table) {
            $table->id()
                  ->comment('(PK) Reproduction method identifier');
            $table->string('name')
                  ->unique()
                  ->comment('Method name (Natural, Artificial insemination)');
            $table->text('description')
                  ->nullable()
                  ->comment('Method description');
            $table->tinyInteger('status')
                  ->default(1)
                  ->comment('Status (1) Active, (0) Inactive');
            $table->unsignedBigInteger('created_by')
                  ->nullable()
                  ->comment('(FK) User who created the record');
            $table->unsignedBigInteger('updated_by')
                  ->nullable()
                  ->comment('(FK) User who updated the record');
            $table->foreign('created_by', 'fk_rep_met_created_by')
                  ->references('id')
                  ->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('updated_by' , 'fk_rep_met_updated_by')
                  ->references('id')
                  ->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->comment('Table that stores the different methods of animal reproduction');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reproduction_methods');
    }
};
