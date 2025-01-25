@extends('layouts.app')

@php
$header = 'My Booked Tickets'
@endphp

@section('content')

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container">
        @if($bustickets->isEmpty())
            <p>No tickets found.</p>
        @else
            <table class="table">
                <thead>
                <tr>
                    <th>Customer First Name</th>
                    <th>Customer Last Name</th>
                    <th>Festival</th>
                    <th>Seat Number</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($bustickets as $busticket)
                    <tr>
                        <td>{{ $busticket->user->first_name }}</td>
                        <td>{{ $busticket->user->last_name }}</td>
                        <td>{{ $busticket->festival ? $busticket->festival->name : 'No Festival' }}</td>
                        <td>{{ $busticket->seat_number ?? 'N/A' }}</td>
                        <td>
                            <!-- Show Button -->
                            <a href="{{ route('bustickets.show', $busticket) }}" class="btn btn-info">Show</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection

