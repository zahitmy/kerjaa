<!-- resources/views/user_location_map.blade.php -->

@extends('layouts.app')

@section('content')
    <div id="map" style="height: 500px;"></div>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script>
        // Initialize the map
        var map = L.map('map');

        // Create an empty LatLngBounds object to contain all user locations
        var bounds = new L.LatLngBounds();

        // Add OpenStreetMap as a tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Add markers for user locations and extend the bounds
        @foreach($userLocations as $userLocation)
            var marker = L.marker([{{ $userLocation->latitude }}, {{ $userLocation->longitude }}])
                .addTo(map)
                .bindPopup('User ID: {{ $userLocation->user_id }} <br>Name: {{ $userLocation->user->name }} <br>Latitude: {{ $userLocation->latitude }}<br>Longitude: {{ $userLocation->longitude }}');

            bounds.extend(marker.getLatLng());
        @endforeach

        // Set the map view to fit the bounds
        map.fitBounds(bounds);
    </script>
@endsection
