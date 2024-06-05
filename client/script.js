// script.js
document.addEventListener('DOMContentLoaded', function () {
    const profileImg = document.getElementById('profile-img');
    const dropdownMenu = document.getElementById('dropdown-menu');

    profileImg.addEventListener('click', function () {
        dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
    });

    // Close the dropdown if clicked outside
    window.addEventListener('click', function (event) {
        if (!profileImg.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.style.display = 'none';
        }
    });
});
