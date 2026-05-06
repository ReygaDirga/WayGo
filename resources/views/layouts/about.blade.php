<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'WayGo')</title>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">

    @vite([
        'resources/css/app.css',
        'resources/css/about.css',
        'resources/js/app.js',
        'resources/js/about.js',
    ])
</head>

<body class="bg-gray-100">

    @include('Component.navbar')

    <main>
        @yield('content')
    </main>

    @include('Component.footer')

</body>
</html>