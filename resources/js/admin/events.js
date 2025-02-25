document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".edit-event-btn").forEach(button => {
        button.addEventListener("click", function () {
            let eventId = this.getAttribute("data-id");
            let title = this.getAttribute("data-title");
            let description = this.getAttribute("data-description");
            let location = this.getAttribute("data-location");
            let image = this.getAttribute("data-image");
            let startTime = this.getAttribute("data-start-time");
            let endTime = this.getAttribute("data-end-time");
            let mapLocation = this.getAttribute("data-map-location");
            let website = this.getAttribute("data-website");

            document.getElementById("editEventId").value = eventId;
            document.getElementById("editEventTitle").value = title;
            document.getElementById("editEventDescription").value = description;
            document.getElementById("editEventLocation").value = location;
            document.getElementById("editEventImage").value = image;
            document.getElementById("editEventStartTime").value = startTime;
            document.getElementById("editEventEndTime").value = endTime;
            document.getElementById("editEventMapLocation").value = mapLocation;
            document.getElementById("editEventWebsite").value = website;

            // Set form action dynamically
            document.getElementById("editEventForm").action = `/admin/events/${eventId}`;
        });
    });
});
