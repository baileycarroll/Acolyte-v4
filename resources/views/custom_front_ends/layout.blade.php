<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>un-Traditional Magick: A place for any and all to learn magick, un-traditionally.</title>
    {{-- Custom CSS --}}
    <link rel="stylesheet" href="/css/acolyte.css">
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    {{-- FontAwesome 6 Pro --}}
    <link rel="stylesheet" href="/css/fontawesome/css/all.css">
</head>
{{-- Google Analytics--}}
<script async src="https://www.googletagmanager.com/gtag/js?id=G-TX4651GWPT"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-TX4651GWPT');
</script>
<body>
    @yield('main')
    {{-- Including app.js --}}
    <script src="{!! asset('js/mdb.min.js') !!}"></script>
    <script src="{!! asset('js/app.js') !!}"></script>
</body>
</html>
