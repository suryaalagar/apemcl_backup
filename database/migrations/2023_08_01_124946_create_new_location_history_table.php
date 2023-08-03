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
        Schema::create('new_location_history', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('running_no')->index()->comment('Device IMEI');
            $table->double('lat_message')->comment('Latitude');
            $table->double('lon_message')->comment('Longtitude');
            $table->enum('acc_status',[1,0])->default(0)->comment('Ignition Status');
            $table->tinyInteger('speed')->default(0)->index();
            $table->smallInteger('angle')->default(0)->index();
            $table->dateTime('modified_date')->comment('Device Time')->index();
            $table->dateTime('created_date')->nullable()->comment('Created Time Device');
            $table->double('traveled_distance')->default(0)->comment('Odometer with device');
            $table->double('distance_travelled')->default(0)->comment('Odometer without device');
            $table->string('keyword',15)->nullable()->comment('Type Of Device Name');
            $table->string('gpssignal',15)->nullable();
            $table->tinyInteger('gsmsignal')->default(0);
            $table->smallInteger('altitude')->default(0);
            $table->enum('door_status',[1,0])->default(0)->comment('Ac Status'); 
            $table->enum('packettype',[1,0])->default(0)->comment('Packet Status (History/Live)')->index();  
            $table->enum('packettype1',[1,0])->nullable()->comment('Secondary Packet Status (History/Live)');  
            $table->longText('zap')->nullable()->comment('Total Packet Values');  
            $table->enum('vehicle_sleep',[1,0])->default(0)->comment('Vehicle Sleep Mode');
            $table->enum('digital_output',[1,0])->default(0)->comment('Relay Cut off'); 
            $table->enum('immob_status',[1,0])->default(0)->comment('Vehicle Cut Off');
            $table->enum('status',[1,0])->default(1);
            $table->tinyInteger('io_state')->default(0);
            $table->float('mainpower')->nullable();
            $table->float('maininput')->nullable();
            $table->string('tamper',20)->nullable();
            $table->string('fuel_consume',40)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('new_location_history');
    }
};
