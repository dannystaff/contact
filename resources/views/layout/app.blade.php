<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Contact</title>

        @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    </head>

    <body class="antialiased" id="app">
        @include('layout.header')
        @yield('content')
    </body>
</html>