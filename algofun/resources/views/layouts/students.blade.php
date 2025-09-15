<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AlgoFun - Dashboard</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-[#FFF9F5] font-sans">

    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-[#D6EBFA] p-6 flex flex-col shadow-lg rounded-r-2xl">
            <!-- Logo -->
            <div class="flex items-center gap-2 mb-10">
                <a href="{{ url('/dashboard') }}">
                    <img src="/images/logo.png" alt="AlgoFun Logo">
                </a>
            </div>

            <!-- Navigation -->
            <nav class="flex flex-col gap-3 text-lg">
                <a href="{{ url('/belajar') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium text-gray-700 hover:bg-orange-100 hover:text-orange-500 transition
                          {{ request()->is('belajar') ? 'bg-orange-500 text-white shadow-md' : '' }}">
                    <img src="https://img.icons8.com/keek/100/literature.png" alt="literature" class="w-8 h-8">
                    <span>Belajar</span>
                </a>
                <a href="#"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium text-gray-700 hover:bg-pink-100 hover:text-pink-500 transition
                          {{ request()->is('latihan') ? 'bg-pink-500 text-white shadow-md' : '' }}">
                    <img src="https://img.icons8.com/keek/100/test-passed.png" alt="test-passed" class="w-8 h-8">
                    <span>Latihan</span>
                </a>
                <a href="#"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium text-gray-700 hover:bg-green-100 hover:text-green-500 transition
                          {{ request()->is('misi') ? 'bg-green-500 text-white shadow-md' : '' }}">
                    <img src="https://img.icons8.com/keek/100/goal.png" alt="goal" class="w-8 h-8">
                    <span>Misi</span>
                </a>
                <a href="#"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium text-gray-700 hover:bg-yellow-100 hover:text-yellow-500 transition
                          {{ request()->is('papan-skor') ? 'bg-yellow-500 text-white shadow-md' : '' }}">
                    <img src="https://img.icons8.com/keek/100/trophy.png" alt="trophy" class="w-8 h-8">
                    <span>Papan Skor</span>
                </a>

                <!-- Logout -->
                <a href="#"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium text-gray-700 hover:bg-red-100 hover:text-red-500 transition
                          {{ request()->is('papan-skor') ? 'bg-red-500 text-white shadow-md' : '' }}">
                    <img src="https://img.icons8.com/keek/100/exit.png" alt="trophy" class="w-8 h-8">
                    <span>Logout</span>
                </a>

            </nav>
        </aside>

        <!-- Content -->
        <main class="flex-1 p-8 overflow-y-auto">
            @yield('content')
        </main>
    </div>

</body>

</html>