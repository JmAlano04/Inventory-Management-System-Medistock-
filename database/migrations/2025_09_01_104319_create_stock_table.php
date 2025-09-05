<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_xxxxxx_create_stock_table.php
public function up()
{
    Schema::create('stock', function (Blueprint $table) {
        $table->id();
        $table->foreignId('medicine_id')->constrained()->onDelete('cascade');
        $table->foreignId('supplier_id')->constrained()->onDelete('cascade');
        $table->string('batch_no', 50);
        $table->date('expiry_date');
        $table->integer('quantity');
        $table->decimal('purchase_price', 10, 2);
        $table->date('date_received');
        $table->timestamps();

        $table->index(['expiry_date', 'medicine_id']); // performance
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock');
    }
};
