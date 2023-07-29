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
                                            <h3 align="center">Parking Report</h3>

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
                                                    @foreach ($parking_data as $park)
                                                        <tr>
                                                            {{-- <td>{{ $trip->client_id }}</td> --}}
                                                            {{-- <td>{{ $trip->vehicleid }}</td> --}}
                                                            <td>{{ $s_no++ }}</td>
                                                            <td>{{ $park->vehiclename }}</td>
                                                            <td>{{ $park->start_location }}</td>
                                                            <td>{{ $park->end_location }}</td>
                                                            <td>{{ $park->start_time }}</td>
                                                            <td>{{ $park->end_time }}</td>
                                                            <td>{{ $park->duration }}</td>
                                                            <td><button class="btn btn-sm btn-success map_edit">MAP VIEW</button></td>
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
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                </div>
                <div class="card-body card-dashboard" style="height:600px !important;">
                    <div id="map">

                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    </div>
@endsection

@push('scripts')
    {{-- <link rel="stylesheet" href="{{ 'https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css' }}" />
    <script src="{{ 'https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js' }}"></script> --}}
    <script type="text/javascript">
        var map = L.map('map').setView([10.84125, 79.84266000000001], 6);
        // create a new tile layer
        var tileUrl = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
            layer = new L.TileLayer(tileUrl, {
                attribution: 'Maps © <a href=\"www.openstreetmap.org/copyright\">OpenStreetMap</a> contributors',
                maxZoom: 20
            });
        // add the layer to the map
        // Google Layer
        var Google_layer = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        });
        map.addLayer(Google_layer);

        $(".map_edit").click(function(e) {
            e.preventDefault();
            // alert("hello");
            map.setZoom(10);
            var mark_img = "{{ 'assets/dist/img/icon/marker_loc.png' }}";

            // var marker_content = array[12];

            var redIcon = new L.Icon({
                iconUrl: mark_img
            });

            var s_lat = 17.538310;
            var s_lng = 79.210775;
            var startCoords = [s_lat, s_lng];
            console.log(startCoords);

            StartMarker1 = L.marker(startCoords, {
                icon: redIcon
            }).addTo(map);

            var group = new L.featureGroup([StartMarker1]);

            map.fitBounds(group.getBounds());

        });
    </script>
    </body>
@endpush
