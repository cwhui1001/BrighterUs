@if(Auth::check())
    <div class="dropdown">
        <!-- Notification Button -->
        <button class="btn position-relative" id="notificationBell" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="far fa-bell bell-icon"></i>
            @if(auth()->user()->unreadNotifications->count() > 0)
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ auth()->user()->unreadNotifications->count() }}
                </span>
            @endif
        </button>

        <!-- Notification Dropdown -->
        <ul class="dropdown-menu dropdown-menu-end" id="notificationDropdown">
        @foreach(auth()->user()->unreadNotifications->sortByDesc('created_at') as $notification)
        <li class="p-3 border-bottom">
            <a href="{{ route('events') }}" class="event-link">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('images/notification-logo.png') }}" alt="Event Logo" class="me-2" style="width: 20px; height: 20px;">
                        <strong class="mb-0">New Event Updated!</strong>
                    </div>
                        <p class="mb-1 fw-bold">{{ $notification->data['title'] }}</p>
                    </div>
                    <small class="notification-time text-muted">{{ \Carbon\Carbon::parse($notification->data['start_time'])->format('Y-m-d H:i A') }}</small>
                </div>
            </a>
            <button class="mark-as-read btn btn-sm btn-primary mt-2" data-id="{{ $notification->id }}">✔ Mark as Read</button>
        </li>
    @endforeach

            @if(auth()->user()->unreadNotifications->isEmpty())
                <li class="text-center text-muted p-3">No new notifications</li>
            @endif
        </ul>
    </div>
@else

        <button class="btn position-relative tooltip-container" id="notificationBell" data-url="{{ route('login') }}" >
            <i class="far fa-bell bell-icon"></i>
            <span class="tooltip">Login to view notifications</span>
        </button>
@endif

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

    document.addEventListener('DOMContentLoaded', function () {
    const button = document.getElementById('notificationBell');
    if (button && button.hasAttribute('data-url')) {
        button.addEventListener('click', function (event) {
            // Prevent the dropdown from toggling if the user is not authenticated
            if (!button.hasAttribute('data-bs-toggle')) {
                window.location.href = button.getAttribute('data-url');
            }
        });
    }

        // Attach event listeners to all 'Mark as Read' buttons
        document.querySelectorAll(".mark-as-read").forEach(button => {
            button.addEventListener("click", function () {
                let notificationId = this.getAttribute("data-id");
                let notificationItem = this.closest("li"); // Get the notification item

                fetch("{{ url('/notifications/mark-as-read/') }}/" + notificationId, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                        "Content-Type": "application/json",
                    }
                }).then(response => {
                    if (response.ok) {
                        notificationItem.style.backgroundColor ="#ffffff"; // Light red
                        notificationItem.style.transition = "background-color 0.5s ease-in-out";
                        this.remove(); // Remove the button after marking as read
                    } else {
                        console.error("Failed to mark as read");
                    }
                }).catch(error => console.error("Error:", error));
            });
        });
});
</script>

<style>
    .dropdown {
        margin: 0 !important;
    }

    #notificationBell{
        margin-bottom: 0;
    }
</style>