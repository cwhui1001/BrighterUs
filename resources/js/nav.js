// document.addEventListener('DOMContentLoaded', () => {
//     const dropdownButton = document.getElementById('financialAidDropdownButton');
//     const dropdownMenu = document.getElementById('financialAidDropdownMenu');

//     // Close dropdown on click outside
//     document.addEventListener('click', (event) => {
//         if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
//             dropdownMenu.classList.add('hidden');
//         }
//     });

//     // Toggle dropdown on button click
//     dropdownButton.addEventListener('click', () => {
//         dropdownMenu.classList.toggle('hidden');
//     });

//     // Close dropdown when an item is clicked
//     const dropdownLinks = dropdownMenu.querySelectorAll('a');
//     dropdownLinks.forEach((link) => {
//         link.addEventListener('click', () => {
//             dropdownMenu.classList.add('hidden');
//         });
//     });
// });

// document.addEventListener('click', function (event) {
//     const dropdownButton = document.getElementById('financialAidDropdownButton');
//     const dropdownMenu = document.getElementById('financialAidDropdownMenu');

//     if (dropdownButton.contains(event.target)) {
//         dropdownMenu.classList.toggle('hidden');
//     } else if (!dropdownMenu.contains(event.target)) {
//         dropdownMenu.classList.add('hidden');
//     }
// });

document.addEventListener('click', function (event) {
    const dropdownButton = document.getElementById('financialAidDropdownButton');
    const dropdownMenu = document.getElementById('financialAidDropdownMenu');

    if (dropdownButton.contains(event.target)) {
        dropdownMenu.classList.toggle('hidden');
        dropdownButton.classList.toggle('active');
    } else if (!dropdownMenu.contains(event.target)) {
        dropdownMenu.classList.add('hidden');
        dropdownButton.classList.remove('active');
    }
});