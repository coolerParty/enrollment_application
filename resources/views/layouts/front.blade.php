<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:200,400&display=swap" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles

</head>

<body class="min-h-full antialiased">
    <!--Nav-->
    <x-nav-menu-component></x-nav-menu-component>


    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
    <x-footer-component></x-footer-component>

    @stack('modals')
    @livewireScripts
    @stack('scripts')

</body>

</html>
