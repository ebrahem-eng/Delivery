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
        Schema::create('delivery_agent_locations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('longitudeStart');
            $table->double('longitudeEnd');
            $table->double('latitudeStart');
            $table->double('latitudeEnd');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_agent_locations');
    }
};
