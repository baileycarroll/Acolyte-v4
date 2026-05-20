<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ $subject }}</title>
</head>
<body>
<img src="{{ $message->embed(public_path()."/assets/img/uTM_Logo.gif") }}" alt="un-Traditional Magick Logo">

<h3>You have a note from {{$author}}</h3>

{!! $body !!}

</body>
</html>
