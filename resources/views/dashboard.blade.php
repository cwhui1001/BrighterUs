<x-app-layout>
    <x-slot name="header" class="dash-header relative bg-orange-400">
        
        <div class="container">
            <div>
                <h2 class="dashboard-header">
                    <div class="title">{{ __('BrighterUs') }}</div><br>
                </h2>
                <div class="title-content">Every step you take today shapes the path to a brighter and more fulfilling tomorrow.</div>
                <div class="title-content">At BrighterUs, we believe that each small action builds the foundation for a future full of endless possibilities.</div><br>
            </div>
            <div class="circle-frame">
                <img src="{{ asset('images/tertiaryeducation.jpg') }}" alt="Circular Image">
            </div>
        </div>
        
        <!-- Add the wavy bottom -->
        <div class="wavy-bottom">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 230">
                <path fill="#ffffff" fill-opacity="1" d="M0,224L80,202.7C160,181,320,139,480,144C640,149,800,203,960,208C1120,213,1280,171,1360,149.3L1440,128L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"></path>
            </svg>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
           
                @if (Auth::check())
                <div class="custom-text">
                    <p>{{ __("You are logged in!") }}</p>
                    <!-- Display features available to logged-in users -->
                    
                </div>
                @else
                <div class="custom-text">
                    <p>{{ __("You are not logged in.") }}</p>
                    <!-- Provide login options or guest-specific content -->
                    <a href="{{ route('login') }}" class="btn btn-primary">Log In</a>
                    <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
                </div>
                @endif
        </div>
    </div>
</x-app-layout>
