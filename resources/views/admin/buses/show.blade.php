@extends('layouts.adminapp')

@php
    $header = 'Bus Details'
@endphp

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">

                <!-- Bus Information -->
                <h5 class="card-title">Bus Number: {{ $bus->bus_number }}</h5>
                <p class="card-text">Capacity: {{ $bus->capacity }}</p>
                <p class="card-text">Festival: {{ $bus->festival->name ?? 'N/A' }}</p>
                <p class="card-text">Starting Point: {{ $bus->starting_point ?? 'N/A' }}</p>
                <p class="card-text">Departure Time: {{ $bus->departure_time ? $bus->departure_time->format('d-m-Y H:i') : 'N/A' }}</p>
                <p class="card-text">Arrival Time: {{ $bus->arrival_time ? $bus->arrival_time->format('d-m-Y H:i') : 'N/A' }}</p>

                <!-- Edit and Delete buttons -->
                <a href="{{ route('admin.buses.edit', $bus) }}" class="btn btn-primary">
                    <x-primary-button>
                        Edit
                    </x-primary-button>
                </a>

                <!-- Delete form -->
                <form action="{{ route('admin.buses.destroy', $bus) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <x-primary-button type="submit" class="btn-danger" onclick="return confirm('Are you sure you want to delete this bus?')">
                        Delete
                    </x-primary-button>
                </form>
            </div>
        </div>

        <a href="{{ route('admin.buses.index') }}" class="btn btn-secondary mt-3">
            <x-primary-button>
                Back to Buses
            </x-primary-button>
        </a>
    </div>
@endsection
