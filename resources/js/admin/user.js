document.addEventListener("DOMContentLoaded", function () {
    window.openEditModal = function (button) {
        // Get user data from button attributes
        let userId = button.getAttribute("data-id");
        let userName = button.getAttribute("data-name");
        let userEmail = button.getAttribute("data-email");

        // Populate modal fields
        document.getElementById("editUserId").value = userId;
        document.getElementById("editUserName").value = userName;
        document.getElementById("editUserEmail").value = userEmail;

        // Update form action URL
        document.getElementById("editUserForm").action = "/admin/users/" + userId;

        // Show modal
        let editModal = new bootstrap.Modal(document.getElementById("editUserModal"));
        editModal.show();
    };
});
