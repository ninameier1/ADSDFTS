<div class="bg-white dark:bg-dark shadow-lg rounded-lg p-8">
    <h2 class="text-2xl font-bold text-gray-800 dark:text-secondary mb-4">{{ $title }}</h2>
    <p class="text-gray-600 leading-relaxed">
        {{ $slot }}  <!-- Render the content passed as a slot -->
    </p>
</div>
