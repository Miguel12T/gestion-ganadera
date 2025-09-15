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
      // Tabla de cache
        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')
                  ->primary()
                  ->comment('Cache key');
            $table->mediumText('value')
                  ->comment('Cached value');
            $table->integer('expiration')
                  ->comment('Expiration time as a Unix timestamp');
            $table->comment('Cache storage');
        });
    // Tabla de locks para la cache
        Schema::create('cache_locks', function (Blueprint $table) {
            $table->string('key')
                  ->primary()
                  ->comment('Cache lock key');
            $table->string('owner')
                  ->comment('Lock owner identifier');
            $table->integer('expiration')
                  ->comment('Lock expiration time as a Unix timestamp');
            $table->comment('Cache lock management');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cache');
        Schema::dropIfExists('cache_locks');
    }
};
