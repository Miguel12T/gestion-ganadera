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
        Schema::create('farm_user', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('farm_id')
                ->comment('(FK) Farm linked to the user');
          $table->unsignedBigInteger('user_id')
                ->comment('(FK) Assigned user');
          $table->tinyInteger('status')
                ->default(1)
                ->comment('Status (1) Active, (0) Inactive');
          $table->unsignedBigInteger('created_by')
                ->nullable()
                ->comment('(FK) User who created the record');
          $table->unsignedBigInteger('updated_by')
                ->nullable()
                ->comment('(FK) User who updated the record');
          $table->foreign('farm_id', 'fk_farm_user_farm_id')
                ->references('id')
                ->on('farms')
                ->onUpdate('cascade')
                ->onDelete('restrict');
          $table->foreign('user_id', 'fk_farm_user_user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('restrict');
          $table->foreign('created_by', 'fk_farm_user_created_by')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('restrict');
          $table->foreign('updated_by', 'fk_farm_user_updated_by')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('restrict');
          $table->unique(['farm_id', 'user_id'], 'uk_farm_user');
          $table->comment('Table linking farms to their assigned users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farm_user');
    }
};
