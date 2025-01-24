@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <div class="relative bg-cover bg-center h-screen" style="background-image: url('{{ asset('images/festibus.jpg') }}');">
        <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col items-center justify-center text-center">
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">We Bring You to Your Festival</h1>
            <a href="{{ route('trip-planner') }}" class="bg-primary text-white px-6 py-3 text-lg font-medium rounded-lg hover:bg-secondary transition">
                Plan Your Trip Now
            </a>
        </div>
    </div>

    <!-- Festival Section -->
    <div class="py-16 bg-gray-100">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Our Featured Festivals</h2>

            <!-- Two Rows of Festivals -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- First Row -->
                <div class="bg-white shadow-lg rounded-lg p-6 text-center">
                    <img src="{{ asset('images/tomorrowland.jpg') }}" alt="Tomorrowland" class="w-full h-40 object-cover rounded-md mb-4">
                    <h3 class="text-xl font-semibold text-gray-800">Tomorrowland</h3>
                </div>
                <div class="bg-white shadow-lg rounded-lg p-6 text-center">
                    <img src="{{ asset('images/pinkpop.jpg') }}" alt="Pinkpop" class="w-full h-40 object-cover rounded-md mb-4">
                    <h3 class="text-xl font-semibold text-gray-800">Pinkpop</h3>
                </div>
                <div class="bg-white shadow-lg rounded-lg p-6 text-center">
                    <img src="{{ asset('images/lowlands.jpg') }}" alt="Lowlands" class="w-full h-40 object-cover rounded-md mb-4">
                    <h3 class="text-xl font-semibold text-gray-800">Lowlands</h3>
                </div>

                <!-- Second Row -->
                <div class="bg-white shadow-lg rounded-lg p-6 text-center">
                    <img src="{{ asset('images/rockwerchter.jpg') }}" alt="Rock Werchter" class="w-full h-40 object-cover rounded-md mb-4">
                    <h3 class="text-xl font-semibold text-gray-800">Rock Werchter</h3>
                </div>
                <div class="bg-white shadow-lg rounded-lg p-6 text-center">
                    <img src="{{ asset('images/mysteryland.jpg') }}" alt="Mysteryland" class="w-full h-40 object-cover rounded-md mb-4">
                    <h3 class="text-xl font-semibold text-gray-800">Mysteryland</h3>
                </div>
                <div class="bg-white shadow-lg rounded-lg p-6 text-center">
                    <img src="{{ asset('images/defqon.jpg') }}" alt="Defqon.1" class="w-full h-40 object-cover rounded-md mb-4">
                    <h3 class="text-xl font-semibold text-gray-800">Defqon.1</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Info and Service Section -->
    <div class="py-16 bg-neutral-200">
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Info Section -->
            <div class="bg-white shadow-lg rounded-lg p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Info</h2>
                <p class="text-gray-600 leading-relaxed">
                    Discover everything you need to know about our services, from how to book your tickets to our policies for a smooth and enjoyable trip.
                </p>
            </div>

            <!-- Service Section -->
            <div class="bg-white shadow-lg rounded-lg p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Service</h2>
                <p class="text-gray-600 leading-relaxed">
                    We pride ourselves on providing top-notch customer service. Our team is here to ensure your journey to the festival is seamless and enjoyable.
                </p>
            </div>
        </div>
    </div>
@endsection
