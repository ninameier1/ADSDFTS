@extends('layouts.adminapp')

@php
    $header = 'Bustickets'
@endphp

@section('content')
    <div class="container mx-auto p-4">

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Search Form -->
        <form method="GET" action="{{ route('admin.bustickets.index') }}" class="mb-4">
            <div class="flex space-x-2">
                <x-text-input type="text" name="search" value="{{ $search }}" placeholder="Search by customer name, bus number, festival...">
                </x-text-input>
                <x-primary-button type="submit">
                    Search
                </x-primary-button>
                <a href="{{ route('admin.bustickets.index') }}">
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
                        Ticket Number
                    </th>
                    <th class="px-6 py-3 text-sm font-semibold text-dark dark:text-secondary">
                        First Name
                    </th>
                    <th class="px-6 py-3 text-sm font-semibold text-dark dark:text-secondary">
                        Last Name
                    </th>
                    <th class="px-6 py-3 text-sm font-semibold text-dark dark:text-secondary">
                        Bus Number
                    </th>
                    <th class="px-6 py-3 text-sm font-semibold text-dark dark:text-secondary">
                        Festival
                    </th>
                    <th class="px-6 py-3 text-sm font-semibold text-dark dark:text-secondary">
                        Seat Number
                    </th>
                    <th class="px-6 py-3 text-sm font-semibold text-dark dark:text-secondary">
                        Actions
                    </th>
                </tr>
                </thead>

                <tbody>
                @foreach($bustickets as $busticket)
                    <tr class="border-t border-gray-200">
                        <td class="px-6 py-4 text-sm text-dark dark:text-white">{{ $busticket->id }}</td>
                        <td class="px-6 py-4 text-sm text-dark dark:text-white">{{ $busticket->user->first_name }}</td>
                        <td class="px-6 py-4 text-sm text-dark dark:text-white">{{ $busticket->user->last_name }}</td>
                        <td class="px-6 py-4 text-sm text-dark dark:text-white">{{ $busticket->bus->bus_number }}</td>
                        <td class="px-6 py-4 text-sm text-dark dark:text-white">{{ $busticket->festival ? $busticket->festival->name : 'No Festival' }}</td>
                        <td class="px-6 py-4 text-sm text-dark dark:text-white">{{ $busticket->seat_number ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-sm">
                            <a href="{{ route('admin.bustickets.show', $busticket) }}">
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
