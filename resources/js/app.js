import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const darkModeToggle = document.getElementById('darkModeToggle');

darkModeToggle.addEventListener('click', function() {
    // Toggle dark mode class on the html element
    document.documentElement.classList.toggle('dark');

    // Save the dark mode preference in the session
    const isDarkMode = document.documentElement.classList.contains('dark');
    fetch('/toggle-dark-mode', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ dark_mode: isDarkMode })
    });
});
