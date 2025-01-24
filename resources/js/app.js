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

document.addEventListener('DOMContentLoaded', function() {
    const prevButton = document.getElementById('prevButton');
    const nextButton = document.getElementById('nextButton');
    const carousel = document.getElementById('festivalCarousel');
    const totalFestivals = parseInt(carousel.getAttribute('data-total-festivals')); // Get the festival count from data attribute
    const itemsPerPage = 3; // Number of items to show per scroll
    let currentIndex = 0;

    // Function to update the carousel
    function updateCarousel() {
        const offset = -currentIndex * (100 / itemsPerPage); // Move the carousel by 33.333% of its width
        carousel.style.transition = 'transform 0.5s ease'; // Add smooth transition
        carousel.style.transform = `translateX(${offset}%)`;
    }

    // Move to the next item
    nextButton.addEventListener('click', function() {
        if (currentIndex < totalFestivals - itemsPerPage) {
            currentIndex++;
        } else {
            currentIndex = 0; // Loop back to the first set of items
        }
        updateCarousel();
    });

    // Move to the previous item
    prevButton.addEventListener('click', function() {
        if (currentIndex > 0) {
            currentIndex--;
        } else {
            currentIndex = totalFestivals - itemsPerPage; // Loop to the last set of items
        }
        updateCarousel();
    });

    // Optional: Auto-scroll feature (every 3 seconds)
    setInterval(function() {
        if (currentIndex < totalFestivals - itemsPerPage) {
            currentIndex++;
        } else {
            currentIndex = 0; // Reset to the first set after reaching the last one
        }
        updateCarousel();
    }, 3000); // Adjust the interval time (in milliseconds) as needed
});


