<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token}}">
        <title>@yield('title', 'Simple PMS')</title>
    </head>

    <body>
        @yield('content')
    </body>
</html>
