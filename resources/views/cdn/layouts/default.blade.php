<!doctype html>
<html lang='en'>
<head>
    <meta charset='utf-8'>
    <title>@yield('metaTitle')</title>
    <meta name='description' content='@yield('metaDescription')'>
    <base href='{{ cdn() }}'>
    <link href='{{ cdn('favicon.ico') }}' rel='icon'>
    <link href='{{ cdn('favicon.ico') }}' rel='shortcut icon'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
</head>
<body>

<div class='wrapper-main'>
    <div class='container'>
        @yield('content')
    </div>
</div>
</body>
</html>