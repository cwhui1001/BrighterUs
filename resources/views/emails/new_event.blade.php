<!DOCTYPE html>
<html>
<head>
    <title>You're Invited: {{ $event->title }}</title>
    <style>
        body {
            font-family: "Gill Sans", sans-serif;
            color: #333333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            background:rgb(255, 255, 255);
            margin: auto;
            padding: 25px;
            border-radius: 12px;
            text-align: center;
        }
        .header {
            background: linear-gradient(90deg, #FF8C00,rgb(248, 202, 0));
            padding: 20px;
            border-radius: 12px 12px 0 0;
            color: white;
            font-size: 26px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            
        }
        .event-title {
            font-size: 28px;
            font-weight: bold;
            color:rgb(217, 101, 6);
            margin: 20px 0;
        }

        .event-description {
            font-size: 17px;
            color: #555555;
            margin-bottom: 25px;
            padding: 0 20px;
            line-height: 1.5;
        }
        .details {
            text-align: left;
            padding: 20px;
            background:rgb(255, 251, 243);
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .details p {
            font-size: 16px;
            margin: 12px 0;
        }
        .details strong {
            color: #D97706;
        }
        .button {
            display: inline-block;
            padding: 14px 22px;
            background:rgb(255, 215, 55);
            color:rgb(255, 255, 255);
            font-weight: bold;
            border-radius: 6px;
            margin: 20px 10px;
            font-size: 16px;
        }
        .button:hover {
            background:rgb(238, 202, 59);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .image-container {
            margin-top: 20px;
            text-align: center;
        }
        img {
            max-width: 100%;
            border-radius: 6px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .footer {
            background: linear-gradient(90deg, #FF8C00,rgb(248, 202, 0));
            padding: 14px;
            border-radius: 0 0 12px 12px;
            color: white;
            margin-top: 20px;
            font-size: 14px;
            text-align: center;
        }
        .footer a {
            color:rgb(61, 61, 61);
            text-decoration: none;
            font-weight: bold;
        }
        .social-icons {
            margin: 20px 0;
        }
        .social-icons a {
            display: inline-block;
            margin: 0 8px;
        }
        .social-icons img {
            width: 32px;
            height: 32px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            BrighterUs
        </div>

        <!-- Event Title -->
        <h2 class="event-title">🚀 {{ $event->title }}</h2>

        <!-- Event Description -->
        <p class="event-description">{{ $event->description }}</p>

        <!-- Event Details -->
        <div class="details">
            <p><strong>📍 Location:</strong> {{ $event->location }}</p>
            <p><strong>📅 Date:</strong> {{ \Carbon\Carbon::parse($event->start_time)->format('F j, Y') }} -  {{ \Carbon\Carbon::parse($event->end_time)->format('F j, Y') }}</p>
            <p><strong>⏰ Time:</strong> {{ \Carbon\Carbon::parse($event->start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($event->end_time)->format('g:i A') }}</p>
            <p><strong>🗺 Map:</strong> <a href="https://maps.google.com/?q={{ $event->location }}" target="_blank">View Location</a></p>
            <p><strong>🌐 Website:</strong> <a href="{{ $event->website }}" target="_blank">Visit Event Page</a></p>
        </div>

        <!-- Call-to-Action Buttons -->
        <a href="https://calendar.google.com/calendar/render?action=TEMPLATE&text={{ urlencode($event->title) }}&dates={{ \Carbon\Carbon::parse($event->start_time)->utc()->format('Ymd\THis\Z') }}/{{ \Carbon\Carbon::parse($event->end_time)->utc()->format('Ymd\THis\Z') }}&details={{ urlencode($event->description) }}&location={{ urlencode($event->location) }}" class="button">📅   Add to Calendar</a>

        <!-- Event Image -->
        @if($event->image)
        <div class="image-container">
            <img src="{{ $event->image }}" alt="Event Image">
        </div>
        @endif

        <!-- Social Media Links -->
        <div class="social-icons">
            <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" alt="Facebook"></a>
            <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/733/733579.png" alt="Twitter"></a>
            <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/733/733558.png" alt="Instagram"></a>
            <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/733/733585.png" alt="LinkedIn"></a>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p> Contact us at <a href="mailto:support@brighterus.com">support@brighterus.com</a></p>
            <p>BrighterUs | Sunway University No. 5, Jalan Universiti, Bandar Sunway, 47500 Selangor Darul Ehsan Malaysia</p>
        </div>
    </div>
</body>
</html>