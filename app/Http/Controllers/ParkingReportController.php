<?php

namespace App\Http\Controllers;

use App\Models\ParkingReport;
use App\Http\Requests\StoreParkingReportRequest;
use App\Http\Requests\UpdateParkingReportRequest;

class ParkingReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parking_data = ParkingReport::get();
        return view('report.parking_report',compact('parking_data'));
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
    public function store(StoreParkingReportRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ParkingReport $parkingReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ParkingReport $parkingReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateParkingReportRequest $request, ParkingReport $parkingReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ParkingReport $parkingReport)
    {
        //
    }
}
