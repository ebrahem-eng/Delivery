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
            $table->tinyInteger('store_accept_status')->default(1);
            $table->tinyInteger('delivery_accept_status')->default(1);
            $table->integer('delivered_code');
            $table->integer('receipt_code');
            $table->string('order_note');
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
