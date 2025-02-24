<!-- Add Course Modal -->
<div id="addCourseModal" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Course</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.courses.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Category ID:</label>
                        <input type="number" name="category_id" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Course Name:</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Field ID:</label>
                        <input type="number" name="field_id" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>University ID:</label>
                        <input type="number" name="university_id" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Location ID:</label>
                        <input type="number" name="location_id" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Budget:</label>
                        <input type="number" name="budget" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Ranking ID:</label>
                        <input type="number" name="ranking_id" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Description:</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Course Link:</label>
                        <input type="text" name="link" class="form-control" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Course</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
