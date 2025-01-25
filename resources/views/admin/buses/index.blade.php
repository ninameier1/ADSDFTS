@extends('layouts.adminapp')

@php
    $header = 'Buses'
@endphp

@section('content')
    <div class="container mx-auto p-4">

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('admin.buses.create') }}">
            <x-primary-button>
                Create New Bus
            </x-primary-button>
        </a>

            <form method="GET" action="{{ route('admin.buses.index') }}" class="mb-4">
                <div class="flex space-x-2">
                    <x-text-input type="text" name="search" value="{{ $search }}" placeholder="Search by bus number, festival, id...">
                    </x-text-input>
                    <x-primary-button type="submit">
                        Search
                    </x-primary-button>
                    <a href="{{ route('admin.buses.index') }}">
                        <x-primary-button>
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
                        Bus Number
                    </th>
                    <th class="px-6 py-3 text-sm font-semibold text-dark dark:text-secondary">
                        Capacity
                    </th>
                    <th class="px-6 py-3 text-sm font-semibold text-dark dark:text-secondary">
                        Festival
                    </th>
                    <th class="px-6 py-3 text-sm font-semibold text-dark dark:text-secondary">
                        Starting Point
                    </th>
                    <th class="px-6 py-3 text-sm font-semibold text-dark dark:text-secondary">
                        Tickets Booked
                    </th>
                    <th class="px-6 py-3 text-sm font-semibold text-dark dark:text-secondary">
                        Status
                    </th>
                    <th class="px-6 py-3 text-sm font-semibold text-dark dark:text-secondary">
                        Actions
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($buses as $bus)
                    <tr class="border-t border-gray-200">
                        <td class="px-6 py-4 text-sm text-dark dark:text-white">{{ $bus->bus_number }}</td>
                        <td class="px-6 py-4 text-sm text-dark dark:text-white">{{ $bus->capacity }}</td>
                        <td class="px-6 py-4 text-sm text-dark dark:text-white">{{ $bus->festival->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-sm text-dark dark:text-white">{{ $bus->starting_point }}</td>
                        <td class="px-6 py-4 text-sm text-dark dark:text-white">{{ $bus->bustickets_count }}</td>
                        <td class="px-6 py-4 text-sm text-dark dark:text-white">{{ $bus->status }}</td>
                        <td class="px-6 py-4 text-sm">
                            <a href="{{ route('admin.buses.show', $bus) }}">
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
