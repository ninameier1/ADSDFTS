@extends('layouts.adminapp')

@php
    $header = $festival->name;
@endphp

@section('content')
    <div class="flex items-center justify-center min-h-screen px-4 py-8">
        <div class="max-w-4xl w-full bg-white dark:bg-secondary shadow-lg rounded-lg overflow-hidden mt-12">
            <div class="bg-primary dark:bg-dark text-white text-lg font-bold p-4">
                {{ $festival->name }}
            </div>

            <div class="p-6 space-y-4">
                <p>
                    <strong class="font-medium text-gray-700">
                        Date:
                    </strong>
                    <span class="text-gray-600">{{ $festival->date->format('Y-m-d') }}</span>
                </p>
                <p>
                    <strong class="font-medium text-gray-700">
                        Location:
                    </strong>
                    <span class="text-gray-600">{{ $festival->location }}</span>
                </p>
                <p>
                    <strong class="font-medium text-gray-700">
                        Description:
                    </strong>
                    <span class="text-gray-600">{{ $festival->description }}</span>
                </p>
                <p>
                    <strong class="font-medium text-gray-700">
                        Genre:
                    </strong>
                    <span class="text-gray-600">{{ $festival->genre }}</span>
                </p>
                <p>
                    <strong class="font-medium text-gray-700">
                        Buses:
                    </strong>
                    <span class="text-gray-600">{{ $festival->buses_count }}</span>
                </p>
                <p>
                    <strong class="font-medium text-gray-700">
                        Tickets:
                    </strong>
                    <span class="text-gray-600">{{ $festival->bustickets_count }}</span>
                </p>
            </div>

            <!-- Buses Table -->
            <div class="p-6">
                <h2 class="text-xl font-semibold mb-4">Buses for this Festival</h2>
                <table class="min-w-full table-auto border-collapse">
                    <thead>
                    <tr class="bg-gray-100">
                        <th class="py-2 px-4 border-b">Bus Number</th>
                        <th class="py-2 px-4 border-b">Starting Point</th>
                        <th class="py-2 px-4 border-b">Status</th>
                        <th class="py-2 px-4 border-b">Capacity</th>
                        <th class="py-2 px-4 border-b">Tickets Sold</th>
                        <th class="py-2 px-4 border-b">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($festival->buses as $bus)
                        <tr class="bg-white hover:bg-gray-50">
                            <td class="py-2 px-4 border-b">{{ $bus->bus_number }}</td>
                            <td class="py-2 px-4 border-b">{{ $bus->starting_point }}</td>
                            <td class="py-2 px-4 border-b">{{ ucfirst($bus->status) }}</td>
                            <td class="py-2 px-4 border-b">{{ $bus->capacity }}</td>
                            <td class="py-2 px-4 border-b">{{ $bus->soldTicketsCount() }}</td>
                            <td class="py-2 px-4 border-b text-center">
                                <a href="{{ route('admin.buses.show', $bus) }}" class="text-blue-600 hover:text-blue-800">
                                    Show
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Edit and Delete buttons -->
            <div class="mt-6 text-center">
                <a href="{{ route('admin.festivals.edit', $festival) }}" class="inline-block mr-4">
                    <x-primary-button>
                        Edit Festival
                    </x-primary-button>
                </a>

                <form action="{{ route('admin.festivals.destroy', $festival) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <x-primary-button type="submit" class="btn-danger" onclick="return confirm('Are you sure you want to delete this festival?')">
                        Delete Festival
                    </x-primary-button>
                </form>
            </div>

            <!-- Back to Festivals Button -->
            <div class="mt-6 text-center">
                <a href="{{ route('admin.festivals.index') }}">
                    <x-primary-button>
                        Back to Festivals
                    </x-primary-button>
                </a>
            </div>
        </div>
    </div>
@endsection
