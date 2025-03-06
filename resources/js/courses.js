document.addEventListener("DOMContentLoaded", function () {
    const filterPanel = document.querySelector(".filter-panel");
    const courseContainer = document.querySelector(".course-container");
    const toggleButton = document.getElementById("toggle-filters-btn");

    toggleButton.addEventListener("click", function () {
        filterPanel.classList.toggle("hidden");
        courseContainer.classList.toggle("full-width");

        if (filterPanel.classList.contains("hidden")) {
            toggleButton.textContent = "⮞"; // Right arrow for show
            toggleButton.style.left = "10px"; // Move button to the left
            this.setAttribute("title", "Show Panel");
        } else {
            toggleButton.textContent = "⮜"; // Left arrow for hide
            toggleButton.style.left = "330px"; // Adjust position when visible
            this.setAttribute("title", "Hide Panel");
        }
    });
    

});


 
function filterFields() {
    let input = document.getElementById("filterSearch").value.toLowerCase();
    let checkboxes = document.querySelectorAll(".filter-panel label");

    checkboxes.forEach(label => {
        label.style.display = label.textContent.toLowerCase().includes(input) ? "block" : "none";
    });
}



document.addEventListener("DOMContentLoaded", function () {
    const compareContainer = document.getElementById("compare-container");
    const toggleCompareBtn = document.getElementById("toggle-compare-btn");

    if (!compareContainer || !toggleCompareBtn) {
        console.error("Element(s) not found!");
        return;
    }

    let isCompareBoxVisible = true;

    function showReminder() {
        if (document.getElementById("compare-reminder")) return; // Prevent duplicate reminders

        const reminder = document.createElement("div");
        reminder.id = "compare-reminder";
        reminder.innerHTML = `
            <button id="close-reminder" style="
            position: absolute;
            top: 2px;
            left: 2px;
            padding: 0px 4px;
            background: white;
            border: 1px solid gray;
            border-radius: 50%;
            color: black;
            font-weight: bold;
            cursor: pointer;
            font-size: 8px;
            width: 14px;
            height: 14px;
            line-height: 12px;
            text-align: center;
        ">X</button>
            <span style="margin-left: 8px;">Course compare box is over here!</span>
            
        `;
        reminder.style.position = "fixed";
        reminder.style.bottom = "680px"; // Align with toggle button
        reminder.style.right = "20px"; // Next to the toggle button
        reminder.style.background = "rgba(0, 0, 0, 0.33)";
        reminder.style.color = "white";
        reminder.style.padding = "8px 12px";
        reminder.style.borderRadius = "5px";
        reminder.style.fontSize = "14px";
        reminder.style.boxShadow = "0 2px 5px rgba(0, 0, 0, 0.44)";
        reminder.style.zIndex = "1000";
        document.body.appendChild(reminder);

        // Close reminder on X button click
        document.getElementById("close-reminder").addEventListener("click", function () {
            reminder.remove();
        });
    }

    toggleCompareBtn.addEventListener("click", function () {
        if (isCompareBoxVisible) {
            compareContainer.style.display = "none"; 
            toggleCompareBtn.textContent = "+";
            showReminder(); // Show the reminder when hiding the box
        } else {
            compareContainer.style.display = "block"; 
            toggleCompareBtn.textContent = "-";
            const reminder = document.getElementById("compare-reminder");
            if (reminder) reminder.remove(); // Remove the reminder when showing the box
        }
        isCompareBoxVisible = !isCompareBoxVisible;
    });
});

