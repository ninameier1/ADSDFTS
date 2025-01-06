@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Bus Tickets</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Search Form -->
        <form method="GET" action="{{ route('bustickets.index') }}" class="mb-3">
            <div class="input-group">
                <input type="text" class="form-control" name="search" value="{{ $search }}" placeholder="Search by customer name, bus number, or festival">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </form>

        <a href="{{ route('bustickets.create') }}" class="btn btn-primary mb-3">Book New Ticket</a>

        <table class="table">
            <thead>
            <tr>
                <th>Customer Name</th>
                <th>Bus Number</th>
                <th>Festival</th>
                <th>Seat Number</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($bustickets as $busticket)
                <tr>
                    <td>{{ $busticket->user->name }}</td> <!-- Display the customer name -->
                    <td>{{ $busticket->bus->bus_number }}</td>
                    <td>{{ $busticket->festival->name }}</td>
                    <td>{{ $busticket->seat_number ?? 'N/A' }}</td>
                    <td>
                        <!-- Show Button -->
                        <a href="{{ route('bustickets.show', $busticket) }}" class="btn btn-info">Show</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
