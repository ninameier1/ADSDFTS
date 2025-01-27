@extends('layouts.adminapp')

@section('content')
    <div class="flex items-center justify-center min-h-screen px-4 py-8">
        <div class="max-w-4xl w-full bg-white dark:bg-secondary shadow-lg rounded-lg overflow-hidden mt-12">
            <div class="bg-primary dark:bg-dark text-white text-lg font-bold p-4">
                Create a New Festival
            </div>

            <div class="p-6 space-y-6">
                <form action="{{ route('admin.festivals.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-medium">
                            Name
                        </label>
                        <input type="text" name="name" id="name" class="form-input mt-2 w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" value="{{ old('name') }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="location" class="block text-gray-700 font-medium">
                            Location
                        </label>
                        <input type="text" name="location" id="location" class="form-input mt-2 w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" value="{{ old('location') }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="date" class="block text-gray-700 font-medium">
                            Date
                        </label>
                        <input type="date" name="date" id="date" class="form-input mt-2 w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" value="{{ old('date') }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 font-medium">
                            Description
                        </label>
                        <textarea name="description" id="description" class="form-input mt-2 w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" rows="5" required>{{ old('description') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="genre" class="block text-gray-700 font-medium">
                            Genre
                        </label>
                        <input type="text" name="genre" id="genre" class="form-input mt-2 w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" value="{{ old('genre') }}">
                        <small class="text-sm text-gray-500">
                            Optional: Specify the genre of the festival (e.g., Rock, Jazz).
                        </small>
                    </div>

                    <div class="mb-4">
                        <label for="image" class="block text-gray-700 font-medium">
                            Image
                        </label>
                        <input type="file" id="image" name="image" class="form-input mt-2 w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" accept="image/*">
                    </div>

                    <div class="mt-6 text-center">
                        <x-primary-button type="submit" class="btn-success">
                            Create Festival
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
