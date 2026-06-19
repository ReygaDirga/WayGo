<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/Logo1.png') }}" />
    <title>@yield('title', 'WayGo')</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])
</head>

<body class="bg-gray-100">

    @include('Component.navbar', ['transparentNavbar' => true])

    <main>
        @yield('content')
    </main>

    @include('Component.footer')

</body>
</html>