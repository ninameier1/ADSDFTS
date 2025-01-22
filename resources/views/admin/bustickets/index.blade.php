@extends('layouts.adminapp')

@section('content')
    <div class="container">
        <h1>Bus Tickets</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Search Form -->
        <form method="GET" action="{{ route('admin.bustickets.index') }}" class="mb-3">
            <div class="input-group">
                <input type="text" class="form-control" name="search" value="{{ $search }}" placeholder="Search by customer name, bus number, or festival">
                <button class="btn btn-primary" type="submit">Search</button>
                <!-- Clear Search Button -->
                <a href="{{ route('admin.bustickets.index') }}" class="btn btn-secondary">Clear Search</a>
            </div>
        </form>

        <table class="table">
            <thead>
            <tr>
                <th>Customer First Name</th>
                <th>Customer Last Name</th>
                <th>Bus Number</th>
                <th>Festival</th>
                <th>Seat Number</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($bustickets as $busticket)
                <tr>
                    <td>{{ $busticket->user->first_name }}</td>
                    <td>{{ $busticket->user->last_name }}</td>
                    <td>{{ $busticket->bus->bus_number }}</td>
                    <td>{{ $busticket->festival ? $busticket->festival->name : 'No Festival' }}</td>
                    <td>{{ $busticket->seat_number ?? 'N/A' }}</td>
                    <td>
                        <!-- Show Button -->
                        <a href="{{ route('admin.bustickets.show', $busticket) }}" class="btn btn-info">Show</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
