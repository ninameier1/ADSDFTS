@extends('layouts.app')

@php
    $header = $festival->name;
@endphp

@section('content')
    <div class="flex flex-col items-center justify-center min-h-screen px-4 py-8">
        <div class="max-w-4xl w-full bg-white dark:bg-secondary shadow-lg rounded-lg overflow-hidden mt-12">
            <div class="bg-primary dark:bg-dark text-white text-lg font-bold p-4">
                {{ $festival->name }}
            </div>

            <img src="{{ asset($festival->image) }}" alt="{{ $festival->name }}" class="w-full h-[500px] object-cover rounded-md mb-4">



            <div class="p-6 space-y-4">
                <p>
                    <strong class="font-medium text-gray-700">
                        Date:
                    </strong>
                    <span class="text-gray-600">{{ $festival->date->format('Y-m-d') }}</span>
                </p>
                <p>
                    <strong class="font-medium text-gray-700">
                        Location:
                    </strong>
                    <span class="text-gray-600">{{ $festival->location }}</span>
                </p>
                <p>
                    <strong class="font-medium text-gray-700">
                        Description:
                    </strong>
                    <span class="text-gray-600">{{ $festival->description }}</span>
                </p>
                <p>
                    <strong class="font-medium text-gray-700">
                        Genre:
                    </strong>
                    <span class="text-gray-600">{{ $festival->genre }}</span>
                </p>
            </div>

            </div>

            <!-- Book a ticket Button -->
            <div class="mt-6 text-center">
                <a href="{{ route('trip-planner') }}">
                    <x-primary-button>
                        Book Your Ticket Now
                    </x-primary-button>
                </a>
            </div>

            <!-- Back to Festivals Button -->
            <div class="mt-6 text-center">
                <a href="{{ route('festivals.index') }}">
                    <x-primary-button>
                        Back to Festivals
                    </x-primary-button>
                </a>
            </div>
        </div>
    </div>
@endsection


