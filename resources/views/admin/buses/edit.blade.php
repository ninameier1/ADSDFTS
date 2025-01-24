@extends('layouts.adminapp')

@php
    $header = 'Edit Bus'
@endphp

@section('content')
    <div class="container">
        <form action="{{ route('admin.buses.update', $bus) }}" method="POST">
            @csrf

            @method('PUT')
            <div class="mb-3">
                <label for="bus_number" class="form-label">
                    Bus Number
                </label>
                <input type="text" name="bus_number" id="bus_number" class="form-control" value="{{ $bus->bus_number }}" required>
            </div>

            <div class="mb-3">
                <label for="capacity" class="form-label">
                    Capacity
                </label>
                <input type="number" name="capacity" id="capacity" class="form-control" value="{{ $bus->capacity }}" required>
            </div>

            <div class="mb-3">
                <label for="festival_id" class="form-label">
                    Festival
                </label>
                <select name="festival_id" id="festival_id" class="form-control" required>
                    @foreach($festivals as $festival)
                        <option value="{{ $festival->id }}" {{ $bus->festival_id == $festival->id ? 'selected' : '' }}>
                            {{ $festival->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="starting_point" class="form-label">
                    Starting Point
                </label>
                <input type="text" name="starting_point" id="starting_point" class="form-control" value="{{ $bus->starting_point }}">
            </div>

            <div class="mb-3">
                <label for="departure_time" class="form-label">
                    Departure Time
                </label>
                <input type="datetime-local" name="departure_time" id="departure_time" class="form-control" value="{{ $bus->departure_time }}">
            </div>

            <div class="mb-3">
                <label for="arrival_time" class="form-label">
                    Arrival Time
                </label>
                <input type="datetime-local" name="arrival_time" id="arrival_time" class="form-control" value="{{ $bus->arrival_time }}">
            </div>

            <x-primary-button type="submit">
                Update Bus
            </x-primary-button>
        </form>

        <!-- Return Button -->
        <a href="{{ route('admin.buses.show', $bus) }}">
            <x-primary-button>
                Back to Bus
            </x-primary-button>
        </a>
    </div>
@endsection
