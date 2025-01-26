import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


// Dark mode toggle
// Apply dark mode based on the stored preference
if (localStorage.getItem('darkMode') === 'enabled') {
    document.documentElement.classList.add('dark');
} else {
    document.documentElement.classList.remove('dark');
}

const darkModeToggle = document.getElementById('darkModeToggle');

// Check if the dark mode toggle exists before adding event listener
if (darkModeToggle) {
    // Ensure the toggle reflects the stored state
    darkModeToggle.checked = localStorage.getItem('darkMode') === 'enabled';

    // Listen for changes on the toggle
    darkModeToggle.addEventListener('change', function () {
        if (this.checked) {
            document.documentElement.classList.add('dark');
            localStorage.setItem('darkMode', 'enabled'); // Save preference
        } else {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('darkMode', 'disabled'); // Save preference
        }
    });
}

if (window.location.pathname === '/') {
    // Carousel for the front page!!
    document.addEventListener('DOMContentLoaded', function () {
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
        nextButton.addEventListener('click', function () {
            if (currentIndex < totalFestivals - itemsPerPage) {
                currentIndex++;
            } else {
                currentIndex = 0; // Loop back to the first set of items
            }
            updateCarousel();
        });

        // Move to the previous item
        prevButton.addEventListener('click', function () {
            if (currentIndex > 0) {
                currentIndex--;
            } else {
                currentIndex = totalFestivals - itemsPerPage; // Loop to the last set of items
            }
            updateCarousel();
        });

        // Auto-scroll feature (every 3 seconds)
        setInterval(function () {
            if (currentIndex < totalFestivals - itemsPerPage) {
                currentIndex++;
            } else {
                currentIndex = 0; // Reset to the first set after reaching the last one
            }
            updateCarousel();
        }, 3000); // Three seconds
    });
}

if (window.location.pathname.startsWith('/bustickets/')) {

    document.addEventListener('DOMContentLoaded', function () {
        const paymentOption = document.getElementById('paymentOption');
        const pointsDeduction = document.getElementById('points-deduction');
        const termsContainer = document.getElementById('terms-container');
        const submitBtn = document.getElementById('submitBtn');
        const terms1 = document.getElementById('terms1');
        const terms2 = document.getElementById('terms2');
        let userPoints = parseInt(document.getElementById('user-points').dataset.points, 10);
        const quantityInput = document.getElementById('quantity');
        const totalCostElem = document.getElementById('totalCost');
        const pointsRemainingElem = document.getElementById('pointsRemaining');
        const errorMessage = document.getElementById('error-message');
        const pointsErrorMessage = document.getElementById('points-error-message');

        function updatePointsDeduction() {
            const tripCost = parseInt(document.getElementById('tripCost').value, 10);
            const quantity = parseInt(quantityInput.value, 10);
            const totalCost = tripCost * quantity;

            totalCostElem.textContent = totalCost;
            pointsRemainingElem.textContent = userPoints - totalCost;

            if (paymentOption.value === 'points') {
                if (userPoints >= totalCost && terms1.checked) {
                    enableSubmit();
                } else {
                    disableSubmit('Please agree to the terms and conditions to proceed with the booking.');
                    if (userPoints < totalCost) {
                        showError(pointsErrorMessage, "You don't have enough points to complete the booking.");
                    } else {
                        hideError(pointsErrorMessage);
                    }
                }
            } else if (paymentOption.value === 'cash') {
                if (terms1.checked && terms2.checked) {
                    enableSubmit();
                } else {
                    disableSubmit('Please agree to the terms and conditions to proceed with the booking.');
                }
            }
        }

        function enableSubmit() {
            submitBtn.disabled = false;
            hideError(errorMessage);
            hideError(pointsErrorMessage);
        }

        function disableSubmit(message) {
            submitBtn.disabled = true;
            showError(errorMessage, message);
            hideError(pointsErrorMessage);
        }

        function showError(element, message) {
            element.style.display = 'block';
            element.textContent = message;
        }

        function hideError(element) {
            element.style.display = 'none';
        }

        paymentOption.addEventListener('change', function () {
            if (paymentOption.value === 'points') {
                pointsDeduction.style.display = 'block';
                termsContainer.style.display = 'none';
            } else {
                pointsDeduction.style.display = 'none';
                termsContainer.style.display = 'block';
            }
            updatePointsDeduction();
        });

        quantityInput.addEventListener('input', function () {
            if (paymentOption.value === 'points') {
                updatePointsDeduction();
            }
        });

        terms1.addEventListener('change', updatePointsDeduction);
        terms2.addEventListener('change', updatePointsDeduction);

        // Initial setup
        if (paymentOption.value === 'points') {
            pointsDeduction.style.display = 'block';
            termsContainer.style.display = 'none';
        } else {
            pointsDeduction.style.display = 'none';
            termsContainer.style.display = 'block';
        }
        updatePointsDeduction();
    });
}




