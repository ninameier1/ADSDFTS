<footer class="bg-secondary dark:bg-dark text-neutral dark:text-darktext py-6">
    <div class="max-w-7xl mx-auto text-center">

        <!-- Social Media Links -->
        <div class="mb-4">
            <a href="https://facebook.com" target="_blank" class="mx-2 text-lg hover:text-dark dark:hover:text-secondary">
                <i class="fab fa-facebook"></i> Facebook
            </a>
            <a href="https://twitter.com" target="_blank" class="mx-2 text-lg hover:text-dark dark:hover:text-secondary">
                <i class="fab fa-twitter"></i> Twitter
            </a>
            <a href="https://instagram.com" target="_blank" class="mx-2 text-lg hover:text-dark dark:hover:text-secondary">
                <i class="fab fa-instagram"></i> Instagram
            </a>
            <a href="https://linkedin.com" target="_blank" class="mx-2 text-lg hover:text-dark dark:hover:text-secondary">
                <i class="fab fa-linkedin"></i> LinkedIn
            </a>
        </div>

        <!-- Footer Links -->
        <div class="mb-4">
            <a href="{{ route('faq') }}" class="text-sm hover:text-dark dark:hover:text-secondary">FAQ</a> |
            <a href="{{ route('privacy-policy') }}" class="text-sm hover:text-dark dark:hover:text-secondary">Privacy Policy</a> |
            <a href="{{ route('terms-of-service') }}" class="text-sm hover:text-dark dark:hover:text-secondary">Terms of Service</a>
        </div>

        <!-- Address and Contact -->
        <div class="text-sm">
            <p>&copy; {{ date('Y') }} Festibus. All rights reserved.</p>
            <p>Stadhuisstraat 18, 1315HC Almere, The Netherlands</p>
            <p>Email: contact@festibus.com | Phone: +123 456 789</p>
        </div>
    </div>
</footer>

