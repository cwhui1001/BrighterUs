@vite(['resources/css/admin/dashboard.css', 'resources/js/admin/dashboard.js'])
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

@extends('layouts.admin')

@section('content')
<div class="admin-header-container text-center">
    <h1 class="admin-title">Admin Dashboard</h1>
    <p class="admin-subtitle">Welcome, <span class="fw-bold">{{ auth()->user()->name }}</span>!</p>
</div>

<div class="container py-4">
    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8" style="max-width: 700px;">
            <div class="card shadow-lg border-0" style="border-radius: 15px;">
                <!-- <div class="card-header text-white text-center">
                    <h3 class="mb-0">Your Account Details</h3>
                </div> -->
                <div class="card-body text-center">
                    <!-- Profile Picture Upload -->
                    @php
                        $filename = 'profile_photos/user_' . Auth::id() . '.jpg';
                        $photoPath = 'storage/' . $filename;
                        if (!file_exists(public_path($photoPath))) {
                            $photoPath = 'images/default-profile.png';
                        }
                    @endphp

                    <div class="profile-picture-container">
                        <!-- Profile Picture -->
                        <img src="{{ asset($photoPath) }}" alt="Profile Picture" 
                            class="img-thumbnail mb-3" style="width: 120px; height: 150px; object-fit: cover;">

                        <!-- Upload Form -->
                        <form action="{{ route('admin.updateProfilePhoto') }}" method="POST" enctype="multipart/form-data" class="mb-3">
                            @csrf
                            <input type="file" name="profile_photo" class="form-control mb-2"  required>
                            <button type="submit" class="btn btn-primary">Upload / Update Photo</button>
                        </form>
                    
                    </div>
                    <div class="profile-picture-container">
                        <ul class="list-unstyled mt-3">
                            <li><strong>Name:</strong> {{ auth()->user()->name }}</li>
                            <li><strong>Email:</strong> {{ auth()->user()->email }}</li>
                            <li><strong>Role:</strong> {{ auth()->user()->role }}</li>
                        </ul>

                        <div class="dashboard-actions mt-4">
                            <a href="{{ route('admin.users') }}" class="btn btn-outline-primary me-2">
                                Manage Users
                            </a>
                            <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="btn btn-outline-danger">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
