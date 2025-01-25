@extends('layouts.app')

@php
    $header = 'My Booked Tickets';
@endphp

@section('content')

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="container mx-auto my-8 flex flex-col justify-between">

        @if($busticketsGrouped->isEmpty())
            <p class="text-primary dark:text-secondary">No tickets found.</p>
        @else
            @foreach($busticketsGrouped as $festivalName => $tickets)
                <div class="mb-8" x-data="{ open: false }">
                    <!-- Toggle Button with bg-secondary -->
                    <button
                        @click="open = !open"
                        class="bg-primary dark:bg-dark py-2 px-4 text-2xl font-bold text-white dark:text-secondary shadow-lg hover:bg-secondary dark:hover:bg-darktext mb-4 flex items-center justify-between w-full rounded-lg transition-colors duration-300">
                        <span>{{ $festivalName }}</span>
                        <svg :class="{'transform rotate-180': open}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6 transition-transform duration-300">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <!-- Festival Tickets (Toggle visibility) -->
                    <div x-show="open" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($tickets as $busticket)
                            <x-info-card :title="'Ticket #' . $busticket->id">
                                <p class="text-gray-600 dark:text-gray-400 mb-1">
                                    <strong>Customer:</strong> {{ $busticket->user->first_name }} {{ $busticket->user->last_name }}
                                </p>
                                <p class="text-gray-600 dark:text-gray-400 mb-1">
                                    <strong>Seat Number:</strong> {{ $busticket->seat_number ?? 'N/A' }}
                                </p>
                                <p class="text-gray-600 dark:text-gray-400 mb-1">
                                    <strong>Booking Date:</strong> {{ $busticket->created_at->format('Y-m-d H:i') }}
                                </p>
                                <a href="{{ route('bustickets.show', $busticket) }}">
                                    <x-secondary-button>
                                        View Details
                                    </x-secondary-button>
                                </a>
                            </x-info-card>
                        @endforeach
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
