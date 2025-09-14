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
        Schema::create('farms', function (Blueprint $table) {
            $table->id()
                  ->comment('(PK) Unique identifier of the farm');
            $table->string('name')
                  ->unique()
                  ->comment('Official or commercial farm name');
            $table->string('code')
                  ->unique()
                  ->comment('Internal identification code');
            $table->string('address')
                  ->comment('Physical address or reference');
            $table->string('country')
                  ->comment('Country where the farm is located');
            $table->string('state')
                  ->comment('State or region');
            $table->string('city')
                  ->comment('Geographic location');
            $table->decimal('hectares', 8, 2)
                  ->nullable()
                  ->comment('Total area in hectares');
            $table->unsignedBigInteger('owner_id')
                  ->comment('(FK) Owner (user or company)');
            $table->text('description')
                  ->nullable()
                  ->comment('Notes or farm characteristics');
            $table->tinyInteger('status')
                  ->default(1)
                  ->comment('Farm status (1) Active, (0) Inactive');
            $table->unsignedBigInteger('created_by')
                  ->nullable()
                  ->comment('(FK) User who created the record');
            $table->unsignedBigInteger('updated_by')
                  ->nullable()
                  ->comment('(FK) User who updated the record');
            $table->foreign('owner_id', 'fk_far_owner_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('restrict');
            $table->foreign('created_by', 'fk_far_created_by')
                  ->references('id')
                  ->on('users')
                  ->onDelete('restrict');
            $table->foreign('updated_by', 'fk_far_updated_by')
                  ->references('id')
                  ->on('users')
                  ->onDelete('restrict');
            $table->comment('Table that stores information on registered livestock farms');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farms');
    }
};
