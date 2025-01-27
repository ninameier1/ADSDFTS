<div class="bg-white dark:bg-dark shadow-lg rounded-lg p-6 text-center">
    <h3 class="text-xl font-semibold text-primary pb-4 dark:text-secondary">{{ $name }}</h3>
    <img src="{{ asset($image) }}" alt="{{ $name }}" class="w-full h-40 object-cover rounded-md mb-4">

    @if ($date)
        <p class="text-primary dark:text-secondary">{{ $date }}</p>
    @endif

    @if ($location)
        <p class="text-primary dark:text-secondary">{{ $location }}</p>
    @endif

    <a href="{{ $detailsRoute }}">
        <x-secondary-button>
            View Details
        </x-secondary-button>
    </a>
</div>

