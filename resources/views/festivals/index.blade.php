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
                    <td>{{ $festival->name }}</td> <!-- Link to show page -->
                    <td>{{ $festival->date->format('Y-m-d') }}</td>
                    <td>{{ $festival->location }}</td>
                    <td>{{ $festival->buses_count }}</td>
                    <td>{{ $festival->bustickets_count }}</td>
                    <td>
                        <!-- Show Button -->
                        <a href="{{ route('festivals.show', $festival) }}" class="btn btn-info">Show</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
