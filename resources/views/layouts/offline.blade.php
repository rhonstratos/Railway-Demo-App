<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('includes.heads')
        <title>{{ config('app.name', 'Laravel') }}</title>
    </head>
    <body class="font-sans antialiased">
        @yield('content')
    </body>
</html>
