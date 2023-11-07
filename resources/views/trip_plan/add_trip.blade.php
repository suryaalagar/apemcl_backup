@extends('layouts.app')
@section('content')
@push('scripts')
<style>
    #map {
        height: 500px;
        width: 100%;
    }

    .input {
        position: absolute;
        top: 0;
        right: 0;
        margin-top: 8px;
    }
</style>
@endpush
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<section class="">
    <div class="row">
        <div class="col-md-12 addrouteassign">

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Trip plan</h4> <a class="heading-elements-toggle "><i class="fa fa-ellipsis-v font-medium-3"></i></a>

                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form-horizontal form-simple" id="tripplanform" method="post" novalidate enctype="multipart/form-data">
                            <div class="row">

                                <div class="col-xl-2 col-lg-6 col-md-12">
                                    <fieldset class="form-group">
                                        <label for="start_location">Transaction Id:</label>
                                        <input type="text" class="form-control" name="poc_number" id="poc_number" placeholder="Enter Transaction Id">
                                    </fieldset>
                                </div>

                                <div class="col-md-3">
                                    <label>Trip Date</label>
                                    <div class="input-group">
                                        <input type='datetime-local' id="trip_date" name="trip_date" class="form-control startLocalDate" value=''>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-lg-6 col-md-12">
                                    <fieldset class="form-group">
                                        <label for="vehicleid">Vehicle Name</label>
                                        <select class="form-control select2" id="vehicleid" name="vehicleid">
                                            <option>Select Vehicle</option>
                                            @if ($vehicle)
                                            @foreach ($vehicle as $dlist)
                                            <option value="{{ $dlist->device_imei }}">
                                                {{ $dlist->vehicle_name }}
                                            </option>
                                            @endforeach
                                            @endif
                                        </select>

                                    </fieldset>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-md-12">
                                    <fieldset class="form-group">
                                        <label>Route Name</label>
                                        <!--<input type="text" class="form-control" name="route_namedevi" id="route_namedevi" value="">-->
                                        <select name="route_id" class="select2 form-control" id="route_id">
                                            <option>Select Route</option>
                                            @if ($routes)
                                                @foreach ($routes as $rlist)
                                                    <option value="{{ $rlist->id }}" 
                                                            data-start-lat="{{ $rlist->route_start_lat }}"
                                                            data-start-lng="{{ $rlist->route_start_lng }}"
                                                            data-end-lat="{{ $rlist->route_end_lat }}"
                                                            data-end-lng="{{ $rlist->route_end_lng }}">
                                                        {{ $rlist->routename }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>

                                    </fieldset>
                                </div>



                                <div class="col-xl-2 col-lg-6 col-md-12">
                                    <fieldset class="form-group">
                                        <button type="submit" id="submit_btn" style="margin-top: 25px;" class="btn btn-primary btn-min-width mr-1"></i> Create</button>
                                    </fieldset>
                                </div>
                                <div class="col-xl-2 col-lg-6 col-md-12">
                                    <fieldset class="form-group">
                                        <button type="button" style="margin-top: 25px;" class="btn btn-primary btn-min-width mr-1" onClick="window.location.reload();">Reset</button>
                                    </fieldset>
                                </div>

                                <input type="hidden" class="form-control start_input" name="start_latitude" id="start_latitude" placeholder="Enter Start latitude">
                                <input type="hidden" class="form-control start_input" name="start_longitude" id="start_longitude" placeholder="Enter Start Longitude">
                                <input type="hidden" class="form-control end_input" name="end_latitude" id="end_latitude" placeholder="Enter End latitude">
                                <input type="hidden" class="form-control end_input" name="end_longitude" id="end_longitude" placeholder="Enter End Longitude">

                                <input type="hidden" id="id" name="id" value="">

                                <span id="alert_msg" style="color:red;"></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script>

    $('#route_id').on('change', function () {
            var selectedRoute = $(this).find('option:selected');
            $('#start_latitude').val(selectedRoute.data('start-lat'));
            $('#start_longitude').val(selectedRoute.data('start-lng'));
            $('#end_latitude').val(selectedRoute.data('end-lat'));
            $('#end_longitude').val(selectedRoute.data('end-lng'));
        });

    $("#tripplanform").submit(function(e) {
        var simid = $('#simid').val();
        e.preventDefault();
        var form = $(this);

        $.ajax({
            type: "POST",
            url: "{{ route('trip_plan.store') }}",
            data: form.serialize(), // serializes the form's elements.
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {

                if (data.message == 'Success') {
                    toastr.success("Data Updated Successfully!", "INSERT", {
                        progressBar: !0
                    });
                    window.location.href = '{{ route('tripplanreport.index') }}';
                }
                if (data.message == 'validaton_error') {
                    toastr.warning('Validate Error!', "Decline", {
                        progressBar: !0
                    });
                } else {
                    toastr.warning("Data Not Inserted!", "Decline", {
                        progressBar: !0
                    });
                }
            }
        });


    });
</script>
@endpush