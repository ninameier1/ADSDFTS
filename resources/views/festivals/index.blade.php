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
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($festivals as $festival)
                <tr>
                    <form action="{{ route('festivals.update', $festival) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <td>
                            <input type="text" name="name" value="{{ $festival->name }}" class="form-control" required>
                        </td>
                        <td>
                            <input type="date" name="date" value="{{ $festival->date->format('Y-m-d') }}" class="form-control" required>
                        </td>
                        <td>
                            <input type="text" name="location" value="{{ $festival->location }}" class="form-control" required>
                        </td>
                        <td>
                            <input type="text" name="description" value="{{ $festival->description }}" class="form-control" required>
                        </td>
                        <td>
                            <button type="submit" class="btn btn-success">Update</button>
                        </td>
                    </form>
                    <td>
                        <a href="{{ route('festivals.destroy', $festival) }}" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $festival->id }}').submit();">Delete</a>

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
