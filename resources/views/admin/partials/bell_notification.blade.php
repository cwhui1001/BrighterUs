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

        <button class="btn position-relative tooltip-container" id="notificationBell" data-url="{{ route('login') }}" >
            <i class="far fa-bell bell-icon"></i>
            <span class="tooltip">Login to view notifications</span>
        </button>
@endif

<style>
    .tooltip-button {
    position: relative;
    display: inline-block;
}

.tooltip-text {
    visibility: hidden;
    width: 160px;
    background-color: #333;
    color: #fff;
    text-align: center;
    border-radius: 4px;
    padding: 5px;
    position: absolute;
    z-index: 1;
    top: 125%; /* Position below the button */
    left: 50%;
    margin-left: -80px; /* Center the tooltip */
    opacity: 0;
    transition: opacity 0.3s;
}

.tooltip-text::after {
    content: "";
    position: absolute;
    bottom: 100%; /* Arrow positioned above the tooltip */
    left: 50%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: transparent transparent #333 transparent; /* Arrow pointing upwards */
}

.tooltip-button:hover .tooltip-text {
    visibility: visible;
    opacity: 1;
}
</style>


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
