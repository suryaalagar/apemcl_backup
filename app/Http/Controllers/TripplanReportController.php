<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\Datatables;
use App\Models\TripplanReport;
// use DataTables;
// use Validator;

class TripplanReportController extends Controller
{

    public function index(Request $request)
    {
       
        // if ($request->ajax()) {

            // $data = TripplanReport::select('*');
            // return Datatables::of($data)
            //     ->addIndexColumn()
            //     ->addColumn('action', function($row){
            //         $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
            //         return $actionBtn;
            //     })
            //     ->rawColumns(['action'])
            //     ->make(true);
            //return view('report.trip_plan',compact($data));
            $trip_plans = TripplanReport::get();
            return view('report.trip_plan',compact('trip_plans'));
            // }

    }

    public function getData(Request $request)
    {

        $draw                 =         $request->get('draw'); // Internal use
        $start                 =         $request->get("start"); // where to start next records for pagination
        $rowPerPage         =         $request->get("length"); // How many recods needed per page for pagination

        $orderArray        =         $request->get('order');
        $columnNameArray     =         $request->get('columns'); // It will give us columns array

        $searchArray         =         $request->get('search');
        $columnIndex         =         $orderArray[0]['column'];  // This will let us know,
        // which column index should be sorted 
        // 0 = id, 1 = name, 2 = email , 3 = created_at
         
        $columnName         =         $columnNameArray[$columnIndex]['data']; // Here we will get column name, 
        // Base on the index we get

        $columnSortOrder     =         $orderArray[0]['dir']; // This will get us order direction(ASC/DESC)
        $searchValue         =         $searchArray['value']; // This is search value 


        $users = TripplanReport::count();
        $total = $users->count();

        $totalFilter = \DB::table('tripplan_reports');
        if (!empty($searchValue)) {
            $totalFilter = $totalFilter->where('client_id', 'like', '%' . $searchValue . '%');
            $totalFilter = $totalFilter->orWhere('vehicleid', 'like', '%' . $searchValue . '%');
            $totalFilter = $totalFilter->orWhere('vehicle_name', 'like', '%' . $searchValue . '%');
            $totalFilter = $totalFilter->orWhere('start_location', 'like', '%' . $searchValue . '%');
            $totalFilter = $totalFilter->orWhere('end_location', 'like', '%' . $searchValue . '%');
            $totalFilter = $totalFilter->orWhere('poc_number', 'like', '%' . $searchValue . '%');
            $totalFilter = $totalFilter->orWhere('route_name', 'like', '%' . $searchValue . '%');
        }
        $totalFilter = $totalFilter->count();


        $arrData = \DB::table('tripplan_reports');
        $arrData = $arrData->skip($start)->take($rowPerPage);
        $arrData = $arrData->orderBy($columnName, $columnSortOrder);
        if (!empty($searchValue)) {
            // $arrData = $arrData->where('name','like','%'.$searchValue.'%');
            // $arrData = $arrData->orWhere('email','like','%'.$searchValue.'%');
            $arrData = $arrData->where('client_id', 'like', '%' . $searchValue . '%');
            $arrData = $arrData->orWhere('vehicleid', 'like', '%' . $searchValue . '%');
            $arrData = $arrData->orWhere('vehicle_name', 'like', '%' . $searchValue . '%');
            $arrData = $arrData->orWhere('start_location', 'like', '%' . $searchValue . '%');
            $arrData = $arrData->orWhere('end_location', 'like', '%' . $searchValue . '%');
            $arrData = $arrData->orWhere('poc_number', 'like', '%' . $searchValue . '%');
            $arrData = $arrData->orWhere('route_name', 'like', '%' . $searchValue . '%');
        }

        $arrData = $arrData->get();

        $response = array(
            "draw" => intval($draw),
            "recordsTotal" => $total,
            "recordsFiltered" => $totalFilter,
            "data" => $arrData,
        );

        return response()->json($response);
    }
}
