@extends('layouts.adminapp')

@php
    $header = 'Festivals'
@endphp

@section('content')
    <div class="container mx-auto p-4">

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

            <a href="{{ route('admin.festivals.create') }}">
                <x-primary-button>
                    Create New Festival
                </x-primary-button>
            </a>

            <!-- Search Form -->
            <form method="GET" action="{{ route('admin.festivals.index') }}" class="mb-4">
                <div class="flex space-x-2">
                    <x-text-input type="text" name="search" value="{{ old('search', $search) }}" placeholder="Search by name, date, location...">
                    </x-text-input>
                    <x-primary-button type="submit">
                        Search
                    </x-primary-button>
                    <a href="{{ route('admin.festivals.index') }}">
                        <x-primary-button type="button">
                            Clear Search
                        </x-primary-button>
                    </a>
                </div>
            </form>

            <div class="overflow-x-auto shadow-lg rounded-lg mt-6">
                <table class="min-w-full bg-white dark:bg-secondary border border-gray-200">
                    <thead>
                        <tr class="bg-secondary dark:bg-dark text-left">
                            <th class="px-6 py-3 text-sm font-semibold text-dark dark:text-secondary">
                                <a href="{{ route('admin.festivals.index', ['sort' => 'name', 'direction' => $sortColumn === 'name' && $sortDirection === 'asc' ? 'desc' : 'asc', 'search' => $search]) }}">
                                    Name
                                    @if($sortColumn === 'name')
                                        <span>{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                                    @endif
                                </a>
                            </th>
                            <th class="px-6 py-3 text-sm font-semibold text-dark dark:text-secondary">
                                <a href="{{ route('admin.festivals.index', ['sort' => 'date', 'direction' => $sortColumn === 'date' && $sortDirection === 'asc' ? 'desc' : 'asc', 'search' => $search]) }}">
                                    Date
                                    @if($sortColumn === 'date')
                                        <span>{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                                    @endif
                                </a>
                            </th>
                            <th class="px-6 py-3 text-sm font-semibold text-dark dark:text-secondary">
                                <a href="{{ route('admin.festivals.index', ['sort' => 'location', 'direction' => $sortColumn === 'location' && $sortDirection === 'asc' ? 'desc' : 'asc', 'search' => $search]) }}">
                                    Location
                                    @if($sortColumn === 'location')
                                        <span>{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                                    @endif
                                </a>
                            </th>
                            <th class="px-6 py-3 text-sm font-semibold text-dark dark:text-secondary">
                                <a href="{{ route('admin.festivals.index', ['sort' => 'buses_count', 'direction' => $sortColumn === 'buses_count' && $sortDirection === 'asc' ? 'desc' : 'asc', 'search' => $search]) }}">
                                    Buses
                                    @if($sortColumn === 'buses_count')
                                        <span>{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                                    @endif
                                </a>
                            </th>
                            <th class="px-6 py-3 text-sm font-semibold text-dark dark:text-secondary">
                                <a href="{{ route('admin.festivals.index', ['sort' => 'bustickets_count', 'direction' => $sortColumn === 'bustickets_count' && $sortDirection === 'asc' ? 'desc' : 'asc', 'search' => $search]) }}">
                                    Tickets
                                    @if($sortColumn === 'bustickets_count')
                                        <span>{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                                    @endif
                                </a>
                            </th>
                            <th class="px-6 py-3 text-sm font-semibold text-dark dark:text-secondary">
                                Actions
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($festivals as $festival)
                        <tr class="border-t border-gray-200">
                            <td class="px-6 py-4 text-sm text-dark dark:text-white">{{ $festival->name }}</td>
                            <td class="px-6 py-4 text-sm text-dark dark:text-white">{{ $festival->date->format('Y-m-d') }}</td>
                            <td class="px-6 py-4 text-sm text-dark dark:text-white">{{ $festival->location }}</td>
                            <td class="px-6 py-4 text-sm text-dark dark:text-white">{{ $festival->buses_count }}</td>
                            <td class="px-6 py-4 text-sm text-dark dark:text-white">{{ $festival->bustickets_count }}</td>
                            <td class="px-6 py-4 text-sm">
                                <a href="{{ route('admin.festivals.show', $festival) }}">
                                    <x-secondary-button>
                                        Show
                                    </x-secondary-button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
@endsection
