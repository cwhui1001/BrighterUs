document.addEventListener("DOMContentLoaded", function () {
    const buttons = document.querySelectorAll(".left-section button");
    const detailsSections = document.querySelectorAll(".details");

    // Activate the first scholarship by default
    if (buttons.length > 0) {
        buttons[0].classList.add("focused");
        const firstScholarshipId = buttons[0].getAttribute("onclick").match(/'([^']+)'/)[1];
        document.getElementById(firstScholarshipId).style.display = "block";
    }

    buttons.forEach((button) => {
        button.addEventListener("click", function () {
            // Remove focus style from all buttons
            buttons.forEach((btn) => {
                btn.classList.remove("focused");
            });

            // Add focus style to the clicked button
            this.classList.add("focused");

            // Hide all details
            detailsSections.forEach((details) => {
                details.style.display = "none";
            });

            // Show the relevant details section
            const targetId = this.getAttribute("onclick").match(/'([^']+)'/)[1];
            const targetDetails = document.getElementById(targetId);
            if (targetDetails) {
                targetDetails.style.display = "block";
            }
        });
    });
});


// JavaScript to toggle dropdown content within a specific scholarship's details
document.querySelectorAll('.dropdown-btn').forEach(button => {
    button.addEventListener('click', () => {
        // Close all other dropdowns in the same container
        const dropdownContainer = button.closest('.dropdown-container');
        dropdownContainer.querySelectorAll('.dropdown').forEach(dropdown => {
            if (dropdown !== button.parentElement) {
                dropdown.classList.remove('open');
            }
        });

        // Toggle the clicked dropdown
        const dropdown = button.parentElement;
        dropdown.classList.toggle('open');
    });
});

document.addEventListener("DOMContentLoaded", function() {
    const boxes = document.querySelectorAll(".flow-up");
  
    const revealOnScroll = () => {
      const triggerBottom = window.innerHeight / 5 * 4;
  
      boxes.forEach(box => {
        const boxTop = box.getBoundingClientRect().top;
  
        if (boxTop < triggerBottom) {
          box.classList.add("show");
        } else {
          box.classList.remove("show");
        }
      });
    };
  
    window.addEventListener("scroll", revealOnScroll);
  
    // Initial check
    revealOnScroll();
  });