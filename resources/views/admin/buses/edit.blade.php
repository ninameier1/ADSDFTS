@extends('layouts.adminapp')

@php
    $header = 'Edit Bus'
@endphp

@section('content')
    <div class="flex items-center justify-center min-h-screen px-4 py-8">
        <div class="max-w-4xl w-full bg-white dark:bg-secondary shadow-lg rounded-lg overflow-hidden mt-12">
            <div class="bg-primary dark:bg-dark text-white text-lg font-bold p-4">
                Bus Number: {{ $bus->bus_number }}
            </div>

            <div class="p-6 space-y-6">
                <form action="{{ route('admin.buses.update', $bus) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="bus_number" class="block text-gray-700 font-medium">
                            Bus Number
                        </label>
                        <input type="text" name="bus_number" id="bus_number" class="form-input mt-2 w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" value="{{ $bus->bus_number }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="capacity" class="block text-gray-700 font-medium">
                            Capacity
                        </label>
                        <input type="number" name="capacity" id="capacity" class="form-input mt-2 w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" value="{{ $bus->capacity }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="festival_id" class="block text-gray-700 font-medium">
                            Festival
                        </label>
                        <select name="festival_id" id="festival_id" class="form-select mt-2 w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" required>
                            @foreach($festivals as $festival)
                                <option value="{{ $festival->id }}" {{ $bus->festival_id == $festival->id ? 'selected' : '' }}>
                                    {{ $festival->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="starting_point" class="block text-gray-700 font-medium">
                            Starting Point
                        </label>
                        <input type="text" name="starting_point" id="starting_point" class="form-input mt-2 w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" value="{{ $bus->starting_point }}">
                    </div>

                    <div class="mb-4">
                        <label for="departure_time" class="block text-gray-700 font-medium">
                            Departure Time
                        </label>
                        <input type="datetime-local" name="departure_time" id="departure_time" class="form-input mt-2 w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" value="{{ $bus->departure_time }}">
                    </div>

                    <div class="mb-4">
                        <label for="arrival_time" class="block text-gray-700 font-medium">
                            Arrival Time
                        </label>
                        <input type="datetime-local" name="arrival_time" id="arrival_time" class="form-input mt-2 w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" value="{{ $bus->arrival_time }}">
                    </div>

                    <div class="mt-6 text-center">
                        <x-primary-button type="submit" class="btn-success">
                            Update Bus
                        </x-primary-button>
                    </div>
                </form>

                <div class="mt-6 text-center">
                    <a href="{{ route('admin.buses.show', $bus) }}">
                        <x-primary-button>
                            Back to Bus
                        </x-primary-button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
