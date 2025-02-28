<div id="editCourseModal" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 600px">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Course</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="editCourseForm" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="editCourseId">

                    <div class="form-group">
                        <label>Category:</label>
                        <input type="text" id="editCategoryName" class="form-control" readonly>
                        <input type="hidden" name="category_id" id="editCategoryId">
                    </div>

                    <div class="form-group">
                        <label>Course Name:</label>
                        <input type="text" name="name" id="editCourseName" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Field:</label>
                        <input type="text" id="editFieldName" class="form-control" readonly>
                        <input type="hidden" name="field_id" id="editFieldId">
                    </div>

                    <div class="form-group">
                        <label>University:</label>
                        <input type="text" id="editUniversityName" class="form-control" readonly>
                        <input type="hidden" name="university_id" id="editUniversityId">
                    </div>

                    <div class="form-group">
                        <label>Location:</label>
                        <input type="text" id="editLocationName" class="form-control" readonly>
                        <input type="hidden" name="location_id" id="editLocationId">
                    </div>

                    <div class="form-group">
                        <label>Budget:</label>
                        <input type="number" name="budget" id="editBudget" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Ranking:</label>
                        <input type="text" id="editRankingValue" class="form-control" readonly>
                        <input type="hidden" name="ranking_id" id="editRankingId">
                    </div>

                    <div class="form-group">
                        <label>Description:</label>
                        <textarea name="description" id="editDescription" class="form-control" rows="4" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Course Link:</label>
                        <input type="text" name="link" id="editLink" class="form-control" required>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Course</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    <script>
          document.addEventListener('DOMContentLoaded', function () {
    let editButtons = document.querySelectorAll('.edit-course-btn');
    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            let courseId = this.getAttribute('data-id') || '';
            let courseName = this.getAttribute('data-name') || '';
            let categoryId = this.getAttribute('data-category-id') || '';
            let categoryName = this.getAttribute('data-category-name') || '';
            let fieldId = this.getAttribute('data-field-id') || '';
            let fieldName = this.getAttribute('data-field-name') || '';
            let universityId = this.getAttribute('data-university-id') || '';
            let universityName = this.getAttribute('data-university-name') || '';
            let locationId = this.getAttribute('data-location-id') || '';
            let locationName = this.getAttribute('data-location-name') || '';
            let budget = this.getAttribute('data-budget') || '';
            let rankingId = this.getAttribute('data-ranking-id') || '';
            let rankingValue = this.getAttribute('data-ranking-value') || '';
            let description = this.getAttribute('data-description') || '';
            let link = this.getAttribute('data-link') || '';

            document.getElementById('editCourseId').value = courseId;
            document.getElementById('editCourseName').value = courseName;

            document.getElementById('editCategoryId').value = categoryId;
            document.getElementById('editCategoryName').value = categoryName;

            document.getElementById('editFieldId').value = fieldId;
            document.getElementById('editFieldName').value = fieldName;

            document.getElementById('editUniversityId').value = universityId;
            document.getElementById('editUniversityName').value = universityName;

            document.getElementById('editLocationId').value = locationId;
            document.getElementById('editLocationName').value = locationName;

            document.getElementById('editRankingId').value = rankingId;
            document.getElementById('editRankingValue').value = rankingValue;

            document.getElementById('editBudget').value = budget;
            document.getElementById('editDescription').value = description;
            document.getElementById('editLink').value = link;

            // Set form action correctly
            document.getElementById('editCourseForm').action = `courses/${courseId}`;
        });
    });
});




            </script>

            </div>
        </div>
    </div>
</div>

