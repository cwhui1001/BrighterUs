@vite(['resources/css/admin/events.css', 'resources/js/admin/events.js','resources/js/admin/notifications.js'])

@extends('layouts.admin')
@if (session('success'))
    <div id="success-alert" class="alert alert-success position-fixed top-50 start-50 translate-middle text-center" 
         style="z-index: 1050;">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div id="error-alert" class="alert alert-danger position-fixed top-50 start-50 translate-middle text-center" 
         style="z-index: 1050;">
        {{ session('error') }}
    </div>
@endif

@section('content') 
<div class="admin-header-container">
    <h1>Events Management</h1>
</div>

<div class="py-12">
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addEventModal">
        Add New Event
    </button>

    <!-- Event Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Location</th>
                <th>Image</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Map Location</th>
                <th>Website</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
            <tr>
                <td>{{ $event->id }}</td>
                <td>{{ $event->title }}</td>
                <td>{{ $event->description }}</td>
                <td>{{ $event->location }}</td>
                <td><img src="{{ $event->image }}" alt="Event Image" width="50"></td>
                <td>{{ $event->start_time }}</td>
                <td>{{ $event->end_time }}</td>
                <td><a href="{{ $event->map_location }}" target="_blank">View</a></td>
                <td><a href="{{ $event->website }}" target="_blank">Visit</a></td>
                <td>
                <button class="btn btn-warning btn-sm edit-event-btn"
                    data-id="{{ $event->id }}"
                    data-title="{{ $event->title }}"
                    data-description="{{ $event->description }}"
                    data-location="{{ $event->location }}"
                    data-image="{{ $event->image }}"
                    data-start-time="{{ $event->start_time }}"
                    data-end-time="{{ $event->end_time }}"
                    data-map-location="{{ $event->map_location }}"
                    data-website="{{ $event->website }}"
                    data-bs-toggle="modal"
                    data-bs-target="#editEventModal">
                    Edit
                </button>
                 <!-- Delete Button -->
                <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm delete-event-btn"
                        onclick="return confirm('Are you sure you want to delete this event?');">
                        Delete
                    </button>
                </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Include Add and Edit Event Modals -->
@include('admin.partials.add_event_modal')
@include('admin.partials.edit_event_modal')

@endsection

<script>
    document.addEventListener("DOMContentLoaded", function () {
        function fadeOutAlert(alertId) {
            let alertBox = document.getElementById(alertId);
            if (alertBox) {
                setTimeout(function () {
                    alertBox.style.transition = "opacity 0.5s ease";
                    alertBox.style.opacity = "0";
                    setTimeout(function () {
                        alertBox.style.display = "none";
                    }, 500);
                }, 3000);
            }
        }

        // Auto-hide success and error messages
        fadeOutAlert("success-alert");
        fadeOutAlert("error-alert");
    });
</script>

