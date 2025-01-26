<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Meta Tags -->
        <meta charset="utf-8">
        <meta name="author" content="Nina Meier">
        <meta name="description" content="Festibus">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Title -->
        <title>{{ config('app.name') }}</title>

        <!-- Favicon -->
        <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="font-sans antialiased">

        <div class="min-h-screen bg-neutral dark:bg-darkneutral">
            @include('layouts.adminnav')

            <!-- Page Heading -->
            @if(isset($header))
                <x-header>
                    {{ $header }}
                </x-header>
            @endif

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>

        </div>

        @include('layouts.footer')
    </body>
</html>

