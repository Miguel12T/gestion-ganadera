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
        Schema::table('partos', function (Blueprint $table) {
          $table->foreignId('finca_id')
                ->after('tipo_parto_id')
                ->constrained('fincas')
                ->name('par_finca_id')
                ->comment('(FK) Finca donde ocurrio el parto');
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
