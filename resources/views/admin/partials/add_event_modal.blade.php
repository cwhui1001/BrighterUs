<!-- Add Event Modal -->
<div id="addEventModal" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.events.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Title:</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Description:</label>
                        <textarea name="description" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Location:</label>
                        <input type="text" name="location" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Image URL:</label>
                        <input type="url" name="image" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Start Time:</label>
                        <input type="datetime-local" name="start_time" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>End Time:</label>
                        <input type="datetime-local" name="end_time" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Map Location:</label>
                        <input type="text" name="map_location" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Website:</label>
                        <input type="url" name="website" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Event</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
