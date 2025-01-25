@extends('layouts.adminapp')

@php
    $header = 'Edit Festival'
@endphp

@section('content')
    <div class="flex items-center justify-center min-h-screen bg-gray-100 px-4 py-8">
        <div class="max-w-4xl w-full bg-white dark:bg-secondary shadow-lg rounded-lg overflow-hidden mt-12">
            <div class="bg-primary dark:bg-dark text-white text-lg font-bold p-4">
                {{ $festival->name }}
            </div>

            <div class="p-6 space-y-6">
                <form action="{{ route('admin.festivals.update', $festival) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-medium">
                            Name
                        </label>
                        <input type="text" name="name" id="name" value="{{ $festival->name }}" class="form-input mt-2 w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" required>
                    </div>

                    <div class="mb-4">
                        <label for="date" class="block text-gray-700 font-medium">
                            Date
                        </label>
                        <input type="date" name="date" id="date" value="{{ $festival->date->format('Y-m-d') }}" class="form-input mt-2 w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" required>
                    </div>

                    <div class="mb-4">
                        <label for="location" class="block text-gray-700 font-medium">
                            Location
                        </label>
                        <input type="text" name="location" id="location" value="{{ $festival->location }}" class="form-input mt-2 w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" required>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 font-medium">
                            Description
                        </label>
                        <textarea name="description" id="description" class="form-textarea mt-2 w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" required>{{ $festival->description }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="genre" class="block text-gray-700 font-medium">
                            Genre
                        </label>
                        <input type="text" name="genre" id="genre" value="{{ $festival->genre }}" class="form-input mt-2 w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                    </div>

                    <div class="mb-4">
                        <label for="image" class="block text-gray-700 font-medium">
                            Image
                        </label>
                        @if ($festival->image)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $festival->image) }}" alt="{{ $festival->name }}" class="w-40 h-40 object-cover mb-4">
                                <p class="text-sm text-gray-500">
                                    Current Image
                                </p>
                            </div>
                        @endif
                        <input type="file" id="image" name="image" accept="image/*" class="mt-2 block w-full text-sm text-gray-700 border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                    </div>

                    <div class="mt-6 text-center">
                        <x-primary-button type="submit" class="btn-success">
                            Update Festival
                        </x-primary-button>
                    </div>
                </form>

                <div class="mt-6 text-center">
                    <a href="{{ route('admin.festivals.show', $festival->id) }}">
                        <x-primary-button>
                            Back to Festival
                        </x-primary-button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
