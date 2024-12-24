<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/tailwind-ecommerce.css" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div>
        @include('components.website.header')
    </div>
    <div>
        @include('components.website.nav')
    </div>
    <div class="container">
        <div>
            @include('components.website.banner')
            <main>
                @yield('content')
            </main>
            <div>
                @include('components.website.footer')
            </div>
        </div>
        src
</body>

</html>
