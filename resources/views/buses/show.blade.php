@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Bus Details</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Bus Number: {{ $bus->bus_number }}</h5>
                <p class="card-text">Capacity: {{ $bus->capacity }}</p>
                <p class="card-text">Festival: {{ $bus->festival->name ?? 'N/A' }}</p>
                <p class="card-text">Starting Point: {{ $bus->starting_point ?? 'N/A' }}</p>
                <p class="card-text">Departure Time: {{ $bus->departure_time ? $bus->departure_time->format('d-m-Y H:i') : 'N/A' }}</p>
                <p class="card-text">Arrival Time: {{ $bus->arrival_time ? $bus->arrival_time->format('d-m-Y H:i') : 'N/A' }}</p>

                <!-- Edit and Delete buttons -->
                <a href="{{ route('buses.edit', $bus) }}" class="btn btn-primary">Edit</a>

                <!-- Delete form -->
                <form action="{{ route('buses.destroy', $bus) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Are you sure you want to delete this bus?')">Delete</button>
                </form>
            </div>
        </div>

        <a href="{{ route('buses.index') }}" class="btn btn-secondary mt-3">Back to Buses</a>
    </div>
@endsection
