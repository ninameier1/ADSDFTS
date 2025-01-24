@extends('layouts.app')

@php
    $header = 'Confirm Your Booking'
@endphp

@section('content')
    <div class="container">

        <!-- Display the trip details as normal text -->
        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4">
            Booking a trip from {{ request()->get('from') }} to {{ $festival->name }}.
        </p>

        <p class="text-md text-gray-600 dark:text-gray-300 mb-4">
            Please confirm your personal information below.
        </p>

        <!-- The form for user information -->
        <form action="{{ route('bustickets.store') }}" method="POST">
            @csrf
            <!-- Hidden Inputs for Trip Details -->
            <input type="hidden" name="from" value="{{ $from }}">
            <input type="hidden" name="festival_id" value="{{ $festival->id }}">
            <input type="hidden" name="user_id" value="{{ auth()->check() ? auth()->user()->id : '' }}">

            <!-- User Information (pre-filled with the logged-in user's name) -->
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name', auth()->user()->first_name) }}" required>
            </div>

            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name', auth()->user()->last_name) }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', auth()->user()->email) }}" required>
            </div>

            <!-- Quantity -->
            <label for="quantity">Number of Tickets:</label>
            <input type="number" id="quantity" name="quantity" min="1" max="35" required>

            <!-- Submit Button -->
            <div class="form-group">
                <x-primary-button type="submit" class="btn btn-primary">Confirm</x-primary-button>
            </div>
        </form>
    </div>
@endsection
