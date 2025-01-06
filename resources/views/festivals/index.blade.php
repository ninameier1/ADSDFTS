@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Festivals</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('festivals.create') }}" class="btn btn-primary mb-3">Create New Festival</a>

        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Date</th>
                <th>Location</th>
                <th>Description</th>
                <th>Genre</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($festivals as $festival)
                <tr>
                    <td>{{ $festival->name }}</td>
                    <td>{{ $festival->date->format('Y-m-d') }}</td>
                    <td>{{ $festival->location }}</td>
                    <td>{{ $festival->description }}</td>
                    <td>{{ $festival->genre }}</td>
                    <td>
                        <!-- Edit Button -->
                        <a href="{{ route('festivals.edit', $festival) }}" class="btn btn-warning">Edit</a>

                        <!-- Delete Button -->
                        <a href="{{ route('festivals.destroy', $festival) }}" class="btn btn-danger"
                           onclick="event.preventDefault(); document.getElementById('delete-form-{{ $festival->id }}').submit();">
                            Delete
                        </a>
                        <form id="delete-form-{{ $festival->id }}" action="{{ route('festivals.destroy', $festival) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
