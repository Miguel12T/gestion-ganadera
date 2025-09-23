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
        Schema::create('cattle_purchases', function (Blueprint $table) {
            $table->id()
                  ->comment('(PK) Unique identifier of the purchase');
            $table->unsignedBigInteger('cattle_id')
                  ->comment('(FK) Identifier of the cattle acquired');
            $table->unsignedBigInteger('seller_farm_id')
                  ->nullable()
                  ->comment('(FK) Identifier of the farm that sells the cattle (if registered in the system)');
            $table->string('external_seller')
                  ->nullable()
                  ->comment('Name of the seller if not registered as a farm');
            $table->date('purchase_date')
                  ->comment('Date when the purchase was made');
            $table->decimal('price', 12, 2)
                  ->comment('Purchase price of the cattle');
            $table->tinyInteger('status')
                  ->default(1)
                  ->comment('Purchase status: (1) Active, (0) Cancelled');
            $table->text('observations')
                  ->nullable()
                  ->comment('Additional notes about the purchase');
            $table->unsignedBigInteger('created_by')
                  ->nullable()
                  ->comment('(FK) User who created the record');
            $table->unsignedBigInteger('updated_by')
                  ->nullable()
                  ->comment('(FK) User who updated the record');
            $table->foreign('cattle_id', 'fk_cat_pur_cattle_id')
                  ->references('id')
                  ->on('cattle')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('seller_farm_id', 'fk_cat_pur_seller_farm_id')
                  ->references('id')
                  ->on('farms')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('created_by', 'fk_cat_sal_created_by')
                  ->references('id')
                  ->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('updated_by', 'fk_cat_sal_updated_by')
                  ->references('id')
                  ->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->comment('Table that stores cattle purchases, allowing tracking between registered or external farms');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cattle_purchases');
    }
};
