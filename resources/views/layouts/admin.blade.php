<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- Include CSS and JS files -->
    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

</head>
<body>
<div class="sidebar" id="sidebar">
    <button class="toggle-btn" id="toggle-btn">
        <i class="fas fa-bars"></i>  <span class="nav-text">BrighterUs</span>
    </button>
    <ul class="nav-list">
        <li>
            <a href="{{ route('admin.dashboard') }}">
                <i class="fas fa-home"></i> <span class="nav-text">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.users') }}">
                <i class="fas fa-users"></i> <span class="nav-text">Users</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.courses') }}">
                <i class="fas fa-book"></i> <span class="nav-text">Courses</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.events') }}">
                <i class="fas fa-calendar"></i> <span class="nav-text">Events</span>
            </a>
        </li>
        <li>
            <form class="admin-logout" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">
                    <i class="fas fa-sign-out-alt"></i> <span class="nav-text">Logout</span>
                </button>
            </form>
        </li>
    </ul>
</div>

<!-- Main Content -->
<div class="main-content">
    @yield('content')
</div>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>