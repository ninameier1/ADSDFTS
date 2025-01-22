
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Buses</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('admin.buses.create') }}" class="btn btn-primary mb-3">Add New Bus</a>

        <table class="table">
            <thead>
            <tr>
                <th>Bus Number</th>
                <th>Capacity</th>
                <th>Festival</th>
                <th>Starting point</th>
                <th>Tickets Booked</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($buses as $bus)
                <tr>
                    <td>{{ $bus->bus_number }}</td>
                    <td>{{ $bus->capacity }}</td>
                    <td>{{ $bus->festival->name ?? 'N/A' }}</td>
                    <td>{{ $bus->starting_point }}</td>
                    <td>{{ $bus->bustickets_count }}</td>
                    <td>
                        <a href="{{ route('admin.buses.show', $bus) }}" class="btn btn-info">Show</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
