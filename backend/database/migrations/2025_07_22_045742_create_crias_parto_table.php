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
        Schema::create('crias_parto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parto_id');
            $table->uuid('res_id');
            $table->decimal('peso_nacimiento', 5, 2)
                  ->nullable();
            $table->text('observaciones')
                  ->nullable();
            $table->timestamps();
            $table->foreign('parto_id')
                  ->references('id')
                  ->on('partos');
            $table->foreign('res_id')
                  ->references('id')
                  ->on('res');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crias_parto');
    }
};
