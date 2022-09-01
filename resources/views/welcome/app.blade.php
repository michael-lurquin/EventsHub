<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Michaël Lurquin">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="antialiased font-sans text-sm text-gray-600">
        @includeIf('welcome.nav')

        @yield('content')
    </body>
</html>