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
@push('styles')
    <style>
        #map {
            height: 100%;
        }
    </style>
@endpush
@section('content')
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

                                    <div class="table-responsive">
                                        <div class="col-12 table-responsive">
                                            <br />
                                            <h3 align="center">Idle Report</h3>

                                            <br />
                                            <table class="table table-striped table-bordered user_datatable">
                                                <thead>
                                                    <tr>
                                                        <th>S.No</th>
                                                        <th>vehicle_name</th>
                                                        <th>start_location</th>
                                                        <th>end_location</th>
                                                        <th>Start Time</th>
                                                        <th>End Time</th>
                                                        <th>Duration</th>
                                                        <th>Map View</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    @php
                                                        $s_no = 1;
                                                    @endphp
                                                    @foreach ($idle_data as $idle)
                                                        <tr>
                                                            <td>{{ $s_no++ }}</td>
                                                            <td>{{ $idle->vehiclename }}</td>
                                                            <td>{{ $idle->start_location }}</td>
                                                            <td>{{ $idle->end_location }}</td>
                                                            <td>{{ $idle->start_time }}</td>
                                                            <td>{{ $idle->end_time }}</td>
                                                            <td>{{ $idle->duration }}</td>
                                                            <td><button type="button" class="btn btn-success showModal"
                                                                    data-toggle="modal" data-target="#myModal"
                                                                    data-lat='17.538310' data-lng='79.210775'>
                                                                    Map View
                                                                </button></td>
                                                        </tr>
                                                    @endforeach
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
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Idle Report</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body modal_offset">
                    <div class="row">
                        <div class="col-md-12 modal_body_content">
                            <p>Location : Karnataka</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 modal_body_map">
                            <div class="map" id="map">
                                <div style="width: 100px; height: 400px;" id="map_canvas"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 modal_body_end">
                            <p>APEMCL</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


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

@push('scripts')
    {{-- <link rel="stylesheet" href="{{ 'https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css' }}" />
    <script src="{{ 'https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js' }}"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script> --}}
    {{-- <script src="script.js"></script> --}}
    <script type="text/javascript">
        var map = L.map('map').setView([10.84125, 79.84266000000001], 6);
        // create a new tile layer
        var tileUrl = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
            layer = new L.TileLayer(tileUrl, {
                attribution: 'Maps © <a href=\"www.openstreetmap.org/copyright\">OpenStreetMap</a> contributors',
                maxZoom: 20,
                noWrap: true,
            });
        // add the layer to the map
        // Google Layer
        var Google_layer = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        });
        map.addLayer(Google_layer);
        $('.showModal').on('click', function() {
            var lat = $(this).data('lat');
            var lng = $(this).data('lng');
            setTimeout(function() {
                map.invalidateSize();
                showMap(lat, lng);
            }, 200);
        });

        function showMap(lat, lng) {

            var mark_img = "{{ 'assets/dist/img/icon/marker_loc.png' }}";

            var redIcon = new L.Icon({
                iconUrl: mark_img
            });

            var startCoords = [lat, lng];
            console.log(startCoords);

            StartMarker1 = L.marker(startCoords, {
                icon: redIcon
            }).addTo(map);
            // map.setZoom(10);
            // console.log(map.getZoom());
            // map.setMinZoom(map.getZoom());            
            var group = new L.featureGroup([StartMarker1]);

            map.fitBounds(group.getBounds());
            // var popup = L.popup()
            //     .setContent("I am a standalone popup.");
            StartMarker1.bindPopup("hello").openPopup();
            // StartMarker1.bindPopup().openPopup();
            map.setView(startCoords, 12);
        }
    </script>

    </body>
@endpush
