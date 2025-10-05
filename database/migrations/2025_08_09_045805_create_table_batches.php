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
        //
        // Schema::create("batches", function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('medicine_id')->constrained()->onDelete('cascade');
        //     $table->integer('batch_code');
        //     $table->integer('quantity');
        //     $table->date('expiry_date');
        //     $table->integer('unit_cost');
        //     $table->string('status'); 
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
