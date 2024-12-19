<nav>
    @if (Auth::check())
        <!-- Logged-in User -->
        <div class="profile-menu">
            <img src="{{ Auth::user()->profile_picture }}" alt="Profile Picture" class="profile-pic">
            <div class="dropdown">
                <a href="{{ route('profile.edit') }}">Edit Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Log Out</button>
                </form>
            </div>
        </div>
    @else
        <!-- Guest User -->
        <a href="{{ route('login') }}">Log In</a>
        <a href="{{ route('register') }}">Register</a>
    @endif
</nav>
