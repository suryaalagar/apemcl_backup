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
            $table->bigInteger('running_no')->index()->comment('Device IMEI');
            $table->dateTime('device_datetime')->comment('Device Time')->index();
            $table->string('availablity_status',6)->nullable();
            $table->double('lat_message')->comment('Latitude');
            $table->double('lon_message')->comment('Longtitude');
            $table->tinyInteger('speed')->default(0)->index(); 
            $table->string('orientation',18)->nullable();
            $table->tinyInteger('io_state')->default(0);
            $table->tinyInteger('prev_io')->default(0);
            $table->dateTime('created_date')->nullable()->comment('Created Time Device');
            $table->dateTime('modified_date')->comment('Device Time')->index();
            $table->longText('latlon_address')->nullable();  
            $table->double('distance_travelled')->default(0)->comment('Odometer without device');
            $table->enum('status',[1,0])->default(1);
            $table->string('fuel',20)->nullable();
            $table->string('fuel_consume',40)->nullable();
            $table->string('hire_status',30)->nullable();
            $table->string('keyword',15)->nullable()->comment('Type Of Device Name');
            $table->string('trackersim',15)->nullable()->comment('Type Of Device Name');
            $table->string('gpssignal',15)->nullable();
            $table->tinyInteger('gsmsignal')->default(0);
            $table->string('direction',15)->nullable();
            $table->smallInteger('altitude')->default(0);
            $table->enum('acc_status',[1,0])->default(0)->comment('Ignition Status');
            $table->enum('door_status',[1,0])->default(0)->comment('Ac Status'); 
            $table->integer('gpsv',15)->nullable();
            $table->string('temperature_sensor',50)->nullable();
            $table->string('power_tamper_status',50)->nullable();
            $table->smallInteger('angle')->default(0)->index();
            $table->double('mainpower')->default(0);
            $table->double('maininput')->default(0);
            $table->string('tamper',20)->nullable();
            $table->enum('packettype',[1,0])->default(0)->comment('Packet Status (History/Live)')->index();  
            $table->enum('packettype1',[1,0])->nullable()->comment('Secondary Packet Status (History/Live)');  
            $table->longText('zap')->nullable()->comment('Total Packet Values'); 
            $table->double('traveled_distance')->default(0)->comment('Odometer with device');
            $table->enum('vehicle_sleep',[1,0])->default(0)->comment('Vehicle Sleep Mode');
            $table->enum('digital_output',[1,0])->default(0)->comment('Relay Cut off');          
            $table->string('cell_id',40)->nullable();
            $table->timestamp('current_datetime');
            $table->enum('immob_status',[1,0])->default(0)->comment('Vehicle Cut Off');
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
