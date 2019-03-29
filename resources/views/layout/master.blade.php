<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'MoneyQ')</title>

    <link href="/css/default.css" rel="stylesheet" type="text/css">
    <link href="/css/form.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Baloo+Chettan" rel="stylesheet">

</head>
<body>
@yield('content')

<div class="footer">
    <div class="wrapper">
        <div class="buttons">
            <a class="button small" href="{{route('lang', 'nl')}}">Nederlands</a>
            <a class="button small" href="{{route('lang', 'en')}}">English</a>
        </div>
    </div>
</div>
</body>
</html>