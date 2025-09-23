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
      // Tabla de trabajos en cola
        Schema::create('jobs', function (Blueprint $table) {
            $table->id()
                  ->comment('(PK) Job identifier');
            $table->string('queue')
                  ->index()
                  ->comment('Job queue name');
            $table->longText('payload')
                  ->comment('Job data payload');
            $table->unsignedTinyInteger('attempts')
                  ->comment('Number of attempts made to process the job');
            $table->unsignedInteger('reserved_at')
                  ->nullable()
                  ->comment('Timestamp when the job was reserved for processing');
            $table->unsignedInteger('available_at')
                  ->comment('Timestamp when the job becomes available for processing');
            $table->unsignedInteger('created_at')
                  ->comment('Timestamp when the job was created');
            $table->comment('Table storing queued jobs');
        });
      // Tabla de lotes de trabajos
        Schema::create('job_batches', function (Blueprint $table) {
            $table->string('id')
                  ->primary()
                  ->comment('(PK) Batch identifier');
            $table->string('name')
                  ->comment('Batch name');
            $table->integer('total_jobs')
                  ->comment('Total number of jobs in the batch');
            $table->integer('pending_jobs')
                  ->comment('Number of pending jobs');
            $table->integer('failed_jobs')
                  ->comment('Number of failed jobs');
            $table->longText('failed_job_ids')
                  ->comment('IDs of failed jobs');
            $table->mediumText('options')
                  ->nullable()
                  ->comment('Batch options');
            $table->integer('cancelled_at')
                  ->nullable()
                  ->comment('Timestamp when the batch was cancelled');
            $table->integer('created_at')
                  ->comment('Timestamp when the batch was created');
            $table->integer('finished_at')
                  ->nullable()
                  ->comment('Timestamp when the batch was finished');
            $table->comment('Table storing job batches');
        });
      // Tabla de trabajos fallidos
        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id()
                  ->comment('(PK) Unique identifier for the failed job');
            $table->string('uuid')
                  ->unique()
                  ->comment('Universal unique identifier for the failed job');
            $table->text('connection')
                  ->comment('Name of the connection where the job was executed');
            $table->text('queue')
                  ->comment('Name of the queue where the job was executed');
            $table->longText('payload')
                  ->comment('Data payload of the job');
            $table->longText('exception')
                  ->comment('Exception message and stack trace');
            $table->timestamp('failed_at')
                  ->useCurrent()
                  ->comment('Timestamp when the job failed');
            $table->comment('Table storing failed jobs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('job_batches');
        Schema::dropIfExists('failed_jobs');
    }
};
