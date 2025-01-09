@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $festival->name }}</h1>
        <p><strong>Date:</strong> {{ $festival->date->format('Y-m-d') }}</p>
        <p><strong>Location:</strong> {{ $festival->location }}</p>
        <p><strong>Description:</strong> {{ $festival->description }}</p>
        <p><strong>Genre:</strong> {{ $festival->genre }}</p>
        <p><strong>Buses:</strong> {{ $festival->buses_count }}</p>
        <p><strong>Tickets:</strong> {{ $festival->bustickets_count }}</p>

        <h2>Buses for this Festival</h2>
        <table class="table">
            <thead>
            <tr>
                <th>Bus Number</th>
                <th>Status</th>
                <th>Capacity</th>
                <th>Tickets Sold</th>
            </tr>
            </thead>
            <tbody>
            @foreach($festival->buses as $bus)
                <tr>
                    <td>{{ $bus->bus_number }}</td>
                    <td>{{ ucfirst($bus->status) }}</td>
                    <td>{{ $bus->capacity }}</td>
                    <td>{{ $bus->soldTicketsCount() }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <!-- Edit button -->
        <a href="{{ route('festivals.edit', $festival) }}" class="btn btn-warning">
            Edit Festival
        </a>

        <!-- Delete button with double check -->
        <form action="{{ route('festivals.destroy', $festival) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this festival?')">Delete Festival</button>
        </form>

        <a href="{{ route('festivals.index') }}" class="btn btn-primary">
            Back to Festivals
        </a>
    </div>
@endsection

