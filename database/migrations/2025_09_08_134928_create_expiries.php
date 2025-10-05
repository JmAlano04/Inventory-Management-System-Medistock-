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
        // Schema::create('expiries', function (Blueprint $table) {
        //     $table->id();
        //     $table->unsignedBigInteger('medicines_id');
        //     $table->unsignedBigInteger('batches_id');
        //     $table->unsignedBigInteger('supplier_id');
        //     $table->integer('days_reamaining');
        //     $table->timestamps();

        //     $table->foreign('medicines_id')->references('id')->on('batches')->cascadeOnDelete();
        //     $table->foreign('batches_id')->references('id')->on('batches')->cascadeOnDelete();
        //     $table->foreign('supplier_id')->references('id')->on('batches')->cascadeOnDelete();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('expiries');
    }
};
