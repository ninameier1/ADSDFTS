@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Festivals</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('festivals.create') }}" class="btn btn-primary mb-3">Create New Festival</a>

        <table class="table">
{{--            <thead>--}}
{{--                <tr>--}}
{{--                    <th>Name</th>--}}
{{--                    <th>Date</th>--}}
{{--                    <th>Location</th>--}}
{{--                    <th>Description</th>--}}
{{--                    <th>Genre</th>--}}
{{--                    <th>Buses</th>--}}
{{--                    <th>Tickets</th>--}}
{{--                    <th>Actions</th>--}}
{{--                </tr>--}}
{{--            </thead>--}}
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
                <th>Description</th>
                <th>
                    <a href="{{ route('festivals.index', ['sort' => 'genre', 'direction' => $sortColumn === 'genre' && $sortDirection === 'asc' ? 'desc' : 'asc']) }}">
                        Genre
                        @if($sortColumn === 'genre')
                            <span>{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                        @endif
                    </a>
                </th>
                <th>
                    <a href="{{ route('festivals.index', ['sort' => 'buses_count', 'direction' => $sortColumn === 'buses_count' && $sortDirection === 'asc' ? 'desc' : 'asc']) }}">
                        Buses
                        @if($sortColumn === 'buses_count')
                            <span>{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                        @endif
                    </a>
                </th>
                <th>
                    <a href="{{ route('festivals.index', ['sort' => 'bustickets_count', 'direction' => $sortColumn === 'bustickets_count' && $sortDirection === 'asc' ? 'desc' : 'asc']) }}">
                        Tickets
                        @if($sortColumn === 'bustickets_count')
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
                    <td>{{ $festival->name }}</td>
                    <td>{{ $festival->date->format('Y-m-d') }}</td>
                    <td>{{ $festival->location }}</td>
                    <td>{{ $festival->description }}</td>
                    <td>{{ $festival->genre }}</td>
                    <td>{{ $festival->buses_count }}</td> <!-- Show buses count -->
                    <td>{{ $festival->bustickets_count }}</td> <!-- Show tickets count -->
                    <td>
                        <a href="{{ route('festivals.edit', $festival) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ route('festivals.destroy', $festival) }}" class="btn btn-danger"
                           onclick="event.preventDefault(); document.getElementById('delete-form-{{ $festival->id }}').submit();">
                            Delete
                        </a>
                        <form id="delete-form-{{ $festival->id }}" action="{{ route('festivals.destroy', $festival) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>
    </div>
@endsection
