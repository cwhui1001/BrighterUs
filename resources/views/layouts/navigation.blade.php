@vite(['resources/css/nav.css', 'resources/js/nav.js','resources/css/notification.css'])
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<nav x-data="{ open: false }">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('images/logo-brighterus2.png') }}" alt="BrighterUs Logo" class="h-20 w-auto">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex items-center">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Home') }}
                    </x-nav-link>
                    <x-nav-link :href="route('courses.index')" :active="request()->routeIs('courses.index')">
                        {{ __('Courses & Universities') }}
                    </x-nav-link>
                    <x-nav-link :href="route('events')" :active="request()->routeIs('events')">
                        {{ __('Events') }}
                    </x-nav-link>
                    <div class="relative inline-block">
                        <!-- Dropdown Button -->
                        <x-nav-link href="#" id="financialAidDropdownButton" class="dropdown-toggle" :active="request()->routeIs('financial.*')">
                            {{ __('Financial Aid') }}
                        </x-nav-link>
                        
                        <!-- Dropdown Menu -->
                        <div
                            id="financialAidDropdownMenu"
                            class="absolute hidden bg-white shadow-lg rounded-md mt-1 p-2 z-50 left-0 top-full w-48"
                        >
                            <x-nav-link :href="route('financial.need-based')" :active="request()->routeIs('financial.need-based')">
                                Need-Based Scholarship
                            </x-nav-link>
                            <x-nav-link :href="route('financial.external')" :active="request()->routeIs('financial.external')">
                                External Sponsorship
                            </x-nav-link>
                            <x-nav-link :href="route('financial.loan')" :active="request()->routeIs('financial.loan')">
                                Study Loan
                            </x-nav-link>
                        </div>
                    </div>

                    <x-nav-link :href="route('career')" :active="request()->routeIs('career')">
                        {{ __('Career Match') }}
                    </x-nav-link>
                    
                </div>

            </div>

            <!-- Check if user is authenticated -->
            <div class="flex items-center justify-center sm:ms-6">

    
            <!-- Bookmark Button -->
            <button class="tooltip-container bookmark-button {{ request()->routeIs('bookmarks.index') ? 'active' : '' }}" data-url="{{ route('bookmarks.index') }}">
                <i class="far fa-bookmark"></i>
                <i class="fas fa-bookmark"></i>
                @if (!Auth::check())
                    <span class="tooltip">Login to view bookmarks</span>
                @endif
            </button>

            <div style="margin-right: 25px;">
                @include('admin.partials.bell_notification')
            </div>
                @if (Auth::check())
                    <!-- Logged-in User Dropdown -->
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border-transparent text-sm leading-4 font-medium rounded-md text-black-500 hover:text-white focus:text-white focus:outline-none transition ease-in-out duration-150">
                                {{ Auth::user()->name }} <!-- Display User's Name -->
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <!-- Non-Logged-in User Links -->
                    <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 hover:text-white-900">
                        {{ __('Log In') }}
                    </a>
                    <a href="{{ route('register') }}" class="ml-4 text-sm font-medium text-gray-700 hover:text-white-900">
                        {{ __('Register') }}
                    </a>
                @endif
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-orange-200">
            @if (Auth::check())
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('login')">
                        {{ __('Log In') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')">
                        {{ __('Register') }}
                    </x-responsive-nav-link>
                </div>
            @endif
        </div>
    </div>
</nav>
