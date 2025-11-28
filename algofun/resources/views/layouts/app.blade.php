<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AlgoFun - @yield('title', 'Dashboard')</title>

    @vite('resources/css/app.css')
    <script defer src="//unpkg.com/alpinejs"></script>
    {{-- SCRIPT --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Fredoka:wght@600&family=Nunito:wght@600;800&display=swap"
        rel="stylesheet">
</head>

<body class="bg-[#FFF9F5] text-[#555555] min-h-screen font-nunito">

    <div x-data="{ open: true }" class="flex min-h-screen">
        @if (Str::startsWith(Route::currentRouteName(), 'admin.'))
        <button
            @click="open = !open"
            class="md:hidden fixed top-5 left-5 z-30 bg-white p-2 rounded-lg shadow-md border border-orange-300">
            <img src="https://img.icons8.com/ios-filled/50/menu--v6.png" class="w-6 h-6" alt="Menu">
        </button>

        {{-- Overlay --}}
        <div
            x-show="open"
            @click="open = false"
            x-transition.opacity
            class="fixed inset-0 bg-black/20 backdrop-blur-sm z-10 md:hidden">
        </div>
        @endif

        {{-- Sidebar --}}
        @yield('sidebar')

        {{-- Main Content --}}
        <main class="flex-1 p-8 overflow-y-auto md:ml-72">
            @yield('content')
        </main>

        @yield('bottom-nav')

    </div>

</body>

</html>