@extends('layouts.app')

@php
$header = 'Profile settings'
@endphp

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Dark Mode Toggle -->
            <div class="p-4 sm:p-8 bg-white dark:bg-dark shadow sm:rounded-lg">
                <header>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        Dark Mode
                    </h2>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Dark mode makes the colours of the website easier on the eyes in dark environments. You can always change this setting later.
                    </p>
                </header>
                <div class="flex items-center mx-2 my-2 gap-4">
                    <input type="checkbox" id="darkModeToggle" class="toggle-checkbox mx-2 my-2 ">
                    <label for="darkModeToggle" class="text-dark dark:text-white">
                        Enable dark mode
                    </label>
                </div>
            </div>

            <!-- Other Profile Options -->
            <div class="p-4 sm:p-8 bg-white dark:bg-dark shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-dark shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-dark shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
@endsection
