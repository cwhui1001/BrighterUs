
<x-app-layout>
    <x-slot name="header">
        <h2 class="custom-header">
            {{ __('Events') }}
        </h2>
    </x-slot>

    <!-- Main Content -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="custom-text">
                {{ __("Discover upcoming events tailored to help you explore further study opportunities and career paths") }}</div>



    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff5e5;
            margin: 0;
            padding: 0;
        }
        .custom-header {
            text-align: center;
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }
        .custom-text {
            text-align: center;
            font-size: 18px;
            color: #666;
            margin-bottom: 40px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto;
            background-color: white;
        }
        td {
            border: 2px solid #f4a41d;
            padding: 20px;
            vertical-align: top;
            
        }
        .column1 {
            text-align: center;
            position: relative;
            width: 25%;
        }
        .column1 img {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 30px;
            height: auto;
            cursor: pointer;
        }
        .date {
            font-size: 30px;
            font-weight: bold;
            color:rgb(48, 26, 1);
            margin: 40px 0;
        }
        .buttons {
            margin-top: 20px;
        }
        .button1 {
            display: block;
            background-color:rgb(216, 109, 56);
            color: white;
            border: none;
            border-radius: 5px;
            padding: 5px 15px;
            margin: 5px auto;
            cursor: pointer;
            font-size: 14px;
            width: 50%;
        }
        .button2 {
            display: block;
            background-color:rgb(217, 153, 55);
            color: white;
            border: none;
            border-radius: 5px;
            padding: 5px 15px;
            margin: 5px auto;
            cursor: pointer;
            font-size: 14px;
            width: 70%;
        }
        .button1:hover {
            background-color:rgb(167, 85, 44);
        }
        .button2:hover {
            background-color:rgb(166, 116, 42);
        }
        .column2 {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
           
        }
        .column2a img {
            width: 250px;
            height: 200px;
            margin-right: 20px;
        }
        .column2b img{
            width: 28px;
            height: auto;
            display: flex;
            flex-direction: column;
        }
        .time, .location {
            font-size: 16px;
            color: #666;
            display: flex;
            margin: 10px;
           
            align-items: flex-start;
        }
        .time img, .location img {
            margin-right: 10px;
        }
        .column3 {
            flex-direction: row;
            align-items: center;
            width: 30%;
        }

        /* Map Popup Container */
        .map-popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 80%; /* Adjust width as needed */
            max-width: 600px; /* Limit max width */
            height: 60%; /* Adjust height as needed */
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            z-index: 1000;
            display: none; /* Hidden by default */
            overflow: hidden;
            animation: fadeIn 0.3s ease-in-out;
        }

        /* Overlay Background */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999; /* Just below the popup */
            display: none;
        }

        /* Close Button */
        .map-popup .close-btn {
            position: absolute;
            top: 10px;
            left: 47%;
            background-color: #e74c3c;
            color: white;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            cursor: pointer;
            font-size: 18px;
            text-align: center;
            line-height: 40px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 1100; /* Higher than the popup */
            transition: all 0.3s ease-in-out;
        }

        .map-popup .close-btn:hover {
            background-color: #c0392b;
            transform: scale(1.1);
        }
        /* Map Container Inside Popup */
        #map-klcc {
            width: 100%;
            height: calc(100% - 60px); /* Leave space for the close button */
            border-top: 1px solid #f4f4f4;
            border-radius: 0 0 15px 15px;
        }
        /* Fade-in Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translate(-50%, -60%);
            }
            to {
                opacity: 1;
                transform: translate(-50%, -50%);
            }
        }

        /* Countdown Container Styling */
  /* Countdown Container */
  .countdown-container {
    text-align: center;
    margin-top: 30px;
    font-size: 12px; /* Make it smaller to fit */
  }

/* Event Title */
.event-title {
  font-size: 15px;
  font-weight: bold;
  margin-bottom: 5px;
}

/* Countdown Box Styling */
.countdown-box {
    display: flex;
    justify-content: space-between;
    gap: 5px;
    width: 90%;
  }

/* Individual Countdown Element */
.countdown-element {
    text-align: center;
    padding: 3px;
    border: 1px solid #ccc;
    border-radius: 10px;
    min-width: 50px; /* Smaller width */
    max-width: 100px;
    background-color: #fff5e5;
  }

/* Countdown Value Styling */
.countdown-value {
  font-size: 16px;
  font-weight: bold;
  display: block;
}

