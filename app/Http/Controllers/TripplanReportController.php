<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TripplanReport;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TripplanReportController extends Controller
{

    public function index(Request $request)
    {
        $trip_plans = TripplanReport::get();
        $from_date = date('Y-m-d H:i:s', strtotime('00:00:00'));
        $to_date = date('Y-m-d H:i:s', strtotime('23:59:59'));
        return view('trip_plan.trip_plan', compact('trip_plans', 'from_date', 'to_date'));
    }

    public function tripplan_complete_report()
    {
        $from_date = date('Y-m-d H:i:s', strtotime('00:00:00'));
        $to_date = date('Y-m-d H:i:s', strtotime('23:59:59'));
        return view('report.trip_plan', compact('from_date', 'to_date'));
    }

    public function getData(Request $request)
    {
        $data = ($request->all());
        $fromdate = date('Y-m-d H:i:s', strtotime($request->input('fromdate')));
        $todate = date('Y-m-d H:i:s', strtotime($request->input('todate')));

        $trip_status = $request->input('trip_status');
        if ($trip_status == '') {
            $trip_status = 0;
        }

        $totalFilteredRecord = $totalDataRecord = $draw_val = "";
        $columns_list = array(
            0 => 'trip_id'
        );

        $totalDataRecord = TripplanReport::count();
        if ($trip_status == 0) {
            $totalFilteredRecord = TripplanReport::whereBetween('trip_date', [$fromdate, $todate])
                ->select(
                    'trip_id',
                    'poc_number',
                    'device_imei',
                    'trip_date',
                    'vehicle_name',
                    'route_name',
                    'start_odometer',
                    'end_odometer',
                    'created_at',
                    'updated_at',
                    DB::raw('end_odometer - start_odometer as total_km'),
                    DB::raw('TIMEDIFF(updated_at, created_at) AS time_difference')
                )
                ->count();
        } else {
            $totalFilteredRecord = TripplanReport::whereBetween('trip_date', [$fromdate, $todate])
                ->where('status', '=', "$trip_status")
                ->select(
                    'trip_id',
                    'poc_number',
                    'device_imei',
                    'trip_date',
                    'vehicle_name',
                    'route_name',
                    'start_odometer',
                    'end_odometer',
                    'created_at',
                    'updated_at',
                    DB::raw('end_odometer - start_odometer as total_km'),
                    DB::raw('TIMEDIFF(updated_at, created_at) AS time_difference')
                )
                ->count();
        }
        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        $order_val = $columns_list[$request->input('order.0.column')];
        $dir_val = $request->input('order.0.dir');

        $start = $request->input('start') + 1;

        if (empty($request->input('search.value'))) {
            if ($trip_status == 0) {

                $post_data = TripplanReport::whereBetween('trip_date', [$fromdate, $todate])
                    ->offset($start_val)
                    ->limit($limit_val)
                    ->select(
                        'trip_id',
                        'poc_number',
                        'device_imei',
                        'trip_date',
                        'vehicle_name',
                        'route_name',
                        'start_odometer',
                        'end_odometer',
                        'created_at',
                        'updated_at',
                        DB::raw('end_odometer - start_odometer as total_km'),
                        DB::raw('TIMEDIFF(updated_at, created_at) AS time_difference')
                    )
                    ->orderBy($order_val, $dir_val)
                    ->get();
            } else {
                $post_data = TripplanReport::whereBetween('trip_date', [$fromdate, $todate])
                    ->where('status', '=', "$trip_status")
                    ->select(
                        'trip_id',
                        'poc_number',
                        'device_imei',
                        'trip_date',
                        'vehicle_name',
                        'route_name',
                        'start_odometer',
                        'end_odometer',
                        'created_at',
                        'updated_at',
                        DB::raw('end_odometer - start_odometer as total_km'),
                        DB::raw('TIMEDIFF(updated_at, created_at) AS time_difference')
                    )
                    ->offset($start_val)
                    ->limit($limit_val)
                    ->orderBy($order_val, $dir_val)
                    ->get();
            }
        } else {
            $search_text = $request->input('search.value');

            $post_data =  TripplanReport::whereBetween('trip_date', [$fromdate, $todate])
                ->where('vehicle_name', 'LIKE', "%{$search_text}%")
                ->orWhere('route_name', 'LIKE', "%{$search_text}%")
                ->orWhere('trip_id', 'LIKE', "%{$search_text}%")
                ->orWhere('trip_date', 'LIKE', "%{$search_text}%")
                ->orWhere('device_imei', 'LIKE', "%{$search_text}%")
                ->offset($start_val)
                ->limit($limit_val)
                ->orderBy($order_val, $dir_val)
                ->get();

            $totalFilteredRecord = TripplanReport::whereBetween('trip_date', [$fromdate, $todate])
                ->where('vehicle_name', 'LIKE', "%{$search_text}%")
                ->orWhere('route_name', 'LIKE', "%{$search_text}%")
                ->orWhere('trip_id', 'LIKE', "%{$search_text}%")
                ->orWhere('trip_date', 'LIKE', "%{$search_text}%")
                ->orWhere('device_imei', 'LIKE', "%{$search_text}%")
                ->offset($start_val)
                ->limit($limit_val)
                ->orderBy($order_val, $dir_val)
                ->count();
        }

        // $serialNumbers = 1;
        foreach ($post_data  as $index =>  $data) {
            // $edit = '<a href="' . route('vehicle.edit', ['id' => $data->id]) . '"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
            // $delete = '<a><i class="fa fa-trash " aria-hidden="true"></i></a>';
            // $edit = '<button type="button" class="btn btn-success map_view" onclick="get_mapview_data('."{$data->trip_id}".')">Map View</button>';
            $serialNumber = $start + $index;
            $tripId = $data->trip_id;
            $device_imei = $data->device_imei;
            $start_time = Carbon::parse($data->created_at)->timestamp;
            $end_time = Carbon::parse($data->updated_at)->timestamp;

            $dateTime = Carbon::createFromTimestamp($start_time);
            $dateTime1 = Carbon::createFromTimestamp($end_time);
            $data_start_time = $dateTime->format('Y-m-d H:i:s');
            $data_end_time = $dateTime1->format('Y-m-d H:i:s');

            $edit = '<button type="button" class="btn btn-success showModal"  onclick="test_function(' . "$tripId" . "," . "$start_time" . "," . "$end_time" . ');"  data-trip_id="' . $tripId . '">Map View</button>';
            // $edit = '<button type="button" class="btn btn-success showModal"  onclick="test_function(' . "$tripId" . "," . "$start_time" . "," . "$end_time" . "," . "'$device_imei'" . ');"  data-trip_id="' . $tripId . '">Map View</button>';

            $array_data[] = array(
                'S No' => $serialNumber,
                'trip_id' => $data->trip_id,
                'poc_number' => $data->poc_number,
                'device_no' => $data->device_imei,
                'trip_date' => $data->trip_date,
                'vehicle_name' => $data->vehicle_name,
                'route_name' => $data->route_name,
                'start_odometer' => $data->start_odometer,
                'end_odometer' => $data->end_odometer,
                'total_km' => round($data->total_km, 3),
                'created_at' => $data_start_time,
                'updated_at' => $data_end_time,
                'time_difference' => $data->time_difference,
                'Action' => $edit
            );
        }
        if (!empty($array_data)) {
            $draw_val = $request->input('draw');
            $get_json_data = array(
                "draw"            => intval($draw_val),
                "recordsTotal"    => intval($totalDataRecord),
                "recordsFiltered" => intval($totalFilteredRecord),
                "data"            => $array_data
            );

            echo json_encode($get_json_data);
        }
    }

    public function complete_report_getData(Request $request)
    {
        $data = ($request->all());
        $fromdate = date('Y-m-d H:i:s', strtotime($request->input('fromdate')));
        $todate = date('Y-m-d H:i:s', strtotime($request->input('todate')));
        // dd($todate);
        // $trip_status = $request->input('trip_status');

        $totalFilteredRecord = $totalDataRecord = $draw_val = "";
        $columns_list = array(
            0 => 'trip_id'
        );

        $totalDataRecord = TripplanReport::count();
        $totalFilteredRecord = TripplanReport::whereBetween('trip_date', [$fromdate, $todate])
            ->where('status', 3)
            ->select(
                'trip_id',
                'poc_number',
                'device_imei',
                'trip_date',
                'vehicle_name',
                'route_name',
                'start_odometer',
                'end_odometer',
                'created_at',
                'updated_at',
                DB::raw('end_odometer - start_odometer as total_km'),
                DB::raw('TIMEDIFF(updated_at, created_at) AS time_difference')
            )
            ->count();

        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        $order_val = $columns_list[$request->input('order.0.column')];
        $dir_val = $request->input('order.0.dir');
        $start = $request->input('start') + 1;

        if (empty($request->input('search.value'))) {

            $post_data = TripplanReport::whereBetween('trip_date', [$fromdate, $todate])
                ->where('status', 3)
                ->offset($start_val)
                ->limit($limit_val)
                ->select(
                    'trip_id',
                    'poc_number',
                    'device_imei',
                    'trip_date',
                    'vehicle_name',
                    'route_name',
                    'start_odometer',
                    'end_odometer',
                    'created_at',
                    'updated_at',
                    DB::raw('end_odometer - start_odometer as total_km'),
                    DB::raw('TIMEDIFF(updated_at, created_at) AS time_difference')
                )
                ->orderBy($order_val, $dir_val)
                ->get();
        } else {
            $search_text = $request->input('search.value');

            $post_data =  TripplanReport::where('trip_id', 'LIKE', "%{$search_text}%")
                ->orWhere('device_imei', 'LIKE', "%{$search_text}%")
                ->orWhere('vehicle_name', 'LIKE', "%{$search_text}%")
                ->orWhere('poc_number', 'LIKE', "%{$search_text}%")
                ->orWhere('route_name', 'LIKE', "%{$search_text}%")
                ->orWhere('status', 3)
                ->whereBetween('trip_date', [$fromdate, $todate])
                ->offset($start_val)
                ->limit($limit_val)
                ->orderBy($order_val, $dir_val)
                ->get();

            $totalFilteredRecord = TripplanReport::where('trip_id', 'LIKE', "%{$search_text}%")
                ->orWhere('device_imei', 'LIKE', "%{$search_text}%")
                ->orWhere('vehicle_name', 'LIKE', "%{$search_text}%")
                ->orWhere('poc_number', 'LIKE', "%{$search_text}%")
                ->orWhere('route_name', 'LIKE', "%{$search_text}%")
                ->orWhere('status', 3)
                ->whereBetween('trip_date', [$fromdate, $todate])
                ->count();
        }
        foreach ($post_data  as $index =>  $data) {

            $serialNumber = $start + $index;
            $tripId = $data->trip_id;
            $device_imei = $data->device_imei;
            $start_time = Carbon::parse($data->created_at)->timestamp;
            $end_time = Carbon::parse($data->updated_at)->timestamp;

            $dateTime = Carbon::createFromTimestamp($start_time);
            $dateTime1 = Carbon::createFromTimestamp($end_time);
            $data_start_time = $dateTime->format('Y-m-d H:i:s');
            $data_end_time = $dateTime1->format('Y-m-d H:i:s');

            $edit = '<button type="button" class="btn btn-success showModal"  onclick="test_function(' . "$tripId" . "," . "$start_time" . "," . "$end_time" . "," . "'$device_imei'" . ');"  data-trip_id="' . $tripId . '">Map View</button>';

            // $edit = '<button type="button" class="btn btn-success showModal"  onclick="test_function(' . "$tripId" . "," . "$start_time" . "," . "$end_time" . ');"  data-trip_id="' . $tripId . '">Map View</button>';

            $array_data[] = array(
                'S No' => $serialNumber,
                'trip_id' => $data->trip_id,
                'poc_number' => $data->poc_number,
                'device_no' => $data->device_imei,
                'trip_date' => $data->trip_date,
                'vehicle_name' => $data->vehicle_name,
                'route_name' => $data->route_name,
                'start_odometer' => $data->start_odometer,
                'end_odometer' => $data->end_odometer,
                'total_km' => round($data->total_km, 3),
                'created_at' => $data_start_time,
                'updated_at' => $data_end_time,
                'time_difference' => $data->time_difference,
                'Action' => $edit
            );
        }
        if (!empty($array_data)) {
            $draw_val = $request->input('draw');
            $get_json_data = array(
                "draw"            => intval($draw_val),
                "recordsTotal"    => intval($totalDataRecord),
                "recordsFiltered" => intval($totalFilteredRecord),
                "data"            => $array_data
            );

            echo json_encode($get_json_data);
        }
    }

    public function zigma_trip_plan()
    {

        $this->db->select('z.*,v.vehiclename,v.lat,v.lng,v.odometer,v.client_id,v.latlon_address,v.deviceimei,v.vehicleid');
        $this->db->from('zigma_plantrip as z');
        $this->db->join('vehicletbl as v', 'z.vehicleid = v.vehicleid', 'inner join');
        $where = '(z.status=1 OR z.status=2)';
        $this->db->where($where);
        $query = $this->db->get();
        $vehicle =  $query->result();
        foreach ($vehicle as $v_list) {
            if ($v_list->status == 1) {
                $start_geoid = $v_list->start_location;
                $get_geodata =  $this->cron_test_model->get_geodata($start_geoid);

                $latitude1 = $get_geodata->g_lat;
                $longitude1 = $get_geodata->g_lng;
                $latitude2 = $v_list->lat;
                $longitude2 = $v_list->lng;
                $radius = $get_geodata->radius;
                $distance = $this->geo_distance($latitude1, $longitude1, $latitude2, $longitude2);

                if ($distance < $radius) {

                    $data1 = array('geo_status' => 1);
                    $this->db->where('trip_id', $v_list->trip_id);
                    $this->db->where('client_id', $v_list->client_id);
                    $this->db->where('vehicleid', $v_list->vehicleid);
                    // $this->db->where('poc_number',$v_list->poc_number);
                    $this->db->update('zigma_plantrip', $data1);
                } elseif (($distance > $radius) && ($v_list->geo_status == 1)) {

                    $data = array(
                        'trip_id' => $v_list->trip_id,
                        'trip_date' => $v_list->created_date,
                        'client_id' => $v_list->client_id,
                        'vehicle_id' => $v_list->vehicleid,
                        'poc_number' => $v_list->poc_number,
                        'deviceimei' => $v_list->deviceimei,
                        'vehicle_name' => $v_list->vehiclename,
                        'start_geo_id' => $v_list->start_location,
                        'start_location' => $v_list->latlon_address,
                        'end_geo_id' => $v_list->end_location,
                        'start_odometer' => $v_list->odometer,
                        's_lat' => $v_list->lat,
                        's_lng' => $v_list->lng,
                        'flag' => 2,
                        'create_datetime' => date('Y-m-d H:i:s'),
                        'plam_duration' => $v_list->pl_duration,
                        'plan_km' => $v_list->pl_km,
                    );


                    $this->db->insert('zigma_plantrip_report1', $data);

                    $data1 = array('status' => 2, 'geo_status' => 0,);
                    $this->db->where('trip_id', $v_list->trip_id);
                    $this->db->where('vehicleid', $v_list->vehicleid);
                    $this->db->where('client_id', $v_list->client_id);
                    $this->db->update('zigma_plantrip', $data1);
                }
            } else {
                $start_geoid = $v_list->start_location;
                $end_geoid = $v_list->end_location;
                $get_geodata =  $this->cron_test_model->get_geodata($end_geoid);
                $latitude1 = $get_geodata->g_lat;
                $longitude1 = $get_geodata->g_lng;
                $latitude2 = $v_list->lat;
                $longitude2 = $v_list->lng;
                $radius = $get_geodata->radius;
                $distance = $this->geo_distance($latitude1, $longitude1, $latitude2, $longitude2);
                echo '<br>' . $distance . '<br>';
                $delay_status = $v_list->delay_status;
                $pl_duration = $v_list->pl_duration;
                $pl_duration = str_replace(':', '.', $pl_duration);
                $pl_duration  = floatval($pl_duration);
                $start_odometer_data =  $this->cron_test_model->getstart_odometer($v_list->trip_id, $v_list->client_id, $v_list->vehicleid);
                $start_datetime = $start_odometer_data->create_datetime;
                if ($delay_status == 0 and $pl_duration != '') {
                    $datetime1 = new DateTime();
                    $datetime2 = new DateTime($start_datetime);
                    $interval = $datetime1->diff($datetime2);
                    $diff_hours = $interval->format('%h.%i');
                    $diff_hours  = floatval($diff_hours);
                    if ($diff_hours > $pl_duration) {
                        $sms_data = array(
                            "lat" => $latitude2,
                            "lng" => $longitude1,
                            "createdon" => date('Y-m-d H:i:s'),
                            "vehicle_id" => $v_list->vehicleid,
                            "client_id" => $v_list->client_id,
                            'type_id' => 5,
                            "all_status" => 59,
                            "show_status" => 1,
                            "sms_status" => 1,
                        );
                        $this->db->insert('sms_alert', $sms_data);
                        $data1 = array('delay_status' => 1);
                        $this->db->where('vehicleid', $v_list->vehicleid);
                        $this->db->where('trip_id', $v_list->trip_id);
                        $this->db->where('client_id', $v_list->client_id);
                        $this->db->update('zigma_plantrip', $data1);
                    }
                }
                if ($distance < $radius) {
                    $start_odo = $start_odometer_data->start_odometer;
                    $distance_value = $v_list->odometer - $start_odo;
                    $distance_value = ($distance_value > 0) ? $distance_value : 0;
                    $end_datetime = date('Y-m-d H:i:s');
                    $idle_data = $this->cron_test_model->smart_idleday($v_list->deviceimei, $start_datetime, $end_datetime);
                    $park_data = $this->cron_test_model->smart_parkday($v_list->deviceimei, $start_datetime, $end_datetime);
                    $idle_duration = $idle_data->idel_duration;
                    $hours = floor($idle_duration / 60);
                    $min = $idle_duration - ($hours * 60);
                    $min = floor((($min -   floor($min / 60) * 60)) / 6);
                    $second = $idle_duration % 60;
                    $idle_hrs = $hours . " Hours " . $min . " Minutes";

                    $park_duration = $park_data->parking_duration;
                    $hours = floor($park_duration / 60);
                    $min = $park_duration - ($hours * 60);
                    $min = floor((($min -   floor($min / 60) * 60)) / 6);
                    $second = $park_duration % 60;
                    $park_hrs = $hours . " Hours " . $min . " Minutes";

                    $data = array(
                        'end_odometer' => $v_list->odometer,
                        'distance' => $distance_value,
                        'e_lat' => $v_list->lat,
                        'e_lng' => $v_list->lng,
                        'end_location' => $v_list->latlon_address,
                        'manual_idle_dur' => $idle_hrs,
                        'parking_duration' => $park_hrs,
                        'flag' => 3,
                        'updated_datetime' => date('Y-m-d H:i:s')
                    );

                    $this->db->where('trip_id', $v_list->trip_id);
                    $this->db->where('client_id', $v_list->client_id);
                    $this->db->where('vehicle_id', $v_list->vehicleid);
                    $this->db->update('zigma_plantrip_report1', $data);
                    $data1 = array('status' => 3);
                    $this->db->where('vehicleid', $v_list->vehicleid);
                    $this->db->where('trip_id', $v_list->trip_id);
                    $this->db->where('client_id', $v_list->client_id);
                    $this->db->update('zigma_plantrip', $data1);

                    // Update Route Deviation Is Completed Then Change Default Status
                    $v_data = array('route_deviate_sms' => 0);
                    $this->db->where('deviceimei', $v_list->deviceimei);
                    $this->db->update('vehicletbl', $v_data);

                    $trip_idle_data = $this->cron_test_model->idle_report_list($start_datetime, $end_datetime, $v_list->deviceimei, 60, $start_geoid, $end_geoid);
                    $this->db->insert_batch('trip_plan_idle_report', $trip_idle_data);
                }
            }
        }
    }

    public function trip_plan()
    {
        $tripplan = DB::table('tripplan_reports')
            ->join('live_data AS l', 'l.deviceimei', '=', 'tripplan_reports.device_imei')
            ->whereIn('tripplan_reports.status', [1, 2])
            ->select('tripplan_reports.*', 'l.lattitute as vehicle_lat', 'l.longitute as vehicle_lng', 'l.odometer', 'l.deviceimei',)
            ->get()->toArray();
        print_r($tripplan);
        $first_geo_status_arr = array();
        foreach ($tripplan as $trip) {
            $vehicle_lat = $trip->vehicle_lat;
            $vehicle_lng = $trip->vehicle_lng;
            $radius = '500';
            if ($trip->status == 1) {
                $start_lat = $trip->s_lat;
                $start_lng = $trip->s_lng;
                $distance_data = $this->calculateDistance($start_lat, $start_lng, $vehicle_lat, $vehicle_lng, $radius);
                print_r($distance_data);
                if ($distance_data['location_status'] == 1) {
                    $first_geo_status_arr[] = array($trip->trip_id);
                } elseif (($distance_data['location_status'] == 2) && ($trip->geo_status == 1)) {
                    $processing_arr = array(
                        'device_imei' => $trip->deviceimei,
                        'vehicle_name' => $trip->vehicle_name,
                        'start_odometer' => $trip->odometer,
                        'flag' => 2,
                        'created_at' => date('Y-m-d H:i:s'),
                        'status' => 2,
                        'geo_status' => 0
                    );
                    DB::table('tripplan_reports')->whereIn('trip_id', array($trip->trip_id))
                        ->update($processing_arr);
                }
            } elseif ($trip->status == 2) {

                $end_lat = $trip->e_lat;
                $end_lng = $trip->e_lng;
                $distance_data = $this->calculateDistance($end_lat, $end_lng, $vehicle_lat, $vehicle_lng, $radius);
                print_r($distance_data);
                if ($distance_data['location_status'] == 1) {
                    $end_trip_arr = array(
                        'end_odometer' => $trip->odometer,
                        'distance' => $distance_data['distance'],
                        'flag' => 3,
                        'status' => 3,
                        'updated_at' => date('Y-m-d H:i:s')
                    );
                    DB::table('tripplan_reports')->whereIn('trip_id', array($trip->trip_id))
                        ->update($end_trip_arr);
                }
            }
        }
        if (count($first_geo_status_arr) > 0 && !empty($first_geo_status_arr)) {
            DB::table('tripplan_reports')->whereIn('trip_id', $first_geo_status_arr)
                ->update(['geo_status' => 1]);
        }
    }

    public function calculateDistance($lat1, $lon1, $lat2, $lon2, $radius)
    {
        // Calculate Distance Formula
        $earthRadius = 6371; // Earth's radius in kilometers
        $latd1 = deg2rad($lat1);
        $lond1 = deg2rad($lon1);
        $latd2 = deg2rad($lat2);
        $lond2 = deg2rad($lon2);
        // Haversine formula
        $deltaLat = $latd2 - $latd1;
        $deltaLon = $lond2 - $lond1;
        $a = sin($deltaLat / 2) * sin($deltaLat / 2) + cos($latd1) * cos($latd2) * sin($deltaLon / 2) * sin($deltaLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distance = $earthRadius * $c;
        $distance = round($distance * 1000);
        if ($distance < $radius)
            $status =  1;
        else
            $status =  2;
        $distance_data = array(
            'distance' => $distance,
            'location_status' => $status
        );
        return $distance_data;
    }

    public function planned_trips(Request $request)
    {
        $current_time = date("Y-m-d H:i:s");
        $trip_id = $request->trip_id;
        // print_r($trip_id);die;
        $start_time = $request->start_time;
        $end_time = $request->end_time;
        // print_r($end_time);
        // echo"<pre>";
        // print_r($end_time);
        $dateTime = Carbon::createFromTimestamp($start_time);
        $dateTime1 = Carbon::createFromTimestamp($end_time);
        $formattedDateTime = $dateTime->format('Y-m-d H:i:s');
        $formattedDateTime1 = $dateTime1->format('Y-m-d H:i:s');
        $tripplan['tripplan'] = DB::table('tripplan_reports AS t')
            ->select(
                't.device_imei',
                't.vehicle_name',
                't.route_name',
                't.s_lat',
                't.s_lng',
                't.e_lat',
                't.e_lng',
                'l.lattitute',
                'l.longitute',
                'l.angle',
                'l.ignition',
                'l.speed',
                'p.route_polyline AS polyline',
                DB::raw('TIMESTAMPDIFF(MINUTE, l.device_updatedtime, "' . $current_time . '") AS update_time')
            )
            ->join('live_data AS l', 'l.deviceimei', '=', 't.device_imei')
            ->join('routes AS p', 'p.routename', '=', 't.route_name')
            ->where('t.trip_id', '=', $trip_id)
            ->get()->toArray();
        if ($tripplan['tripplan']) {
            $device_imei = $tripplan['tripplan'][0]->device_imei;
            $tripplan['playback'] = DB::table('play_back_histories')
                ->select('latitude', 'longitude', 'device_datetime')
                ->where('device_imei', $device_imei) // Use 'device_imei' from the first query
                ->whereBetween('device_datetime', [$formattedDateTime, $formattedDateTime1])
                ->get();
        }

        // print_r($tripplan);die;
        return $tripplan;
    }

    public function create()
    {
        $vehicle = DB::table('vehicles')->select('device_imei', 'vehicle_name')->where('status', '=', '1')->get();
        $routes = DB::table('routes')->select('id', 'routename', 'route_start_lat', 'route_start_lng', 'route_end_lat', 'route_end_lng')->get();
        return view('trip_plan.add_trip', compact('vehicle', 'routes'));
    }

    public function store(Request $request)
    {
        $device_imei = $request->input('vehicleid');
        $route_id = $request->input('route_id');

        $vehicle = DB::table('vehicles')
            ->select('id as vehicle_id', 'device_imei', 'vehicle_name')
            ->where('status', '=', '1')
            ->where('device_imei', '=', "$device_imei")
            ->first();
        $routes = DB::table('routes')
            ->select('id', 'routename')
            ->where('id', '=', "$route_id")
            ->first();

        try {


            DB::beginTransaction();
            $TripplanReport = new TripplanReport();
            $TripplanReport->poc_number = $request->input('poc_number');
            $TripplanReport->route_name = $request->input('route_id');
            $TripplanReport->s_lat = $request->input('start_latitude');
            $TripplanReport->s_lng = $request->input('start_longitude');
            $TripplanReport->e_lat = $request->input('end_latitude');
            $TripplanReport->e_lng = $request->input('end_longitude');
            $TripplanReport->device_imei = $request->input('vehicleid');
            $TripplanReport->vehicleid = $vehicle->vehicle_id;
            $TripplanReport->trip_date = $request->input('trip_date');
            $TripplanReport->vehicle_name = $vehicle->vehicle_name;
            $TripplanReport->route_name = $routes->routename;
            // $TripplanReport->created_at = NULL;
            // $TripplanReport->updated_at = NULL;
            $TripplanReport->status = 1;


            $TripplanReport->save();
            DB::commit();

            return response(['message' => "Success"]);
        } catch (\Exception $e) {
            DB::rollback();
            return response(['message' => "Failure"]);
        }
    }

    public function get_playback_data(Request $request)
    {

        $device_imei = $request->input('device_imei');
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');
        $dateTime = Carbon::createFromTimestamp($from_date);
        $dateTime1 = Carbon::createFromTimestamp($to_date);
        $formattedDateTime = $dateTime->format('Y-m-d H:i:s');
        $formattedDateTime1 = $dateTime1->format('Y-m-d H:i:s');
        $tripplan = DB::table('parking_reports')
            ->select(
                'id',
                'start_latitude',
                'start_longitude',
                DB::raw('TIMEDIFF(end_datetime, start_datetime) AS time_difference')
            )
            ->where('device_imei', $device_imei)
            ->where('start_datetime', '>=', $formattedDateTime)
            ->where('end_datetime', '<=', $formattedDateTime1)
            ->get();
        return $tripplan;
    }
}
