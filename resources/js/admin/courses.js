document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".edit-course-btn").forEach(button => {
        button.addEventListener("click", function () {
            document.getElementById("editCourseId").value = this.dataset.id;
            document.getElementById("editCourseName").value = this.dataset.name;
            document.getElementById("editDescription").value = this.dataset.description;
            document.getElementById("editCategoryId").value = this.dataset.category_id;
            document.getElementById("editFieldId").value = this.dataset.field_id || "";
            document.getElementById("editUniversityId").value = this.dataset.university_id;
            document.getElementById("editLocationId").value = this.dataset.location_id;
            document.getElementById("editBudget").value = this.dataset.budget;
            document.getElementById("editRankingId").value = this.dataset.ranking_id;
            document.getElementById("editLink").value = this.dataset.link;
        });
    });
});

