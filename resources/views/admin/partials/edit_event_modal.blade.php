<!-- Edit Event Modal -->
<div id="editEventModal" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="editEventForm" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="editEventId">

                    
                    <div class="form-group">
                        <label>Title:</label>
                        <input type="text" name="title" id="editEventTitle" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Description:</label>
                        <textarea name="description" id="editEventDescription" class="form-control" rows="4" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Location:</label>
                        <input type="text" name="location" id="editEventLocation" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Image URL:</label>
                        <input type="url" name="image" id="editEventImage" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Start Time:</label>
                        <input type="datetime-local" name="start_time" id="editEventStartTime" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>End Time:</label>
                        <input type="datetime-local" name="end_time" id="editEventEndTime" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Map Location:</label>
                        <input type="text" name="map_location" id="editEventMapLocation" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Website:</label>
                        <input type="url" name="website" id="editEventWebsite" class="form-control" required>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Event</button>
                    </div>
                </form>
                <script>
document.addEventListener('DOMContentLoaded', function() {
    let editButtons = document.querySelectorAll('.edit-event-btn');
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            let eventId = this.getAttribute('data-id');
            let title = this.getAttribute('data-title');
            let description = this.getAttribute('data-description');
            let location = this.getAttribute('data-location');
            let image = this.getAttribute('data-image');
            let startTime = this.getAttribute('data-start-time');
            let endTime = this.getAttribute('data-end-time');
            let mapLocation = this.getAttribute('data-map-location');
            let website = this.getAttribute('data-website');

            document.getElementById('editEventId').value = eventId;
            document.getElementById('editEventTitle').value = title;
            document.getElementById('editEventDescription').value = description;
            document.getElementById('editEventLocation').value = location;
            document.getElementById('editEventImage').value = image;
            document.getElementById('editEventStartTime').value = startTime;
            document.getElementById('editEventEndTime').value = endTime;
            document.getElementById('editEventMapLocation').value = mapLocation;
            document.getElementById('editEventWebsite').value = website;

            document.getElementById('editEventForm').action = `events/${eventId}`;
        });
    });
});
</script>

            </div>
        </div>
    </div>
</div>
