@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <div class="relative bg-cover bg-center h-screen" style="background-image: url('{{ asset('images/festibus.jpg') }}');">
        <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col items-center justify-center text-center">
            <h1 class="text-4xl md:text-6xl font-bold text-neutral mb-4">We Are Festibus</h1>
            <h2 class="text-2xl md:text-2xl text-neutral mb-2">Your Festival Starts With Us!</h2>
            <a href="{{ route('trip-planner') }}">
                <x-primary-button>
                    Plan Your Trip Now
                </x-primary-button>
            </a>
        </div>
    </div>

    <!-- Festival Section -->
    <div class="py-16 bg-gray-100 dark:bg-secondary">
        <div class="container max-w-full">
            <h2 class="text-3xl font-bold text-center text-primary dark:text-dark mb-12">
                Our Featured Festivals
            </h2>
                <div class="relative">
                    <!-- Festival Cards Carousel -->
                    <div class="overflow-hidden">
                        <div class="flex justify-start transition-transform duration-500" id="festivalCarousel" data-total-festivals="{{ count($festivals) }}">
                            @foreach ($festivals as $festival)
                                <div class="flex-shrink-0 w-1/3 px-4 py-2">
                                    <x-festival-card
                                        :name="$festival->name"
                                        :image="$festival->image"
                                        :detailsRoute="route('festivals.show', $festival)"
                                    />
                                </div>
                            @endforeach
                        </div>
                    </div>


                    <!-- Arrow Buttons -->
                    <button id="prevButton" class="absolute top-1/2 left-0 transform -translate-y-1/2 bg-gray-500 text-white p-2 rounded-full">
                        &#8592;
                    </button>
                    <button id="nextButton" class="absolute top-1/2 right-0 transform -translate-y-1/2 bg-gray-500 text-white p-2 rounded-full">
                        &#8594;
                    </button>
                </div>
            </div>
        </div>


    <!-- Info and Service Section -->
    <div class="py-16 bg-neutral-200">
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">

            <!-- Info Section -->
            <x-info-card title="Info">
                <x-dummy-content type="lorem" />
            </x-info-card>

            <!-- Service Section -->
            <x-info-card title="Service">
                <x-dummy-content type="lorem" />
            </x-info-card>

        </div>
    </div>


@endsection
