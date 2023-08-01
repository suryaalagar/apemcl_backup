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
        <div class="card">
            <div class="container">
                <div class="row">
                    <div class="col-12 table-responsive">
                        <br />
                        <h3 align="center">Trip Plan</h3>

                        <br />
                        <table class="table table-striped table-bordered user_datatable">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>vehicle_name</th>
                                    <th>start_location</th>
                                    <th>end_location</th>
                                    <th>poc_number</th>
                                    <th>route_name</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
    
                            <tbody>
                                @php
                                    $s_no = 1;
                                @endphp
                                @foreach ($trip_plans as $trip)
                                    <tr>
                                        {{-- <td>{{ $trip->client_id }}</td> --}}
                                        {{-- <td>{{ $trip->vehicleid }}</td> --}}
                                        <td>{{ $s_no++ }}</td>
                                        <td>{{ $trip->vehicle_name }}</td>
                                        <td>{{ $trip->start_location }}</td>
                                        <td>{{ $trip->end_location }}</td>
                                        <td>{{ $trip->poc_number }}</td>
                                        <td>{{ $trip->route_name }}</td>
                                        <td>{{ "Completed"}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
    
                <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="post" id="sample_form" class="form-horizontal">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ModalLabel">Add New Record</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <span id="form_result"></span>
                                    <div class="form-group">
                                        <label>Name : </label>
                                        <input type="text" name="name" id="name" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label>Email : </label>
                                        <input type="email" name="email" id="email" class="form-control" />
                                    </div>
                                    <div class="form-group editpass">
                                        <label>Password : </label>
                                        <input type="password" name="password" id="password" class="form-control" />
                                    </div>
                                    <input type="hidden" name="action" id="action" value="Add" />
                                    <input type="hidden" name="hidden_id" id="hidden_id" />
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <input type="submit" name="action_button" id="action_button" value="Add"
                                        class="btn btn-info" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
    
                <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="post" id="sample_form" class="form-horizontal">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ModalLabel">Confirmation</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h4 align="center" style="margin:0;">Are you sure you want to remove this data?</h4>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                                </div>
                            </form>
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

    {{-- <script>
    $(document).ready(function(){
        // alert("hello");
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            order: [[ 0, "desc" ]],
            ajax: "{{ url('trip-data') }}",
            columns: [
                { data: 'client_id' },
                { data: 'vehicleid' },
                { data: 'vehicle_name' },
                { data: 'start_location' },
                { data: 'end_location' },
                { data: 'poc_number' },
                { data: 'route_name' }
            ]
        });
    });
</script> --}}
@endsection

{{-- @push('scripts')
    <script type="text/javascript">
        // jQuery.noConflict();
        $(document).ready(function() {
            // alert("helloooo");
            var table = $('.user_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('tripplanreport.index') }}",
                columns: [{
                        data: 'client_id',
                        name: 'client_id'
                    },
                    {
                        data: 'vehicleid',
                        name: 'vehicleid'
                    },
                    {
                        data: 'vehicle_name',
                        name: 'vehicle_name'
                    },
                    {
                        data: 'start_location',
                        name: 'start_location'
                    },
                    {
                        data: 'end_location',
                        name: 'end_location'
                    },
                    {
                        data: 'poc_number',
                        name: 'poc_number'
                    },
                    {
                        data: 'route_name',
                        name: 'route_name'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
    </script>
@endpush --}}
