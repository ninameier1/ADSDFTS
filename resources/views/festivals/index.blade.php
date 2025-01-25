@extends('layouts.app')

@php
    $header = 'Festivals we travel to';
@endphp

@section('content')
    <!-- Festival Section -->
    <div class="py-8">
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

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($festivals as $festival)
                    <x-festival-card
                        :name="$festival->name"
                        :image="$festival->image"
                        :date="$festival->date->format('Y-m-d')"
                        :location="$festival->location"
                        :detailsRoute="route('festivals.show', $festival)"
                    />
                @endforeach
            </div>

        </div>
    </div>

@endsection

