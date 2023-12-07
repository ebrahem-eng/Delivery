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
        Schema::create('order__details', function (Blueprint $table) {
            $table->id();
            $table->double('product_price');
            $table->string('product_note')->nullable();
            $table->integer('quantity');
            $table->double('productTotalAmount');
            // $table->double('delivery_amount');
            // $table->double('discount_amount');
            // $table->foreignId('delivered_by')->references('id')->on('delivery_agents');
            $table->foreignId('product_id')->references('id')->on('products');
            // $table->foreignId('discount_code_id')->references('id')->on('discount_codes');
            $table->foreignId('order_id')->references('id')->on('orders');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order__details');
    }
};
