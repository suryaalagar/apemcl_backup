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
        Schema::create('play_back_history_reports', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('running_no')->nullable();
            $table->double('lat_message')->nullable();
            $table->double('lon_message')->nullable();
            $table->double('speed')->default(0);
            $table->double('angle')->default(0);
            $table->dateTime('created_date')->nullable();
            $table->dateTime('modified_date')->nullable();
            $table->smallInteger('acc_status')->default(0);
            $table->smallInteger('door_status')->default(0);
            $table->smallInteger('packettype')->default(0);
            $table->timestamp('timestamp')->nullable();
            $table->longText('zap')->nullable();  
            $table->string('packet',15)->nullable();
            $table->double('odometer')->default(0);
            $table->smallInteger('client_id')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('play_back_history_reports');
    }
};
