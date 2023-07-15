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
        Schema::create('tripplan_reports', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id');
            $table->integer('vehicleid');
            $table->string('vehicle_name')->nullable();
            $table->integer('start_location');
            $table->integer('end_location');
            $table->string('poc_number')->nullable();
            $table->string('route_name')->nullable();
            $table->integer('geo_status')->nullable();
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tripplan_reports');
    }
};
