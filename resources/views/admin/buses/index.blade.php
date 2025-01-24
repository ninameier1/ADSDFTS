@extends('layouts.adminapp')

@php
    $header = 'Buses'
@endphp

@section('content')
    <div class="container">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

            <a href="{{ route('admin.buses.create') }}">
                <x-primary-button>Create New Bus</x-primary-button>
            </a>


            <table class="table">
                <thead>
                    <tr>
                        <th>Bus Number</th>
                        <th>Capacity</th>
                        <th>Festival</th>
                        <th>Starting point</th>
                        <th>Tickets Booked</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            <tbody>

            @foreach($buses as $bus)
                <tr>
                    <td>{{ $bus->bus_number }}</td>
                    <td>{{ $bus->capacity }}</td>
                    <td>{{ $bus->festival->name ?? 'N/A' }}</td>
                    <td>{{ $bus->starting_point }}</td>
                    <td>{{ $bus->bustickets_count }}</td>
                    <td>{{ $bus->status }}</td>
                    <td>
                        <a href="{{ route('admin.buses.show', $bus) }}">
                            <x-primary-button>
                                Show
                            </x-primary-button>
                        </a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@endsection
