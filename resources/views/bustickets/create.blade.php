@extends('layouts.app')

@php
    $header = 'Confirm Your Booking'
@endphp

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Trip Details -->
        <div class="bg-white dark:bg-dark shadow-lg rounded-lg p-6 mb-8">
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-2">
                You're booking a trip from <span class="text-secondary">{{ request()->get('from') }}</span> to <span class="text-secondary">{{ $festival->name }}</span>.
            </p>
            <p class="text-md text-gray-600 dark:text-gray-300">
                Please confirm your personal information below.
            </p>
        </div>

        <!-- Form for User Information -->
        <form action="{{ route('bustickets.store') }}" method="POST" class="bg-white dark:bg-dark shadow-lg rounded-lg p-6">
            @csrf
            <!-- Hidden Inputs for Trip Details -->
            <input type="hidden" name="from" value="{{ $from }}">
            <input type="hidden" name="festival_id" value="{{ $festival->id }}">
            <input type="hidden" name="user_id" value="{{ auth()->check() ? auth()->user()->id : '' }}">
            <input type="hidden" id="tripCost" value="{{ $tripCost }}">
            <input type="hidden" name="pay_with_points" id="pay_with_points" value="false">

            <!-- User Information (pre-filled with the logged-in user's name) -->
            <div class="mb-6">
                <label for="first_name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                    First Name
                </label>
                <input type="text" name="first_name" id="first_name" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-darkneutral dark:border-neutral-700 dark:text-gray-300" value="{{ old('first_name', auth()->user()->first_name) }}" required>
            </div>

            <div class="mb-6">
                <label for="last_name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                    Last Name
                </label>
                <input type="text" name="last_name" id="last_name" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-darkneutral dark:border-neutral-700 dark:text-gray-300" value="{{ old('last_name', auth()->user()->last_name) }}" required>
            </div>

            <div class="mb-6">
                <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                    Email
                </label>
                <input type="email" name="email" id="email" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-darkneutral dark:border-neutral-700 dark:text-gray-300" value="{{ old('email', auth()->user()->email) }}" required>
            </div>

            <!-- Quantity -->
            <div class="mb-6">
                <label for="quantity" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                    Number of Tickets
                </label>
                <select id="quantity" name="quantity" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-darkneutral dark:border-neutral-700 dark:text-gray-300" required>
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" {{ $i == 1 ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>


            <!-- Payment Option Dropdown -->
            <div class="mb-6">
                <label for="paymentOption" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                    Payment Option
                </label>
                <select id="paymentOption" class="form-select" name="paymentOption">
                    <option value="cash">Pay with Cash</option>
                    <option value="points">Pay with Points</option>
                </select>
            </div>

            <!-- Terms and Conditions Checkbox -->
            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" id="terms1" name="terms" class="mr-2" />
                    <span class="text-sm text-gray-700 dark:text-gray-300">
                        I agree to the <a href="{{ route('terms-of-service') }}" class="text-blue-500">terms and conditions</a>.
                    </span>
                </label>
            </div>

            <!-- Cash Payment Checkbox (Only visible if 'Pay with Cash' is selected) -->
            <div class="mb-6" id="terms-container" style="display: none;">
                <label class="flex items-center">
                    <input type="checkbox" id="terms2" class="mr-2" />
                    <span class="text-sm text-gray-700 dark:text-gray-300">
                        I agree to pay for the services upon delivery of said service, and by booking this ticket, I acknowledge that this constitutes a binding agreement. Failure to pay may result in legal action, including the forfeiture of assets, property, and my firstborn child, as permitted by law.
                    </span>
                </label>
            </div>

            <!-- Error Message (Initially Hidden) -->
            <div id="error-message" class="mb-6 text-red-500 text-center" style="display: none;">
                <p>Please agree to our terms and conditions to proceed with the booking.</p>
            </div>

            <!-- Error Message for Insufficient Points (Initially Hidden) -->
            <div id="points-error-message" class="mb-6 text-red-500 text-center" style="display: none;">
                <p>You don't have enough points to complete the booking.</p>
            </div>

            <!-- Store the user's points in a hidden div using a data attribute -->
            <div id="user-points" data-points="{{ auth()->check() ? auth()->user()->points : 0 }}"></div>

            <!-- Points Deduction (Hidden initially) -->
            <div id="points-deduction" class="mb-6" style="display: none;">
                <label for="points" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                    Available Points: <span id="userPoints">{{ auth()->user()->points }}</span>
                </label>

                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                    Trip Cost: <span id="tripCostAmount">{{ 1000 }}</span> points per ticket
                </label>

                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                    Total Cost: <span id="totalCost">1000</span> points
                </label>

                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                    Points Remaining: <span id="pointsRemaining">{{ auth()->user()->points - 1000 }}</span>
                </label>
            </div>

            <!-- Submit Button (Initially Disabled) -->
            <div class="mb-6 text-center">
                <x-secondary-button type="submit" id="submitBtn" enabled>
                    Confirm Booking
                </x-secondary-button>
            </div>

        </form>
    </div>
@endsection
