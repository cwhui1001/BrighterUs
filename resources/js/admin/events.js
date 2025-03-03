document.addEventListener("DOMContentLoaded", function () {
    // Event Edit Modal Functionality
    document.querySelectorAll(".edit-event-btn").forEach(button => {
        button.addEventListener("click", function () {
            document.getElementById("editEventId").value = this.dataset.id;
            document.getElementById("editEventTitle").value = this.dataset.title;
            document.getElementById("editEventDescription").value = this.dataset.description;
            document.getElementById("editEventLocation").value = this.dataset.location;
            document.getElementById("editEventImage").value = this.dataset.image;
            document.getElementById("editEventStartTime").value = this.dataset.startTime;
            document.getElementById("editEventEndTime").value = this.dataset.endTime;
            document.getElementById("editEventMapLocation").value = this.dataset.mapLocation;
            document.getElementById("editEventWebsite").value = this.dataset.website;
        });
    });

    // Notification Bell Functionality
    const notificationBell = document.getElementById("notificationBell");
    const notificationDropdown = document.getElementById("notificationDropdown");

    if (notificationBell) {
        notificationBell.addEventListener("click", function () {
            fetch("/notifications")
                .then(response => response.json())
                .then(data => {
                    let notifications = "";
                    if (data.length > 0) {
                        data.forEach(notification => {
                            notifications += `
                                <li class="notification-item">
                                    <a href="#" class="notification-link" data-id="${notification.id}">
                                        ${notification.message}
                                    </a>
                                </li>`;
                        });
                    } else {
                        notifications = '<li class="notification-item">No new notifications</li>';
                    }

                    notificationDropdown.innerHTML = notifications;

                    // Mark as read when clicked
                    document.querySelectorAll(".notification-link").forEach(link => {
                        link.addEventListener("click", function () {
                            let notificationId = this.dataset.id;
                            fetch(`/notifications/${notificationId}/read`, { method: "POST" })
                                .then(() => this.parentElement.remove()); 
                        });
                    });
                });
        });
    }
});
