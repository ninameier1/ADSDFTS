@extends('layouts.app')

@php
    $header = 'Festivals we travel to';
@endphp

@section('content')
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th>
                    <a href="{{ route('festivals.index', ['sort' => 'name', 'direction' => $sortColumn === 'name' && $sortDirection === 'asc' ? 'desc' : 'asc']) }}">
                        Name
                        @if($sortColumn === 'name')
                            <span>{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                        @endif
                    </a>
                </th>
                <th>
                    <a href="{{ route('festivals.index', ['sort' => 'date', 'direction' => $sortColumn === 'date' && $sortDirection === 'asc' ? 'desc' : 'asc']) }}">
                        Date
                        @if($sortColumn === 'date')
                            <span>{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                        @endif
                    </a>
                </th>
                <th>
                    <a href="{{ route('festivals.index', ['sort' => 'location', 'direction' => $sortColumn === 'location' && $sortDirection === 'asc' ? 'desc' : 'asc']) }}">
                        Location
                        @if($sortColumn === 'location')
                            <span>{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                        @endif
                    </a>
                </th>
                <th>Actions</th>
            </tr>
            </thead>

            <tbody>
            @foreach($festivals as $festival)
                <tr>
                    <td>{{ $festival->name }}</td> <!-- Link to show page -->
                    <td>{{ $festival->date->format('Y-m-d') }}</td>
                    <td>{{ $festival->location }}</td>
                    <td>
                        <!-- Show Button -->
                        <a href="{{ route('festivals.show', $festival) }}" class="btn btn-info">Show</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
@endsection

