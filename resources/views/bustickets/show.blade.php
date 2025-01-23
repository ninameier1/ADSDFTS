@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Busticket Details</h1>

        <div class="card">
            <div class="card-header">
                Busticket #{{ $busticket->id }}
            </div>
            <div class="card-body">
                <p><strong>Festival:</strong> {{ $busticket->festival ? $busticket->festival->name : 'No Festival' }}</p>
                <p><strong>Starting Point:</strong> {{ $busticket->bus->starting_point ?? 'N/A' }}</p>
                <p><strong>Customer First Name:</strong> {{ $busticket->user->first_name }}</p>
                <p><strong>Customer Last Name:</strong> {{ $busticket->user->last_name }}</p>
                <p><strong>Bus Number:</strong> {{ $busticket->bus->bus_number }}</p>
                <p><strong>Seat Number:</strong> {{ $busticket->seat_number ?? 'N/A' }}</p>
                <p><strong>Booking Date:</strong> {{ $busticket->created_at->format('Y-m-d H:i') }}</p>
            </div>
        </div>

        <!-- Back to Tickets Button -->
        <a href="{{ route('bustickets.index') }}" class="btn btn-primary mt-3">Back to Bustickets</a>
    </div>
@endsection

