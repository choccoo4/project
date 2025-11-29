<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AlgoFun - @yield('title', 'Dashboard')</title>

    @vite('resources/css/app.css')

    {{-- JS --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {{-- Pakai SATU Alpine saja, yang benar --}}
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Fredoka:wght@600&family=Nunito:wght@600;800&display=swap"
        rel="stylesheet">
</head>

<body class="bg-[#FFF9F5] text-[#555555] min-h-screen font-nunito"
      x-data="{ loading: true, open: true }"
      x-init="setTimeout(() => loading = false, 700)">

    <div class="flex min-h-screen">

        {{-- Tombol & overlay sidebar khusus admin (opsional, kalau memang perlu) --}}
        @if (Str::startsWith(Route::currentRouteName(), 'admin.'))
            <button
                @click="open = !open"
                class="md:hidden fixed top-5 left-5 z-30 bg-white p-2 rounded-lg shadow-md border border-orange-300">
                <img src="https://img.icons8.com/ios-filled/50/menu--v6.png" class="w-6 h-6" alt="Menu">
            </button>

            <div
                x-show="open"
                @click="open = false"
                x-transition.opacity
                class="fixed inset-0 bg-black/20 backdrop-blur-sm z-10 md:hidden">
            </div>
        @endif

        {{-- SKELETON (loading) --}}
        <div x-show="loading" class="fixed inset-0 z-50 md:flex hidden">
            <aside class="w-72 bg-white border-r-4 border-orange-500 h-screen p-6 flex flex-col gap-6 animate-pulse">
                <div class="w-40 h-12 bg-gray-200 rounded-lg"></div>
                <div class="flex flex-col gap-4 mt-4">
                    @for ($i = 0; $i < 7; $i++)
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-gray-200 rounded-lg"></div>
                            <div class="w-32 h-5 bg-gray-200 rounded-lg"></div>
                        </div>
                    @endfor
                </div>
                <div class="flex items-center gap-3 mt-auto">
                    <div class="w-8 h-8 bg-gray-200 rounded-lg"></div>
                    <div class="w-32 h-5 bg-gray-200 rounded-lg"></div>
                </div>
            </aside>

            <main class="flex-1 p-6 space-y-4 animate-pulse">
                <div class="h-6 w-56 bg-gray-200 rounded"></div>
                <div class="h-4 w-full bg-gray-200 rounded"></div>
                <div class="h-4 w-3/4 bg-gray-200 rounded"></div>
            </main>
        </div>

        {{-- KONTEN ASLI --}}
        <div x-show="!loading" x-transition class="flex min-h-screen w-full">

            {{-- Sidebar --}}
            @yield('sidebar')

            {{-- Main Content --}}
            <main class="flex-1 p-8 overflow-y-auto md:ml-72">
                @yield('content')
            </main>

            @yield('bottom-nav')

        </div>
    </div>
</body>
</html>
