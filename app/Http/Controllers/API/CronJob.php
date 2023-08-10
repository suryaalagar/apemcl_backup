<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TripplanReport;
use Illuminate\Support\Facades\DB;

class CronJob extends Controller
{
    public function add_trip_plan(Request $request)
    {

        $data = $request->all();
        $vehiclename = trim($data['vehiclename']);

        $check_vehicle = $this->api_model->check_vehicle($vehiclename);
        // if (!empty($check_vehicle)) {

        //     // $status = $this->api_model->check_trip($check_vehicle->vehicleid);
        //     if ($status == 3) {
        // $start_location_id = $this->addGeofence($data['startlat'], $data['startlng']);
        // $end_location_id = $this->addGeofence($data['endlat'], $data['endlng']);
        // $route_id = $this->addRoute($data['routename'], $data['polyline']);
        $created_date = strtotime($data['beginDate']);
        $created_date = date('Y-m-d H:i:s', $created_date);
        // $data = array(

        // );
        // $this->db->insert('zigma_plantrip', $data);
        DB::table('tripplan_reports')->insert([
            'vehicleid' => 1,
            'vehicle_name' => $vehiclename,
            's_lat' => $data['startlat'],
            's_lng' => $data['startlng'],
            'e_lat' => $data['endlat'],
            'e_lng' => $data['endlng'],
            // 'start_location' => $start_location_id,
            // 'end_location' => $end_location_id,
            // 'route_namedevi' => $route_id,
            'trip_date' => $created_date,
            'poc_number' => $data['transactionid']
        ]);
        $data1['status'] = 1;
        $data1['message'] = 'Data Inserted SuccessFully';
        return $data1;
        // } else {
        //     $data1['status'] = 0;
        //     $data1['message'] = 'Previous Trip Not Completed';
        //     return $data1;
        // }
        // } else {
        //     $data1['status'] = 0;
        //     $data1['message'] = 'Vehicle Not Found..';
        //     return $data1;
        // }
    }
}
