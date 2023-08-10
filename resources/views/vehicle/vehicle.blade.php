@extends('layouts.app')
@section('content')
    <section class="">
        <div class="row">
            <div class="col-md-12 adduser" style="display:none">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add Vehicle </h4> <a class="heading-elements-toggle"><i
                                class="fa fa-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="close"><i class="feather icon-x"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form-horizontal form-simple" id="simform" method="post" novalidate
                                enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 mb-1">
                                        <h5 class="text-bold-600">Vehicle</h4>
                                    </div>

                                    <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="imeinumber" class="required requiredimei">Vehicle Name<span
                                                    class="error">&nbsp;*</span></label>
                                            <input type="number" class="form-control allow-numeric" name="imeinumber"
                                                pattern=^[a-zA-Z0-9]*$ minlength="6" maxlength="20" id="imeinumber"
                                                placeholder="Enter the IMEI Number">
                                            <div class="div2" id="div2"></div>
                                            <span class="error_msg text-danger"></span>
                                        </fieldset>
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="imeinumber" class="required requiredimei">Device Imei<span
                                                    class="error">&nbsp;*</span></label>
                                            <input type="number" class="form-control allow-numeric" name="imeinumber"
                                                pattern=^[a-zA-Z0-9]*$ minlength="6" maxlength="20" id="imeinumber"
                                                placeholder="Enter the IMEI Number">
                                            <div class="div2" id="div2"></div>
                                            <span class="error_msg text-danger"></span>
                                        </fieldset>
                                    </div>

                                    <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="imeinumber" class="required requiredimei">Sim
                                                Number<span class="error">&nbsp;*</span></label>
                                            <input type="number" class="form-control allow-numeric" name="imeinumber"
                                                pattern=^[a-zA-Z0-9]*$ minlength="6" maxlength="20" id="imeinumber"
                                                placeholder="Enter the IMEI Number">
                                            <div class="div2" id="div2"></div>
                                            <span class="error_msg text-danger"></span>
                                        </fieldset>
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-12">
                                        <fieldset class="form-group">
                                            <label for="gender">Status</label>
                                            <select class="form-control" id="status" name="status">

                                                <option value="1">Active</option>
                                                <option value="2">Deactive</option>
                                            </select>
                                        </fieldset>
                                    </div>

                                    <input type="hidden" name="simid" id="simid" value="">

                                    <div class="col-xl-12 col-lg-12 col-md-12">
                                        <input type="submit"
                                            class="btn btn-primary btn-min-width mr-1 btn-next btn-next1 block-page"
                                            value="Submit" id='submit'>
                                        <button type="button" class="btn btn-primary btn-min-width"
                                            id="closeform">Reset</button>
                                    </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>


    <section id="configuration">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-content collapse show">
                        <div class="row">
                            <div class="col-12">
                                <div class="card-body card-dashboard">
                                    <div class="content-header-right col-md-12 col-12 mb-md-0 mb-2">
                                        <div class="btn-group float-md-right" role="group"
                                            aria-label="Button group with nested dropdown">
                                            <div class="btn-group role="group">
                                                <button class="btn btn-outline-primary" id="showuser" type="button"> <i
                                                        class="feather icon-user-plus icon-left"></i> Add Vehicle </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <div class="col-12 table-responsive">
                                            <br />
                                            <h3 align="center">Vehicle</h3>

                                            <br />
                                            <table class="table table-striped table-bordered" id="datatable">
                                                <thead>
                                                    <tr>
                                                        <th>S.No</th>
                                                        <th>Vehicle Name</th>
                                                        <th>Device Imei</th>
                                                        <th>Sim No</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    {{-- @php
                                                        $s_no = 1;
                                                    @endphp
                                                    @foreach ($idle_data as $idle)
                                                        <tr>
                                                            <td>{{ $s_no++ }}</td>
                                                            <td>{{ $idle->vehiclename }}</td>
                                                            <td>{{ $idle->start_location }}</td>
                                                            <td>{{ $idle->end_location }}</td>
                                                            <td>{{ $idle->start_day }}</td>
                                                            <td>{{ $idle->end_day }}</td>
                                                            <td>{{ $idle->duration }}</td>
                                                            <td><button type="button" class="btn btn-success showModal"
                                                                    data-toggle="modal" data-target="#myModal"
                                                                    data-lat='{{$idle->s_lat}}' data-lng='{{$idle->s_lng}}'>
                                                                    Map View
                                                                </button></td>
                                                        </tr>
                                                    @endforeach --}}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    </section>
    <!-- Modal -->


    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#datatable').DataTable({

                    processing: true,
                    serverSide: true,
                    method: 'GET',
                    ajax: "{{ route('vehicle.getData') }}",
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'vehicle_name',
                            name: 'vehicle_name'
                        },
                        {
                            data: 'device_imei',
                            name: 'device_imei'
                        },
                        {
                            data: 'sim_mob_no',
                            name: 'sim_mob_no'
                        }
                    ]

                });
            });

            $("#showuser").click(function() {
                $('#simform')[0].reset();
                $('#simid').val("");

                $('.adduser').show(2000); //Add userpage hide
                $('#configuration').hide(); // hide view page
            });
            $("#closeform").click(function() {

                location.reload();
            });
        </script>
    @endpush
@endsection
