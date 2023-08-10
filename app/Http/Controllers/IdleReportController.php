<?php

namespace App\Http\Controllers;

use App\Models\IdleReport;
use App\Http\Requests\StoreIdleReportRequest;
use App\Http\Requests\UpdateIdleReportRequest;
// use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request;

class IdleReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        // $idle_data = IdleReport::get();
        // return view('report.idle_report', compact('idle_data'));
        return view('report.idle_report');
    }

    public function getData(Request $request)
    {

        $totalFilteredRecord = $totalDataRecord = $draw_val = "";
        $columns_list = array(
            0 => 'id'
        );

        $totalDataRecord = IdleReport::count();

        $totalFilteredRecord = $totalDataRecord;

        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        $order_val = $columns_list[$request->input('order.0.column')];
        $dir_val = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $post_data = IdleReport::offset($start_val)
                ->limit($limit_val)
                ->orderBy($order_val, $dir_val)
                ->get();
        } else {
            $search_text = $request->input('search.value');

            $post_data =  IdleReport::where('id', 'LIKE', "%{$search_text}%")
                ->orWhere('device_no', 'LIKE', "%{$search_text}%")
                ->orWhere('start_location', 'LIKE', "%{$search_text}%")
                ->orWhere('end_location', 'LIKE', "%{$search_text}%")
                ->offset($start_val)
                ->limit($limit_val)
                ->orderBy($order_val, $dir_val)
                ->get();

            $totalFilteredRecord = IdleReport::where('id', 'LIKE', "%{$search_text}%")
                ->orWhere('device_no', 'LIKE', "%{$search_text}%")
                ->orWhere('start_location', 'LIKE', "%{$search_text}%")
                ->orWhere('end_location', 'LIKE', "%{$search_text}%")
                ->count();
        }

        if (!empty($post_data)) {
            $draw_val = $request->input('draw');
            $get_json_data = array(
                "draw"            => intval($draw_val),
                "recordsTotal"    => intval($totalDataRecord),
                "recordsFiltered" => intval($totalFilteredRecord),
                "data"            => $post_data
            );

            echo json_encode($get_json_data);
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreIdleReportRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(IdleReport $idleReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(IdleReport $idleReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateIdleReportRequest $request, IdleReport $idleReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IdleReport $idleReport)
    {
        //
    }
}
