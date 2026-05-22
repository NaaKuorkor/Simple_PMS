<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token()}}">
        @vite(['resources/css/app.css'])
        <title>@yield('title', 'Simple PMS')</title>
    </head>

    <body class="min-h-screen justify-center items-center bg-brand-white ">
        @yield('content')
    </body>
</html>
