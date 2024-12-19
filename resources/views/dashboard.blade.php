<x-app-layout>
    <x-slot name="header">
        <h2 class="custom-header">
            {{ __('BrighterUs') }}
        </h2>
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
