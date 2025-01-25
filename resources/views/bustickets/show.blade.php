@extends('layouts.app')

@php
    $header = 'Details for Ticket  #' . $busticket->id;
@endphp

@section('content')
    <div class="container mx-auto px-4 py-8">

        <div class="max-w-4xl mx-auto bg-white dark:bg-secondary shadow-lg rounded-lg overflow-hidden mt-12">
            <div class="bg-primary dark:bg-dark text-white text-lg font-bold p-4">
                Busticket #{{ $busticket->id }}
            </div>
            <div class="p-6 space-y-4">
                <p><strong class="font-medium text-gray-700">Festival:</strong>
                    <span class="text-gray-600">{{ $busticket->festival ? $busticket->festival->name : 'No Festival' }}</span>
                </p>
                <p><strong class="font-medium text-gray-700">Starting Point:</strong>
                    <span class="text-gray-600">{{ $busticket->bus->starting_point ?? 'N/A' }}</span>
                </p>
                <p><strong class="font-medium text-gray-700">Customer First Name:</strong>
                    <span class="text-gray-600">{{ $busticket->user->first_name }}</span>
                </p>
                <p><strong class="font-medium text-gray-700">Customer Last Name:</strong>
                    <span class="text-gray-600">{{ $busticket->user->last_name }}</span>
                </p>
                <p><strong class="font-medium text-gray-700">Bus Number:</strong>
                    <span class="text-gray-600">{{ $busticket->bus->bus_number }}</span>
                </p>
                <p><strong class="font-medium text-gray-700">Seat Number:</strong>
                    <span class="text-gray-600">{{ $busticket->seat_number ?? 'N/A' }}</span>
                </p>
                <p><strong class="font-medium text-gray-700">Booking Date:</strong>
                    <span class="text-gray-600">{{ $busticket->created_at->format('Y-m-d H:i') }}</span>
                </p>
            </div>
        </div>

        <!-- Back to Tickets Button -->
        <div class="mt-6 text-center">
            <a href="{{ route('bustickets.index') }}">
                <x-secondary-button>
                    Back to Bustickets
                </x-secondary-button>
            </a>
        </div>
    </div>
@endsection