/* Countdown Label Styling */
.countdown-label {
  font-size: 10px;
  letter-spacing: 0.5px;
}

/* Responsive Design */
@media (max-width: 768px) {
  .countdown-box {
    flex-direction: column;
  }

  .countdown-element {
    margin-bottom: 5px;
  }
}

    </style>
    
            <table>
            <tr>
            <td class="column1">
                <img src="{{ asset('images/location2.jpg') }}" alt="Location icon 2" onclick="showMap('map-klcc', 'ChIJ__zTe9M3zDERtzz3V5s1Bnc')">
                <div class="date">11 > 12 JAN 2025</div>
                <div class="buttons">
                    <a href="https://malaysiaeducation.com.my/education-fair/education-fair-11-12-january-klcc/" target="_blank" class="button1">More Info</a>
                    <a 
                        href="https://calendar.google.com/calendar/render?action=TEMPLATE&text=Malaysia+Edu+Fair&dates=20250111T030000Z/20250112T100000Z&details=Join+us+for+this+exciting+event!&location=Kuala+Lumpur+Convention+Centre"
                        target="_blank" 
                        class="button2"
                    >
                        Add to Calendar
                    </a>
                </div>
                

                <div class="overlay" onclick="closeMap()"></div>
                <div class="map-popup" id="map-popup-klcc">
                    <button class="close-btn" onclick="closeMap()">X</button>
                    <div id="map-klcc" style="width: 100%; height: 100%;"></div>
                </div>
            </td>
            <td>
                <div class="column2">
                    <div class="column2a">
                        <img src="{{ asset('images/event1.jpg') }}" alt="Event 1">
                    </div>
                    <div class="column2b">
                        <div class="time">
                            <img src="{{ asset('images/clock.jpg') }}" alt="Clock icon">
                            11:00 AM - 6:00 PM
                        </div>
                        <div class="location">
                            <img src="{{ asset('images/location1.jpg') }}" alt="Location icon">
                            Kuala Lumpur KLCC Convention Centre (Hall 4)
                        </div>
                        <div class="countdown-container">
                        <h2 class="event-title">Event Countdown:</h2>
                        <div class="countdown-box" id="countdown-event1">
                            <div class="countdown-element">
                                <span id="days-event1" class="countdown-value">0</span>
                                <span class="countdown-label">Days</span>
                            </div>
                            <div class="countdown-element">
                                <span id="hours-event1" class="countdown-value">0</span>
                                <span class="countdown-label">Hours</span>
                            </div>
                            <div class="countdown-element">
                                <span id="minutes-event1" class="countdown-value">0</span>
                                <span class="countdown-label">Minutes</span>
                            </div>
                            <div class="countdown-element">
                                <span id="seconds-event1" class="countdown-value">0</span>
                                <span class="countdown-label">Seconds</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </td>
            <td class="column3">
                <div class="description">
                    <p>Connects prospective students with over <b>30 top universities and colleges</b>. Highlights include:</p>
                    <p>- Exploration of Programs</p>
                    <p>- Scholarship Information</p>
                    <p>- Workshops and Talks</p>
                    <p>- One-on-One Counseling</p>
                    <p>- Networking with industry experts</p>
                </div>
            </td>
        </tr>
        <tr>
            <td class="column1">
                <img src="{{ asset('images/location2.jpg') }}" alt="Location icon 2" onclick="showMap('map-pavilion', 'ChIJTUyeiypLzDER2lXiNNTIyN4')">
                <div class="date">11 > 12 JAN 2025</div>
                <div class="buttons">
                    <a href="https://fair.coursemap.my/registration/" target="_blank" class="button1">More Info</a>
                    <a 
                        href="https://calendar.google.com/calendar/render?action=TEMPLATE&text=CourseMap+Edu+Fair&dates=20250111T030000Z/20250112T100000Z&details=Join+us+for+this+exciting+event!&location=Pavillion+Bukit+Jalil"
                        target="_blank" 
                        class="button2"
                    >
                        Add to Calendar
                    </a>
                </div>

                <div class="overlay" onclick="closeMap()"></div>
                <div class="map-popup" id="map-popup-pavilion">
                    <button class="close-btn" onclick="closeMap()">X</button>
                    <div id="map-pavilion" style="width: 100%; height: 100%;"></div>
                </div>
            </td>
            <td>
                <div class="column2">
                    <div class="column2a">
                        <img src="{{ asset('images/event2.jpg') }}" alt="Event 2">
                    </div>
                    <div class="column2b">
                        <div class="time">
                            <img src="{{ asset('images/clock.jpg') }}" alt="Clock icon">
                            11:00 AM - 6:00 PM
                        </div>
                        <div class="location">
                            <img src="{{ asset('images/location1.jpg') }}" alt="Location icon">
                            Pavilion Exhibition Centre Bukit Jalil, Level 5, Pink Zone
                        </div>
                        <div class="countdown-container">
                        <h2 class="event-title">Event Countdown:</h2>
                        <div class="countdown-box" id="countdown-event2">
                            <div class="countdown-element">
                                <span id="days-event2" class="countdown-value">0</span>
                                <span class="countdown-label">Days</span>
                            </div>
                            <div class="countdown-element">
                                <span id="hours-event2" class="countdown-value">0</span>
                                <span class="countdown-label">Hours</span>
                            </div>
                            <div class="countdown-element">
                                <span id="minutes-event2" class="countdown-value">0</span>
                                <span class="countdown-label">Minutes</span>
                            </div>
                            <div class="countdown-element">
                                <span id="seconds-event2" class="countdown-value">0</span>
                                <span class="countdown-label">Seconds</span>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </td>
            <td class="column3">
                <div class="description">
                    <p>Explore <b>100 university courses</b>, meet representative from <b>60 top universities</b> and unlock exclusive scholarships. Get free course guidance, interest tests, and uni comparisons. Don’t miss cash prizes and perks!</p>
                </div>
            </td>
        </tr>   
      </table>
        </div>
    </div>
    <script>
    let maps = {};
    let initialMapStates = {};

    function showMap(mapId, placeId) {
        document.querySelector('.overlay').style.display = 'block';
        document.querySelector(`#${mapId}`).parentElement.style.display = 'block';

        // Check if the map is already initialized
        if (!maps[mapId]) {
            // Default initial center and zoom
            const initialCenter = { lat: 3.15389, lng: 101.71344 }; // KLCC as default
            const initialZoom = 15;

            // Initialize the map
            maps[mapId] = new google.maps.Map(document.getElementById(mapId), {
                center: initialCenter,
                zoom: initialZoom,
            });

            // Store the initial state
            initialMapStates[mapId] = { center: initialCenter, zoom: initialZoom };

            const request = {
                placeId: placeId,
                fields: ['name', 'geometry'],
            };

            const service = new google.maps.places.PlacesService(maps[mapId]);
            service.getDetails(request, (place, status) => {
                if (status === google.maps.places.PlacesServiceStatus.OK) {
                    new google.maps.Marker({
                        map: maps[mapId],
                        position: place.geometry.location,
                        title: place.name,
                    });
                    maps[mapId].setCenter(place.geometry.location);
                    // Update initial center with the place location
                    initialMapStates[mapId].center = place.geometry.location;
                } else {
                    console.error(`Error fetching place details: ${status}`);
                }
            });
        } else {
            // Reset the map to its initial state
            maps[mapId].setCenter(initialMapStates[mapId].center);
            maps[mapId].setZoom(initialMapStates[mapId].zoom);
        }
    }

    function closeMap() {
        document.querySelector('.overlay').style.display = 'none';
        document.querySelectorAll('.map-popup').forEach((popup) => (popup.style.display = 'none'));
    }


    // Event Dates
const eventDates = {
    event1: new Date('2025-01-11T11:00:00').getTime(),
    event2: new Date('2025-01-15T11:00:00').getTime(),
};

// Countdown Function
function updateCountdown(eventId, eventDate) {
    const now = new Date().getTime();
    const distance = eventDate - now;

    if (distance < 0) {
        document.querySelector(`#countdown-${eventId}`).innerHTML = '<h2>Event has started!</h2>';
        return;
    }

    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

    document.getElementById(`days-${eventId}`).innerText = days;
    document.getElementById(`hours-${eventId}`).innerText = hours;
    document.getElementById(`minutes-${eventId}`).innerText = minutes;
    document.getElementById(`seconds-${eventId}`).innerText = seconds;
}

// Initialize Countdown Timers
function startCountdowns() {
    setInterval(() => updateCountdown('event1', eventDates.event1), 1000);
    setInterval(() => updateCountdown('event2', eventDates.event2), 1000);
}

startCountdowns();
</script>

<script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDOe_idazATrc44GZA3Gogc117S1tJuq5I&libraries=places&callback=initMap">
</script>

</x-app-layout>
