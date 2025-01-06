@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Ticket Details</h1>

        <div class="card">
            <div class="card-header">
                Ticket Information
            </div>
            <div class="card-body">
                <p><strong>Customer Name:</strong> {{ $busticket->user->name }}</p>
                <p><strong>Bus Number:</strong> {{ $busticket->bus->bus_number }}</p>
                <p><strong>Festival:</strong> {{ $busticket->festival->name }}</p>
                <p><strong>Seat Number:</strong> {{ $busticket->seat_number ?? 'N/A' }}</p>
                <p><strong>Booking Date:</strong> {{ $busticket->created_at->format('Y-m-d H:i') }}</p>
            </div>
        </div>

        <!-- Edit and Delete Buttons -->
        <div class="mt-3">
            <a href="{{ route('bustickets.edit', $busticket) }}" class="btn btn-warning">Edit</a>

            <form action="{{ route('bustickets.destroy', $busticket) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this ticket?')">Delete</button>
            </form>
        </div>

        <!-- Back to Tickets Button -->
        <a href="{{ route('bustickets.index') }}" class="btn btn-primary mt-3">Back to Tickets</a>
    </div>
@endsection
