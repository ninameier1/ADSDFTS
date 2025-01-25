<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
{{--        <link href="{{ mix('css/app.css') }}" rel="stylesheet">--}}

        <title>{{ config('app.name', 'Festibus') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="font-sans antialiased">

        <div class="min-h-screen bg-neutral dark:bg-darkneutral">
            @include('layouts.navigation')

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
