@extends('layouts.app')

@php
    $header = 'Trip Planner'
@endphp

@section('content')

    <!-- Floating Trip Planner -->
    <div class="min-h-screen flex items-center justify-center flex-col">
        <h1 class="text-4xl md:text-6xl font-bold text-secondary mb-6">
            Plan Your Trip
        </h1>
        <div class="bg-white dark:bg-dark shadow-lg rounded-lg p-6 w-full max-w-4xl">
            <form action="{{ route('bustickets.create') }}" method="GET" class="flex items-center space-x-4">
                <!-- From Dropdown -->
                <div class="flex-1">
                    <select id="from" name="from" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:border-neutral-700 dark:bg-darkneutral dark:text-gray-300 focus:border-blue-500 focus:ring-blue-500" required>
                        <option value="" disabled selected>
                            Select Starting Point
                        </option>
                        <option value="Almere">
                            Almere
                        </option>
                        <option value="Amsterdam">
                            Amsterdam
                        </option>
                        <option value="Utrecht">
                            Utrecht
                        </option>
                    </select>
                </div>

                <!-- Image between From and To -->
                <div class="flex-none">
                    <img src="{{ asset('images/route.png') }}" alt="Route Image" class="w-12 h-12 mx-4">
                </div>

                <!-- Festival selection (to) -->
                <div class="flex-1 form-group">
                    <select id="festival_id" name="festival_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:border-neutral-700 dark:bg-darkneutral dark:text-gray-300 focus:border-blue-500 focus:ring-blue-500" required>
                        <option value="" disabled selected>
                            Select Festival
                        </option>
                        @foreach ($festivals as $festival)
                            <option value="{{ $festival->id }}">{{ $festival->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="flex-none">
                    @if(auth()->check())
                        <x-secondary-button type="submit">
                            Book Your Trip
                        </x-secondary-button>
                    @else
                        <p class="mt-4 text-red-500">Please log in or register before booking a ticket.</p>
                    @endif
                </div>
            </form>
        </div>

        <!-- Cities and Service Section -->
        <div class="py-16 bg-neutral-200">
            <div class="container mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">

                <!-- Info Section -->
                <x-info-card title="Cities We Travel From">
                    <x-dummy-content type="lorem" />
                </x-info-card>

                <!-- Service Section -->
                <x-info-card title="Service On The Bus">
                    <x-dummy-content type="lorem" />
                </x-info-card>

            </div>
        </div>

@endsection
