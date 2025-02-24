document.addEventListener("DOMContentLoaded", function () {
    window.openEditModal = function (button) {
        const userId = button.getAttribute('data-id');
    const userName = button.getAttribute('data-name');
    const userEmail = button.getAttribute('data-email');

    // Set form action with user ID
    document.getElementById('editUserForm').action = `users/${userId}`;

    // Populate form fields
    document.getElementById('editUserId').value = userId;
    document.getElementById('editUserName').value = userName;
    document.getElementById('editUserEmail').value = userEmail;

    // Show the modal
    new bootstrap.Modal(document.getElementById('editUserModal')).show();
    };
});
