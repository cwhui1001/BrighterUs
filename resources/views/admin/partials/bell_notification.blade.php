@if(Auth::check())
    <div class="dropdown">
        <!-- Notification Button -->
        <button class="btn position-relative" id="notificationBell" data-bs-toggle="dropdown" aria-expanded="false">
            🔔
            @if(auth()->user()->unreadNotifications->count() > 0)
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ auth()->user()->unreadNotifications->count() }}
                </span>
            @endif
        </button>

        <!-- Notification Dropdown -->
        <ul class="dropdown-menu dropdown-menu-end" id="notificationDropdown">
            @foreach(auth()->user()->unreadNotifications as $notification)
            <a href="{{ route('events') }}" class="event-link">
            <li class="p-3 border-bottom">
                    <strong>New Event Updated!</strong>
                        <p class="mb-1 fw-bold">{{ $notification->data['title'] }}</p>
                    </a>
                    <small class="text-muted d-block">{{ \Carbon\Carbon::parse($notification->data['start_time'])->format('Y-m-d H:i A') }}</small>
                    <button class="mark-as-read btn btn-sm btn-primary mt-2" data-id="{{ $notification->id }}">✔ Mark as Read</button>
                </li>
            @endforeach

            @if(auth()->user()->unreadNotifications->isEmpty())
                <li class="text-center text-muted p-3">No new notifications</li>
            @endif
        </ul>
    </div>
@else
    <button class="btn btn-light" onclick="window.location.href='{{ route('login') }}'"><a href="{{ route('login') }}" >
        🔔 Login to view notifications
    </button>
@endif


<!-- JavaScript for Toggle Functionality -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let bellButton = document.getElementById("notificationBell");
        let dropdownMenu = document.getElementById("notificationDropdown");

        bellButton.addEventListener("click", function (event) {
            event.stopPropagation(); // Prevent closing when clicking inside
            dropdownMenu.style.display = dropdownMenu.style.display === "none" ? "block" : "none";
        });

        // Close the dropdown when clicking outside
        document.addEventListener("click", function (event) {
            if (!bellButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.style.display = "none";
            }
        });
    });
</script>