@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Book a New Ticket</h1>

        <form action="{{ route('bustickets.store') }}" method="POST">
            @csrf

            <!-- Festival Selection -->
            <div class="form-group">
                <label for="festival_id">Festival</label>
                <select name="festival_id" id="festival_id" class="form-control" required>
                    <option value="">Select Festival</option>
                    @foreach($festivals as $festival)
                        <option value="{{ $festival->id }}">{{ $festival->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Hidden User ID (Automatically set to the logged-in user) -->
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

            <!-- Submit Button -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Book Ticket</button>
            </div>
        </form>
    </div>
@endsection
