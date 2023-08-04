{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dattable Example by PHP TECH LIFE</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.dataTables.css') }}"/>
    <script type="text/javascript" src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.dataTables.js') }}"></script>    
</head> --}}
@extends('layouts.app')
@section('content')

    <body>
        <div class="card-body">
            <ul class="nav nav-tabs nav-underline" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="baseIcon-tab21" data-toggle="tab" aria-controls="tabIcon21" href="#tabIcon21"
                        role="tab" aria-selected="true"><i class="fa fa-play"></i>All</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="baseIcon-tab24" data-toggle="tab" aria-controls="tabIcon24" href="#tabIcon24"
                        role="tab" aria-selected="false"><i class="fa fa-flag"></i>In HUB</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="baseIcon-tab22" data-toggle="tab" aria-controls="tabIcon22" href="#tabIcon22"
                        role="tab" aria-selected="false"><i class="fa fa-flag"></i>Trip Processing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="baseIcon-tab23" data-toggle="tab" aria-controls="tabIcon23" href="#tabIcon23"
                        role="tab" aria-selected="false"><i class="fa fa-cog"></i>Trip Completed</a>
                </li>
            </ul>
            <div class="card">
                <div class="card-header">
                </div>
                <div class="tab-content px-1 pt-1">
                    <div class="tab-pane active" id="tabIcon21" role="tabpanel" aria-labelledby="baseIcon-tab21">
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                <table class="table table-striped table-bordered" id="alltrips">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th>S.No</th>
                                            <th>Trip id</th>
                                            <th>POC Number</th>
                                            <th>IMEI/ SIM</th>
                                            <th>TripDate</th>
                                            <th>Vehicle Name</th>
                                            <th>Route Name</th>
                                            <th>Last Updatetime</th>
                                            <th>Vehicle Status</th>
                                            <th>On duration</th>
                                            <th>Start Location</th>
                                            <th>End location</th>
                                            <th>Trip Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <div class="ln_solid"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tabIcon24" role="tabpanel" aria-labelledby="baseIcon-tab24">
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                <table class="table table-striped table-bordered" id="inhubtrips">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th>S.No</th>
                                            <th>Trip id</th>
                                            <th>POC Number</th>
                                            <th>IMEI/SIM</th>
                                            <th>TripDate</th>
                                            <th>Vehicle Name</th>
                                            <th>Route Name</th>
                                            <th>Last Updatetime</th>
                                            <th>Vehicle Status</th>
                                            <th>On duration</th>
                                            <th>Start Location</th>
                                            <th>End location</th>
                                            <th>Trip Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <div class="ln_solid"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tabIcon22" role="tabpanel" aria-labelledby="baseIcon-tab22">
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                <table class="table table-striped table-bordered" id="processtrips">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th>S.No</th>
                                            <th>Trip id</th>
                                            <th>POC Number</th>
                                            <th>IMEI/SIM</th>
                                            <th>TripDate</th>
                                            <th>Vehicle Name</th>
                                            <th>Route Name</th>
                                            <th>Last Updatetime</th>
                                            <th>Vehicle Status</th>
                                            <th>On duration</th>
                                            <th>Start Location</th>
                                            <th>End location</th>
                                            <th>Trip Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <div class="ln_solid"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tabIcon23" role="tabpanel" aria-labelledby="baseIcon-tab23">
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                <table class="table table-striped table-bordered" id="completetrips">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th>S.No</th>
                                            <th>Trip id</th>
                                            <th>POC Number</th>
                                            <th>Device IMEI</th>
                                            <th>TripDate</th>
                                            <th>Vehicle Name</th>
                                            <th>Route Name</th>
                                            <th>Last Updatetime</th>
                                            <th>Vehicle Status</th>
                                            <th>On duration</th>
                                            <th>Start Location</th>
                                            <th>End location</th>
                                            <th>Trip Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <div class="ln_solid"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>


        @push('scripts')
            <script type="text/javascript" src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
            <script type="text/javascript" src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
        @endpush

    </body>
@endsection

@push('scripts')
    <script type="text/javascript">
        // jQuery.noConflict();
        $(document).ready(function() {
            // alert("helloooo");
            // var table = $('.user_datatable').DataTable({
            //     processing: true,
            //     serverSide: true,
            //     ajax: "{{ route('tripplanreport.index') }}",
            //     columns: [{
            //             data: 'client_id',
            //             name: 'client_id'
            //         },
            //         {
            //             data: 'vehicleid',
            //             name: 'vehicleid'
            //         },
            //         {
            //             data: 'vehicle_name',
            //             name: 'vehicle_name'
            //         },
            //         {
            //             data: 'start_location',
            //             name: 'start_location'
            //         },
            //         {
            //             data: 'end_location',
            //             name: 'end_location'
            //         },
            //         {
            //             data: 'poc_number',
            //             name: 'poc_number'
            //         },
            //         {
            //             data: 'route_name',
            //             name: 'route_name'
            //         },
            //         {
            //             data: 'action',
            //             name: 'action',
            //             orderable: false,
            //             searchable: false
            //         },
            //     ]
            // });
        });

        $(function() {
            $("#alltrips,#inhubtrips,#completetrips,#processtrips").dataTable({
                scrollX: true,
                dom: 'Bfrtip',
                buttons: [
                    'excel'
                ]
            });
        })
    </script>
@endpush
