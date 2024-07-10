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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('user_id')->constrained('users', 'id')->cascadeOnDelete();
            $table->string('product_id')->constrained('products', 'id')->cascadeOnDelete();

            $table->integer('quantity');
            $table->bigInteger('total_price');
            $table->string('payment_url')->nullable();
            $table->enum('payment_method', ['ipaymu', 'midtrans', 'cash'])->default('cash');
            $table->enum('status', ['success', 'pending', 'expired'])->default('pending');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
