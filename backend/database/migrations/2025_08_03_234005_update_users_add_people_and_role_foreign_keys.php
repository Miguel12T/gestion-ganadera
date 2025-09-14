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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('person_id')
                  ->nullable()
                  ->after('id')
                  ->constrained('people')
                  ->onDelete('restrict')
                  ->name('fk_use_person_id')
                  ->comment('(FK) Person assigned to user');
            $table->foreignId('role_id')
                  ->nullable()
                  ->after('person_id')
                  ->constrained('roles')
                  ->nullOnDelete()
                  ->name('fk_use_role_id')
                  ->comment('(FK) Role assigned to the user');
            $table->tinyInteger('status')
                  ->default(1)
                  ->after('role_id')
                  ->comment('User status (1) Active, (0) Inactive');
            $table->unsignedBigInteger('created_by')
                  ->nullable()
                  ->after('remember_token')
                  ->comment('(FK) User who created this record');
            $table->unsignedBigInteger('updated_by')
                  ->nullable()
                  ->after('created_by')
                  ->comment('(FK) User who last updated this record');
            $table->foreign('created_by', 'fk_use_created_by')
                  ->references('id')
                  ->on('users')
                  ->onDelete('restrict');
            $table->foreign('updated_by', 'fk_use_updated_by')
                  ->references('id')
                  ->on('users')
                  ->onDelete('restrict');
            $table->index('person_id', 'idx_use_person_id');
            $table->index('role_id', 'idx_use_role_id');
            $table->index('status', 'idx_use_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
