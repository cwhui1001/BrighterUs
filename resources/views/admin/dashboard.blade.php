@vite(['resources/css/admin/dashboard.css', 'resources/js/admin/dashboard.js'])
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>


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

    
    <div class="row">
    <div class="col-md-3">
        <div class="card custom-card text-white mb-3 shadow card-user">
            <div class="card-header d-flex align-items-center">
                <i class="fas fa-users me-2"></i> <span>Total Users</span>
            </div>
            <div class="card-body text-center">
                <h2 class="display-4 fw-bold">{{ $totalUsers }}</h2>
                <p class="card-text">Registered users</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card custom-card text-white mb-3 shadow card-courses">
            <div class="card-header d-flex align-items-center">
                <i class="fas fa-book me-2"></i> <span>Total Courses</span>
            </div>
            <div class="card-body text-center">
                <h2 class="display-4 fw-bold">{{ $totalCourses }}</h2>
                <p class="card-text">Courses available</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card custom-card text-white mb-3 shadow card-events">
            <div class="card-header d-flex align-items-center">
                <i class="fas fa-calendar-alt me-2"></i> <span>Total Events</span>
            </div>
            <div class="card-body text-center">
                <h2 class="display-4 fw-bold">{{ $totalEvents }}</h2>
                <p class="card-text">Upcoming events</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card custom-card text-white mb-3 shadow card-financialaid">
            <div class="card-header d-flex align-items-center">
                <i class="fas fa-hand-holding-usd me-2"></i> <span>Total Financial Aid</span>
            </div>
            <div class="card-body text-center">
                <h2 class="display-4 fw-bold">{{ $totalFinancialAid }}</h2>
                <p class="card-text">Available financial aid</p>
            </div>
        </div>
    </div>

</div>


<div class="chart-container py-4">
    <div class="row">
        <div class="col-md-6">
            <div class="graph-container">
                <canvas id="userChart"></canvas>
            </div>
        </div>
        <div class="col-md-6">
            <div class="graph-container">
                <canvas id="courseChart"></canvas>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        const userData = JSON.parse(`{!! json_encode($userData) !!}`);
        const courseData = JSON.parse(`{!! json_encode($courseData) !!}`);
        const eventData = JSON.parse(`{!! json_encode($eventData) !!}`);

        function prepareChartData(data) {
            return {
                labels: data.map(item => item.date),
                values: data.map(item => item.count)
            };
        }

        const userChartData = prepareChartData(userData);
        const courseChartData = prepareChartData(courseData);
        const eventChartData = prepareChartData(eventData);

        new Chart(document.getElementById('userChart'), {
            type: 'bar',
            data: {
                labels: userChartData.labels,
                datasets: [{
                    label: 'Users',
                    data: userChartData.values,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            }
        });

        const groupedData = {};

        // Organize data by university
        courseData.forEach(item => {
            groupedData[item.university_id] = { name: item.university, count: item.count };
        });

        const universityIDs = Object.keys(groupedData); // University IDs
        const universityCounts = universityIDs.map(id => groupedData[id].count); // Course counts
        const universityNames = universityIDs.map(id => groupedData[id].name); 

        const dataset = [{
            label: "Number of Courses",
            data: universityCounts, // Array of counts matching university IDs
            backgroundColor: universityIDs.map(() => getRandomColor()), // Generate colors dynamically
        }];

        new Chart(document.getElementById('courseChart'), {
            type: 'bar',
            data: {
                labels: universityIDs, // Keep University IDs on x-axis
                datasets: dataset
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { 
                        display: true, // Show legend
                        labels: {
                            
                            generateLabels: function(chart) {
                                return universityIDs.map((id, index) => ({
                                    text: universityNames[index], // Use university names in legend
                                    fillStyle: dataset[0].backgroundColor[index], // Match bar colors
                                    strokeStyle: dataset[0].backgroundColor[index], // Match border color to the bar color
                                    hidden: false,
                                    lineWidth: 1,
                                }));
                            }
                        }
                    }, 
                    tooltip: {
                        callbacks: {
                            title: function(tooltipItems) {
                                const id = tooltipItems[0].label; 
                                return groupedData[id].name; // Show university name in tooltip
                            },
                            label: function(tooltipItem) {
                                return `Courses: ${tooltipItem.raw}`;
                            }
                        }
                    }
                },
                scales: {
                    x: { 
                        title: { display: true, text: 'University ID' } // Keep University ID on x-axis
                    },
                    y: { 
                        title: { display: true, text: 'Number of Courses' }, 
                        beginAtZero: true 
                    }
                }
            }
        });

        function getRandomColor() {
            return `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 0.5)`;
        }

        // new Chart(document.getElementById('eventChart'), {
        //     type: 'pie',
        //     data: {
        //         labels: eventChartData.labels,
        //         datasets: [{
        //             label: 'Events',
        //             data: eventChartData.values,
        //             backgroundColor: ['red', 'blue', 'green', 'yellow', 'purple']
        //         }]
        //     }
        // });
    });
</script>

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
