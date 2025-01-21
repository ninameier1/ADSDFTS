@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $festival->name }}</h1>
        <p><strong>Date:</strong> {{ $festival->date->format('Y-m-d') }}</p>
        <p><strong>Location:</strong> {{ $festival->location }}</p>
        <p><strong>Description:</strong> {{ $festival->description }}</p>
        <p><strong>Genre:</strong> {{ $festival->genre }}</p>

        <a href="{{ route('bustickets.create') }}" class="btn btn-primary">
            Book a busticket
        </a>

        <a href="{{ route('festivals.index') }}" class="btn btn-primary">
            Back to Festivals
        </a>

    </div>
@endsection

