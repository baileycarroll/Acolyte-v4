<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>un-Traditional Magick: A learning platform for all things magickal</title>
    {{-- Custom CSS --}}
    <link rel="stylesheet" href="/css/acolyte.css">
    {{-- FontAwesome 6 Pro --}}
    <link rel="stylesheet" href="/css/fontawesome/css/all.css">
</head>
<body>
    @yield('main')
    {{-- Including app.js --}}
    <script src="{!! asset('js/mdb.min.js') !!}"></script>
    <script src="{!! asset('js/app.js') !!}"></script>
</body>
</html>
