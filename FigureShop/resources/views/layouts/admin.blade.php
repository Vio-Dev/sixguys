<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50 flex flex-col justify-center">
    <div class="w-full bg-gray-800 text-white p-4">
        @include('layouts.admin.navigation')
    </div>
    <div class="flex gap-2 h-full">
        <div class="w-1/7">
            @include('layouts.admin.sidebar')
        </div>
        <div class="w-6/7 p-1">
            @yield('content')
        </div>
    </div>
</body>

</html>
