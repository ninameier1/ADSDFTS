@extends('layouts.app')

@php
    $header = 'Festivals we travel to';
@endphp

@section('content')
    <!-- Festival Section -->
    <div class="py-8 bg-gray-100">
        <div class="container mx-auto">

            <!-- Sorting Links -->
            <div class="text-center mb-6">
                <a href="{{ route('festivals.index', ['sort' => 'name', 'direction' => $sortColumn === 'name' && $sortDirection === 'asc' ? 'desc' : 'asc']) }}" class="text-blue-500 hover:underline mx-4">
                    Name
                    @if($sortColumn === 'name')
                        <span>{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                    @endif
                </a>
                <a href="{{ route('festivals.index', ['sort' => 'date', 'direction' => $sortColumn === 'date' && $sortDirection === 'asc' ? 'desc' : 'asc']) }}" class="text-blue-500 hover:underline mx-4">
                    Date
                    @if($sortColumn === 'date')
                        <span>{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                    @endif
                </a>
                <a href="{{ route('festivals.index', ['sort' => 'location', 'direction' => $sortColumn === 'location' && $sortDirection === 'asc' ? 'desc' : 'asc']) }}" class="text-blue-500 hover:underline mx-4">
                    Location
                    @if($sortColumn === 'location')
                        <span>{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                    @endif
                </a>
            </div>

            <!-- Festival Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($festivals as $festival)
                    <div class="bg-white shadow-lg rounded-lg p-6 text-center">
                        <h3 class="text-xl font-semibold text-darkneutral">{{ $festival->name }}</h3>
                        <img src="{{ asset('storage/' . $festival->image) }}" alt="{{ $festival->name }}" class="w-full h-40 object-cover rounded-md mb-4">
                        <p class="text-gray-600">{{ $festival->date->format('Y-m-d') }}</p>
                        <p class="text-gray-600">{{ $festival->location }}</p>
                        <a href="{{ route('festivals.show', $festival) }}">
                            <x-primary-button>
                                View Details
                            </x-primary-button>
                        </a>
                    </div>
                @endforeach
            </div>

        </div>
    </div>

@endsection

