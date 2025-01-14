<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tiny.cloud/1/rw1556z5vgoik9fmr5u44kck2kqrsou9fmbylvglsyjovwur/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50 flex flex-col h-screen">
    <!-- Header -->
    <div class="w-full bg-gray-800 text-white p-4">
        @include('components.admin.navigation')
    </div>

    <!-- Main Container -->
    <div class="flex flex-1 gap-2">
        <!-- Sidebar -->
        <div class="w-[140px] bg-gray-800 h-full">
            @include('components.admin.sidebar')
        </div>

        <!-- Main Content -->
        <div class="flex-1">
            @yield('content')
        </div>
    </div>

    <!-- TinyMCE Script -->
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

</body>

</html>
