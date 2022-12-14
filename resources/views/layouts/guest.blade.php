<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('includes.heads')
        <title>{{ config('app.name', 'Laravel') }}</title>
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
    </body>
</html>
