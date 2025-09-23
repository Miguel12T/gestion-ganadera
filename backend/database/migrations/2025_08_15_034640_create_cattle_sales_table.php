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
        Schema::create('cattle_sales', function (Blueprint $table) {
            $table->id()
                  ->comment('(PK) Unique identifier of the sale');
            $table->unsignedBigInteger('cattle_id')
                  ->comment('FK: Identifier of the cattle being sold');
            $table->unsignedBigInteger('buyer_farm_id')
                  ->nullable()
                  ->comment('(FK) Identifier of the farm that buys the cattle (if registered in the system)');
            $table->date('sale_date')
                  ->comment('Date when the sale was made');
            $table->string('external_buyer')
                  ->nullable()
                  ->comment('Name of the buyer if not registered as a farm');
            $table->decimal('price', 12, 2)
                  ->comment('Sale price of the cattle');
            $table->tinyInteger('status')
                  ->default(1)
                  ->comment('Sale status: (1) Active, (0) Cancelled');
            $table->text('observations')
                  ->nullable()
                  ->comment('Additional notes about the sale');
            $table->unsignedBigInteger('created_by')
                  ->nullable()
                  ->comment('(FK) User who created the record');
            $table->unsignedBigInteger('updated_by')
                  ->nullable()
                  ->comment('(FK) User who updated the record');
            $table->foreign('cattle_id', 'fk_cat_sal_cattle_id')
                  ->references('id')
                  ->on('cattle')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('buyer_farm_id', 'fk_cat_sal_buyer_farm_id')
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
            $table->comment('Table that stores cattle sales, including those made between registered farms to allow historical tracking');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cattle_sales');
    }
};
