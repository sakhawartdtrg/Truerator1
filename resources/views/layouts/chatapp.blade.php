<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'TrueRator') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="icon" href="{{ asset('assets/images/favicon/favicon-32.png') }}"  sizes="32x32">
        <link rel="icon" href="{{ asset('assets/images/favicon/favicon-128.png') }}"  sizes="128x128">
        <link rel="icon" href="{{ asset('assets/images/favicon/favicon-192.png') }}"  sizes="192x192">

        <!-- Android -->
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon/favicon-196.png') }}"  sizes="196x196">

        <!-- iOS -->
        <link rel="apple-touch-icon" href="{{ asset('assets/images/favicon/favicon-152.png') }}"  sizes="152x152">
        <link rel="apple-touch-icon" href="{{ asset('assets/images/favicon/favicon-167.png') }}"  sizes="167x167">
        <link rel="apple-touch-icon" href="{{ asset('assets/images/favicon/favicon-180.png') }}"  sizes="180x180">

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />

    </head>
    <body aria-expanded="false">
        @include('sweetalert::alert')
        @include('layouts.navigation')
        <main class="workspace" id="app">
            @yield('content')
        </main>
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('assets/js/vendor.js') }}"></script>
        <script src="{{ asset('assets/js/Chart.min.js') }}"></script>
        <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script> -->
        <script src="{{ asset('assets/js/ckeditor.js') }}"></script>
        <script src="{{ asset('assets/js/Sortable.min.js') }}"></script>
        <script src="{{ asset('assets/js/glide.min.js') }}"></script>
        <script src="{{ asset('assets/js/script.js') }}"></script>
        @stack('scripts')
    </body>
</html>
