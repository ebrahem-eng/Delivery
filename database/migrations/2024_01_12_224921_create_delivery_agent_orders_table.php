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
        Schema::create('delivery_agent_orders', function (Blueprint $table) {
            $table->id();
            $table->string('details');
            $table->tinyInteger('status');
            $table->integer('expectedDeliveryTime');
            $table->integer('realDeliveryTime');
            $table->foreignId('orderID')->references('id')->on('orders');
            $table->foreignId('deliveryAgentID')->references('id')->on('delivery_agents');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_agent_orders');
    }
};
