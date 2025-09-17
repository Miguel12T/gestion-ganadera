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
        Schema::create('cattle_events', function (Blueprint $table) {
            $table->id()
                  ->comment('(PK) Unique identifier of the event');
            $table->unsignedBigInteger('cattle_id')
                  ->comment('(FK) Identifier of the cattle associated with the event');
            $table->unsignedBigInteger('event_type_id')
                  ->comment('(FK) Identifier of the event type');
            $table->date('date')
                  ->comment('Date when the event occurred');
            $table->text('description')
                  ->comment('Detailed description of the event');
            $table->unsignedBigInteger('user_id')
                  ->comment('(FK) User who registered the event');
            $table->tinyInteger('status')
                  ->default(1)->comment('Record status: (1) Active, (0) Inactive');
            $table->unsignedBigInteger('created_by')
                  ->nullable()
                  ->comment('(FK) User who created the record');
            $table->unsignedBigInteger('updated_by')
                  ->nullable()
                  ->comment('(FK) User who updated the record');
            $table->foreign('cattle_id', 'fk_cat_eve_cattle_id')
                  ->references('id')
                  ->on('cattle')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('event_type_id', 'fk_cat_eve_event_type_id')
                  ->references('id')
                  ->on('event_types')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('user_id', 'fk_cat_eve_user_id')
                  ->references('id')
                  ->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('created_by', 'fk_cat_eve_created_by')
                  ->references('id')
                  ->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('updated_by', 'fk_cat_eve_updated_by')
                  ->references('id')
                  ->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->comment('Table that stores different events or incidents associated with cattle');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cattle_events');
    }
};
