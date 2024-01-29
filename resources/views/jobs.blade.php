<!-- resources/views/jobs/index.blade.php -->

@extends('layouts.app')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Job Data</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Venue</th>
                                    <th>Customer</th>
                                    <th>Call Type</th>
                                    <th>Remark</th>
                                    <th>User Location</th>
                                    <th>User Email</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($jobs as $job)
                                    <tr>
                                        <td>{{ $job->id }}</td>
                                        <td>{{ $job->venue }}</td>
                                        <td>{{ $job->customer }}</td>
                                        <td>{{ $job->callType }}</td>
                                        <td>{{ $job->remark }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary show-location-btn"
                                                    data-user-location="{{ $job->userLocation }}">
                                                Show Location
                                            </button>
                                        </td>
                                        <td>{{ $job->userEmail }}</td>
                                        <td>{{ $job->status }}</td>
                                        <td>{{ $job->created_at }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9">No jobs found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    $(document).ready(function () {
        var table = $('#example').DataTable( {
            responsive: true
        });

        // Function to initialize Leaflet map
        function initMap(latitude, longitude) {
            var map = L.map('locationMap').setView([latitude, longitude], 15);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);
            L.marker([latitude, longitude]).addTo(map)
                .bindPopup('User Location')
                .openPopup();
        }

        // Attach click event to Show Location buttons
        $('.show-location-btn').click(function () {
            var userLocation = $(this).data('user-location');
            var [latitude, longitude] = userLocation.split(',').map(parseFloat);
            $('#locationMap').html('');
            initMap(latitude, longitude);
            $('#locationModal').modal('show');
        });
    });
</script>
<!-- Location Modal -->
<div class="modal fade" id="locationModal" tabindex="-1" role="dialog" aria-labelledby="locationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="locationModalLabel">User Location</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="locationMap" style="height: 200px;"></div>
            </div>
        </div>
    </div>
</div>
@endsection
