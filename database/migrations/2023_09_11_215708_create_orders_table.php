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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_status');
            $table->string('reason_of_refuse')->nullable();
            $table->string('type');
            $table->tinyInteger('store_accept_status')->nullable()->default(0);
            $table->tinyInteger('delivery_accept_status')->nullable()->default(0);
            $table->integer('delivered_code')->nullable();
            $table->integer('receipt_code')->nullable();
            $table->string('order_note')->nullable();
            $table->integer('deliveryFee');
            $table->tinyInteger('typePayment');
            $table->integer('deliveryTips');
            $table->integer('voucher');
            $table->integer('tax')->nullable();
            $table->integer('totalAmmount')->nullable();
            $table->string('deliveredBy')->nullable();
            $table->string('deliveredPhone')->nullable();
            $table->foreignId('user_location_id')->references('id')->on('user_d__locations');
            $table->foreignId('store_id')->references('id')->on('stores');
            $table->foreignId('user_id')->references('id')->on('user_d_s');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
