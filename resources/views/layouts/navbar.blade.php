@vite(['resources/css/nav.css', 'resources/js/nav.js'])

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">BrighterUs</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <!-- Home Page -->
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Home</a>
                </li>

                <!-- Event Page (Accessible to both logged-in and not logged-in users) -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/events') }}">Events</a>
                </li>

                <!-- Universities Page -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/universities') }}">Universities</a>
                </li>

                <!-- Financial Page -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="financialAidDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Financial Aid
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="financialAidDropdown">
                        <li><a class="dropdown-item" href="{{ route('financial.need-based') }}">Need-Based Scholarship</a></li>
                        <li><a class="dropdown-item" href="{{ route('financial.external') }}">External Sponsorship</a></li>
                        <li><a class="dropdown-item" href="{{ route('financial.loan') }}">Study Loan</a></li>
                    </ul>
                </li>

                <!-- Career Page -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/career') }}">Career</a>
                </li>

                @auth
                    <!-- For Logged-in Users, show the user icon with a dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i> <!-- You can use a user icon -->
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Edit Profile</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button class="dropdown-item" type="submit">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <!-- For Not Logged-in Users, show Login and Register buttons -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
