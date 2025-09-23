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
        Schema::create('event_types', function (Blueprint $table) {
            $table->id()
                  ->comment('(PK) Unique identifier for the event type');
            $table->string('name')
                  ->unique()
                  ->comment('Name of the event type (e.g., Injury, Checkup, Dehorning, Branding, Weighing, etc.)');
            $table->text('description')
                  ->nullable()
                  ->comment('Detailed description of the event type');
            $table->tinyInteger('status')
                  ->default(1)
                  ->comment('Status of the record (1) Active, (0) Inactive');
            $table->unsignedBigInteger('created_by')
                  ->nullable()
                  ->comment('(FK) User who created this record');
            $table->unsignedBigInteger('updated_by')
                  ->nullable()
                  ->comment('(FK) User who last updated this record');
            $table->foreign('created_by', 'fk_eve_typ_created_by')
                  ->references('id')
                  ->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('updated_by', 'fk_eve_typ_updated_by')
                  ->references('id')
                  ->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->comment('Table storing catalog of event types that can be recorded for cattle');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_types');
    }
};
