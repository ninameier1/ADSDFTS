@extends('layouts.adminapp')

@php
    $header = 'Bus Details'
@endphp

@section('content')
    <div class="flex flex-col items-center justify-center min-h-screen px-4 py-8">
        <div class="max-w-4xl w-full bg-white dark:bg-secondary shadow-lg rounded-lg overflow-hidden mt-12">
            <div class="bg-primary dark:bg-dark text-white text-lg font-bold p-4">
                Bus Number: {{ $bus->bus_number }}
            </div>

            <div class="p-6 space-y-4">
                <p>
                    <strong class="font-medium text-gray-700">
                        Capacity:
                    </strong>
                    <span class="text-gray-600">{{ $bus->capacity }}</span>
                </p>
                <p>
                    <strong class="font-medium text-gray-700">
                        Festival:
                    </strong>
                    <span class="text-gray-600">{{ $bus->festival->name ?? 'N/A' }}</span>
                </p>
                <p>
                    <strong class="font-medium text-gray-700">
                        Starting Point:
                    </strong>
                    <span class="text-gray-600">{{ $bus->starting_point ?? 'N/A' }}</span>
                </p>
                <p>
                    <strong class="font-medium text-gray-700">
                        Departure Time:</strong>
                    <span class="text-gray-600">{{ $bus->departure_time ? $bus->departure_time->format('d-m-Y H:i') : 'N/A' }}</span>
                </p>
                <p>
                    <strong class="font-medium text-gray-700">
                        Arrival Time:</strong>
                    <span class="text-gray-600">{{ $bus->arrival_time ? $bus->arrival_time->format('d-m-Y H:i') : 'N/A' }}</span>
                </p>
            </div>
        </div>

        <!-- Edit and Delete buttons -->
        <div class="mt-6 text-center">
            <a href="{{ route('admin.buses.edit', $bus) }}" class="inline-block mr-4">
                <x-primary-button>
                    Edit
                </x-primary-button>
            </a>

            <form action="{{ route('admin.buses.destroy', $bus) }}" method="POST" style="display: inline-block;">
                @csrf
                @method('DELETE')
                <x-primary-button type="submit" class="btn-danger" onclick="return confirm('Are you sure you want to delete this bus?')">
                    Delete
                </x-primary-button>
            </form>
        </div>

        <!-- Back to Buses Button -->
        <div class="mt-6 text-center">
            <a href="{{ route('admin.buses.index') }}">
                <x-primary-button>
                    Back to Buses
                </x-primary-button>
            </a>
        </div>
    </div>
@endsection
