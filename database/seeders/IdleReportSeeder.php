<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\IdleReport;
use Illuminate\Support\Str;

class IdleReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       
        // {
        //     DB::table('idle_reports')->insert([
        //         'vehicle_id'
        //         'vehiclename' => Str::random(10),
        //         'email' => Str::random(10).'@gmail.com',
        //         'password' => Hash::make('password'),
        //     ]);
        // }
        
                // DB::table('idle_reports')->truncate();
        
                IdleReport::create(['vehicle_id' => '1', 'vehiclename' => 'TN39AB4567', 'start_location' => 'Chennai', 'end_location' => 'Madurai', 'start_time' => '2023-01-01 11:54:22', 'end_time' => '2023-01-01 12:54:22', 'duration' => '01:00:00']);
                IdleReport::create(['vehicle_id' => '1', 'vehiclename' => 'TN39AB4567', 'start_location' => 'Chennai', 'end_location' => 'Madurai', 'start_time' => '2023-01-01 11:54:22', 'end_time' => '2023-01-01 12:54:22', 'duration' => '01:00:00']);
                IdleReport::create(['vehicle_id' => '1', 'vehiclename' => 'TN39AB4567', 'start_location' => 'Chennai', 'end_location' => 'Madurai', 'start_time' => '2023-01-01 11:54:22', 'end_time' => '2023-01-01 12:54:22', 'duration' => '01:00:00']);
                IdleReport::create(['vehicle_id' => '1', 'vehiclename' => 'TN39AB4567', 'start_location' => 'Chennai', 'end_location' => 'Madurai', 'start_time' => '2023-01-01 11:54:22', 'end_time' => '2023-01-01 12:54:22', 'duration' => '01:00:00']);
                IdleReport::create(['vehicle_id' => '1', 'vehiclename' => 'TN39AB4567', 'start_location' => 'Chennai', 'end_location' => 'Madurai', 'start_time' => '2023-01-01 11:54:22', 'end_time' => '2023-01-01 12:54:22', 'duration' => '01:00:00']);
                IdleReport::create(['vehicle_id' => '1', 'vehiclename' => 'TN39AB4567', 'start_location' => 'Chennai', 'end_location' => 'Madurai', 'start_time' => '2023-01-01 11:54:22', 'end_time' => '2023-01-01 12:54:22', 'duration' => '01:00:00']);
                IdleReport::create(['vehicle_id' => '1', 'vehiclename' => 'TN39AB4567', 'start_location' => 'Chennai', 'end_location' => 'Madurai', 'start_time' => '2023-01-01 11:54:22', 'end_time' => '2023-01-01 12:54:22', 'duration' => '01:00:00']);
                IdleReport::create(['vehicle_id' => '1', 'vehiclename' => 'TN39AB4567', 'start_location' => 'Chennai', 'end_location' => 'Madurai', 'start_time' => '2023-01-01 11:54:22', 'end_time' => '2023-01-01 12:54:22', 'duration' => '01:00:00']);
                IdleReport::create(['vehicle_id' => '1', 'vehiclename' => 'TN39AB4567', 'start_location' => 'Chennai', 'end_location' => 'Madurai', 'start_time' => '2023-01-01 11:54:22', 'end_time' => '2023-01-01 12:54:22', 'duration' => '01:00:00']);
                IdleReport::create(['vehicle_id' => '1', 'vehiclename' => 'TN39AB4567', 'start_location' => 'Chennai', 'end_location' => 'Madurai', 'start_time' => '2023-01-01 11:54:22', 'end_time' => '2023-01-01 12:54:22', 'duration' => '01:00:00']);
    }
}
