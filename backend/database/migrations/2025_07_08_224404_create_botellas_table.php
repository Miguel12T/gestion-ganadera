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
        Schema::create('botellas', function (Blueprint $table) {
            $table->id();
            $table->uuid('res_id');
            $table->date('fecha');
            $table->decimal('cantidad_litros', 6, 2);
            $table->unsignedBigInteger('mayordomo_id');
            $table->timestamps();
            $table->foreign('res_id')->references('id')->on('res');
            $table->foreign('mayordomo_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('botellas');
    }
};
