@extends('layouts.app')

@php
    $header = 'Book a Busticket'
@endphp

@section('content')
    <div class="container">
        <form action="{{ route('bustickets.store') }}" method="POST">
            @csrf

            <!-- Festival Selection (pre-filled with the passed festival) -->
            <div class="form-group">
                <label for="festival_id">Festival</label>
                <select name="festival_id" id="festival_id" class="form-control" required>
                    <option value="">Select Festival</option>
                    @foreach($festivals as $festival)
                        <option value="{{ $festival->id }}"
                                @if(request()->get('festival') == $festival->name) selected @endif>
                            {{ $festival->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Starting Point (pre-filled with the passed starting point) -->
            <div class="form-group">
                <label for="from">Starting Point</label>
                <input type="text" name="from" id="from" class="form-control" value="{{ request()->get('from') }}" required>
            </div>

            <!-- User Information (pre-filled with the logged-in user's name) -->
            <div>
                <x-input-label for="first_name" :value="__('First Name')" />
                <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full" :value="old('first_name', $user->first_name)" required autofocus autocomplete="first_name" />
                <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
            </div>

            <div>
                <x-input-label for="last_name" :value="__('Last Name')" />
                <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" :value="old('last_name', $user->last_name)" required autofocus autocomplete="last_name" />
                <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
            </div>

            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>

            <!-- Hidden User ID (Automatically set to the logged-in user) -->
            <input type="hidden" name="user_id" value="{{ auth()->check() ? auth()->user()->id : '' }}">

            <!-- Submit Button -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Book Ticket</button>
            </div>
        </form>
    </div>
@endsection
