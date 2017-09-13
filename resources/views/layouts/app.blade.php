<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DevClub</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('style')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <div id = "app"> @yield('content') </div>
    @stack('scripts')
</body>
</html>
