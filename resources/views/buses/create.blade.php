@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add New Bus</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('buses.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="bus_number" class="form-label">Bus Number</label>
                <input type="text" name="bus_number" id="bus_number" class="form-control" value="{{ old('bus_number') }}" required>
            </div>
            <div class="mb-3">
                <label for="capacity" class="form-label">Capacity</label>
                <input type="number" name="capacity" id="capacity" class="form-control" value="{{ old('capacity') }}" required>
            </div>
            <div class="mb-3">
                <label for="festival_id" class="form-label">Festival</label>
                <select name="festival_id" id="festival_id" class="form-control" required>
                    <option value="">Select Festival</option>
                    @foreach($festivals as $festival)
                        <option value="{{ $festival->id }}">{{ $festival->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="starting_point" class="form-label">Starting Point</label>
                <input type="text" name="starting_point" id="starting_point" class="form-control" value="{{ old('starting_point') }}">
            </div>
            <div class="mb-3">
                <label for="departure_time" class="form-label">Departure Time</label>
                <input type="datetime-local" name="departure_time" id="departure_time" class="form-control" value="{{ old('departure_time') }}">
            </div>
            <div class="mb-3">
                <label for="arrival_time" class="form-label">Arrival Time</label>
                <input type="datetime-local" name="arrival_time" id="arrival_time" class="form-control" value="{{ old('arrival_time') }}">
            </div>
            <button type="submit" class="btn btn-primary">Create Bus</button>
        </form>
    </div>
@endsection

