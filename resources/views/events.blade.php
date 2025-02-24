@vite(['resources/css/events.css', 'resources/js/events.js'])


<x-app-layout>
    <x-slot name="header">
        <h2 class="custom-header">{{ __('Events') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="custom-text">
                {{ __("Discover upcoming events tailored to help you explore further study opportunities and career paths") }}
            </div>

            <table>
                @foreach($events as $event)
                <tr>
                    <td class="column1">
                        <img src="{{ asset('images/location2.jpg') }}" alt="Location icon" onclick="showMap('map-{{ $event->id }}', '{{ $event->map_location }}')">
                        <div class="date">{{ \Carbon\Carbon::parse($event->start_time)->format('d M Y') }} > {{ \Carbon\Carbon::parse($event->end_time)->format('d M Y') }}</div>
                        <div class="buttons">
                        <a href="{{ $event->website }}" target="_blank" class="button1">More Info</a>

                            <a href="https://calendar.google.com/calendar/render?action=TEMPLATE&text={{ urlencode($event->title) }}&dates={{ \Carbon\Carbon::parse($event->start_time)->utc()->format('Ymd\THis\Z') }}/{{ \Carbon\Carbon::parse($event->end_time)->utc()->format('Ymd\THis\Z') }}&details={{ urlencode($event->description) }}&location={{ urlencode($event->location) }}" target="_blank" class="button2">
                                Add to Calendar
                            </a>
                        </div>

                        <div class="overlay" onclick="closeMap()"></div>
                        <div class="map-popup" id="map-popup-{{ $event->id }}">
                            <button class="close-btn" onclick="closeMap()">X</button>
                            <div id="map-{{ $event->id }}" style="width: 100%; height: 100%;"></div>
                        </div>
                    </td>
                    <td class="column2">
                        <div class="column2a">
                        <img src="{{ Str::startsWith($event->image, 'http') ? $event->image : asset('storage/' . $event->image) }}" alt="{{ $event->title }}">
                        </div>
                        <div class="column2b">
                            <div class="time">
                                <img src="{{ asset('images/clock.jpg') }}" alt="Clock icon">
                                {{ \Carbon\Carbon::parse($event->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($event->end_time)->format('h:i A') }}
                            </div>
                            <div class="location">
                                <img src="{{ asset('images/location1.jpg') }}" alt="Location icon">
                                {{ $event->location }}
                            </div>
                            <div class="countdown-container">
                                <h2 class="event-title">Event Countdown:</h2>
                                <div class="countdown-box" id="countdown-{{ $event->id }}"></div>
                            </div>
                            </div>
                        </div>
                    </td>
                    <td class="column3">
                        <div class="description">
                            {!! $event->description !!}
                        </div>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDOe_idazATrc44GZA3Gogc117S1tJuq5I&libraries=places&callback=initMap"></script>

</x-app-layout>

 