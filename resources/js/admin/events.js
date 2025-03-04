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

});
