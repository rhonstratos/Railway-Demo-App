<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('includes.heads')
    @yield('pageTitle')
</head>
<body>
    <div class="bg-slate-500 m-auto p-10">
        @yield('content')
    </div>
</body>
</html>
