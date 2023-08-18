<!doctype html>
<html class="h-full bg-white">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

    @vite('resources/css/app.css')

    <livewire:styles />
</head>
<body class="h-full">
    @yield('content')
    {{ $slot }}

    <livewire:scripts />
</body>
</html>
