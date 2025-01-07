@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Bus Ticket</h1>

        <form action="{{ route('bustickets.update', $busticket) }}" method="POST">
            @csrf
            @method('PUT')
            <p><strong>Customer Name:</strong> {{ $busticket->user->name }}</p>

            <div class="form-group">
                <label for="bus_id">Bus</label>
                <select class="form-control" id="bus_id" name="bus_id" required>
                    @foreach($buses as $bus)
                        <option value="{{ $bus->id }}" {{ $bus->id == $busticket->bus_id ? 'selected' : '' }}>
                            {{ $bus->bus_number }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="seat_number">Seat Number</label>
                <input type="number" class="form-control" id="seat_number" name="seat_number" value="{{ $busticket->seat_number }}" required min="1" max="35">
            </div>

            <button type="submit" class="btn btn-success">Update Ticket</button>
        </form>

        <a href="{{ route('bustickets.show', $busticket->id) }}" class="btn btn-primary">
            Back to Ticket
        </a>
    </div>
@endsection
