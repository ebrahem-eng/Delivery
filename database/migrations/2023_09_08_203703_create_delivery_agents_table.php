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
        Schema::create('delivery_agents', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->tinyInteger('gender');
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('status_accept_order')->default(0);
            $table->integer('age');
            $table->string('phone');
            $table->string('img')->nullable();
            $table->foreignId('created_by')->references('id')->on('admins');
            $table->foreignId('deliveryAgentLocationID')->references('id')->on('delivery_agent_locations');
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_agents');
    }
};
