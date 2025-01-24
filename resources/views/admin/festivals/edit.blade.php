@extends('layouts.adminapp')

@section('content')
    <div class="container">
        <h1>Edit Festival</h1>

        <form action="{{ route('admin.festivals.update', $festival) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">
                    Name
                </label>
                <input type="text" name="name" id="name" value="{{ $festival->name }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="date" class="form-label">
                    Date
                </label>
                <input type="date" name="date" id="date" value="{{ $festival->date->format('Y-m-d') }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="location" class="form-label">
                    Location
                </label>
                <input type="text" name="location" id="location" value="{{ $festival->location }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">
                    Description
                </label>
                <textarea name="description" id="description" class="form-control" required>{{ $festival->description }}</textarea>
            </div>

            <div class="mb-3">
                <label for="genre" class="form-label">
                    Genre
                </label>
                <input type="text" name="genre" id="genre" value="{{ $festival->genre }}" class="form-control">
            </div>

            <div>
                <label for="image">Image:</label>
                @if ($festival->image)
                    <img src="{{ asset('storage/' . $festival->image) }}" alt="{{ $festival->name }}" class="w-40 h-40 object-cover mb-4">
                    <p>
                        Current Image
                    </p>
                @endif
                <input type="file" id="image" name="image" accept="image/*">
            </div>

            <x-primary-button type="submit" class="btn btn-success">
                Update Festival
            </x-primary-button>

        </form>

        <a href="{{ route('admin.festivals.show', $festival->id) }}" class="btn btn-primary">
            <x-primary-button>
                Back to Festival
            </x-primary-button>
        </a>

    </div>
@endsection
