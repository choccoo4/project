<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AlgoFun - @yield('title', 'Dashboard')</title>

    @vite('resources/css/app.css')
    <script defer src="//unpkg.com/alpinejs"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Fredoka:wght@600&family=Nunito:wght@600;800&display=swap"
        rel="stylesheet">
</head>

<body class="bg-[#FFF9F5] text-[#555555] min-h-screen font-nunito">

    <div x-data="{ open: true }" class="flex min-h-screen">

        {{-- Sidebar --}}
        @yield('sidebar')

        {{-- Main Content --}}
        <main class="flex-1 p-8 overflow-y-auto md:ml-72">
            <!-- Toggle Button (for mobile) -->
            <button @click="open = !open"
                class="font-fredoka md:hidden mb-6 bg-orange-500 text-white px-4 py-2 rounded-lg focus:outline-none">
                ☰ Menu
            </button>

            @yield('content')
        </main>
    </div>

</body>
</html>
