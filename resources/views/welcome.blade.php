@extends('layouts.app')

@section('content')
    <div class="relative">
        <img src="{{ asset('images/festibus.jpg') }}" alt="Festival Bus" class="w-full h-screen object-cover">

        <!-- Floating Trip Planner -->
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="bg-white dark:bg-neutral-800 shadow-lg rounded-lg p-6 w-full max-w-4xl">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4 text-start">Plan Your Trip</h2>
                <form action="{{ route('bustickets.create') }}" method="GET" class="flex items-center space-x-4">

                    <!-- From Dropdown -->
                    <div class="flex-1">
{{--                        <label for="from" class="block text-sm font-medium text-gray-600 dark:text-gray-300">From</label>--}}
                        <select id="from" name="from" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:border-neutral-700 dark:bg-neutral-900 dark:text-gray-300 focus:border-blue-500 focus:ring-blue-500" required>
                            <option value="" disabled selected>Select Starting Point</option>
                            <option value="Almere">Almere</option>
                            <option value="Amsterdam">Amsterdam</option>
                            <option value="Utrecht">Utrecht</option>
                        </select>
                    </div>

                    <!-- Image between From and To -->
                    <div class="flex-none">
                        <img src="{{ asset('images/route.png') }}" alt="Route Image" class="w-12 h-12 mx-4">
                    </div>

                    <!-- To Dropdown -->
                    <div class="flex-1">
{{--                        <label for="to" class="block text-sm font-medium text-gray-600 dark:text-gray-300">To</label>--}}
                        <select id="to" name="to" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:border-neutral-700 dark:bg-neutral-900 dark:text-gray-300 focus:border-blue-500 focus:ring-blue-500" required>
                            <option value="" disabled selected>Select Destination</option>
                            <option value="Tomorrowland">Tomorrowland</option>
                            <option value="Pinkpop">Pinkpop</option>
                            <option value="Lowlands">Lowlands</option>
                            {{-- @foreach ($festivals as $festival) --}}
                            {{--     <option value="{{ $festival->name }}"></option> --}}
                            {{-- @endforeach --}}
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex-none">
{{--                        <label for="to" class="block text-sm font-medium text-gray-600 dark:text-gray-300">Submit</label>--}}
                        <button type="submit" class="py-2 px-4 w-auto h-auto bg-primary text-white font-medium rounded-md hover:bg-secondary dark:bg-secondary dark:hover:bg-darktext focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Search
                        </button>
                    </div>
                </form>
            </div>
        </div>



@endsection
