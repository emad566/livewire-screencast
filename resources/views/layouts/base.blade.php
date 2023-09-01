<!doctype html>
<html class="h-full bg-white">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

    
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>

    <script defer src="{{ asset('js/pikaday.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pikaday.css') }}">
    <script defer src="{{ asset('js/alpine.min.js') }}"></script>


    <livewire:styles />
</head>
<body class="h-full">
    @yield('content')

    <livewire:scripts />
</body>
</html>
