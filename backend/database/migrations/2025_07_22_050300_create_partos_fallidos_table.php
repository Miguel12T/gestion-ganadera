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
        Schema::create('partos_fallidos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parto_id');
            $table->char('sexo', 1);
            $table->decimal('peso_estimado', 5, 2)
                  ->nullable();
            $table->string('motivo_muerte');
            $table->text('observaciones')
                  ->nullable();
            $table->timestamps();
            $table->foreign('parto_id')
                  ->references('id')
                  ->on('partos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partos_fallidos');
    }
};
