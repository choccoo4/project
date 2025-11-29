{{-- FILE: resources/views/components/dashboard-skeleton.blade.php --}}

@props([
    'type' => 'student' // 'student' atau 'teacher'
])

<div class="min-h-screen bg-[#FFF8F2] p-6">

    {{-- HEADER SKELETON --}}
    <header class="mb-8 bg-white rounded-2xl shadow px-4 sm:px-6 py-4 flex items-center justify-between">
        {{-- Left --}}
        <div class="flex items-center gap-3">
            <div class="w-7 h-7 sm:w-8 sm:h-8 bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 rounded-lg animate-shimmer bg-[length:200%_100%]"></div>
            <div class="h-7 sm:h-8 bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 rounded-lg w-40 sm:w-48 animate-shimmer bg-[length:200%_100%]"></div>
        </div>

        {{-- Right --}}
        @if($type === 'student')
        <div class="hidden sm:flex items-center space-x-4">
            <div class="h-5 bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 rounded w-32 animate-shimmer bg-[length:200%_100%]"></div>
            <div class="w-14 h-14 bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 rounded-full animate-shimmer bg-[length:200%_100%]"></div>
        </div>
        <div class="sm:hidden w-10 h-10 bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 rounded-full animate-shimmer bg-[length:200%_100%]"></div>
        @else
        <div class="hidden sm:flex items-center space-x-4">
            <div class="w-8 h-8 bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 rounded-full animate-shimmer bg-[length:200%_100%]"></div>
            <div class="h-5 bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 rounded w-28 animate-shimmer bg-[length:200%_100%]"></div>
        </div>
        @endif
    </header>

    @if($type === 'student')
    {{-- DASHBOARD SISWA SKELETON --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        {{-- Progress Belajar (2 kolom) --}}
        <div class="col-span-1 md:col-span-2 bg-white rounded-2xl shadow p-6">
            <div class="flex items-center gap-2 mb-6">
                <div class="w-6 h-6 bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 rounded animate-shimmer bg-[length:200%_100%]"></div>
                <div class="h-6 bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 rounded w-48 animate-shimmer bg-[length:200%_100%]"></div>
            </div>

            {{-- Level Aktif --}}
            <div class="bg-gradient-to-r from-orange-200 via-orange-300 to-orange-200 p-4 rounded-xl shadow-lg mb-6 animate-pulse">
                <div class="h-6 bg-white/50 rounded w-48 mb-2"></div>
                <div class="h-4 bg-white/30 rounded w-64 mb-3"></div>
                <div class="w-full bg-white/40 rounded-full h-4"></div>
                <div class="h-3 bg-white/30 rounded w-20 mt-1"></div>
            </div>

            {{-- Level Berikutnya --}}
            <div class="bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 p-4 rounded-xl animate-pulse">
                <div class="h-5 bg-white/50 rounded w-56 mb-2"></div>
                <div class="h-4 bg-white/40 rounded w-72"></div>
            </div>
        </div>

        {{-- Lencana (1 kolom) --}}
        <div class="bg-white rounded-2xl shadow p-6">
            <div class="flex items-center gap-2 mb-6">
                <div class="w-6 h-6 bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 rounded animate-shimmer bg-[length:200%_100%]"></div>
                <div class="h-6 bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 rounded w-24 animate-shimmer bg-[length:200%_100%]"></div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                @for($i = 0; $i < 4; $i++)
                <div class="bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 p-4 rounded-xl h-24 animate-shimmer bg-[length:200%_100%]"></div>
                @endfor
            </div>
        </div>
    </div>

    {{-- Tantangan Harian --}}
    <div class="mt-8 bg-white rounded-2xl shadow p-6">
        <div class="flex items-center gap-2 mb-6">
            <div class="w-6 h-6 bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 rounded animate-shimmer bg-[length:200%_100%]"></div>
            <div class="h-6 bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 rounded w-44 animate-shimmer bg-[length:200%_100%]"></div>
        </div>
        <div class="space-y-3">
            @for($i = 0; $i < 3; $i++)
            <div class="h-12 bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 rounded-xl animate-shimmer bg-[length:200%_100%]"></div>
            @endfor
        </div>
    </div>

    {{-- Evaluasi Diri --}}
    <div class="mt-8 bg-white rounded-2xl shadow p-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4 border-l-8 border-orange-400">
        <div class="flex items-start gap-3 flex-1">
            <div class="w-12 h-12 bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 rounded-full animate-shimmer bg-[length:200%_100%]"></div>
            <div class="flex-1">
                <div class="h-5 bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 rounded w-48 mb-2 animate-shimmer bg-[length:200%_100%]"></div>
                <div class="h-4 bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 rounded w-full mb-1 animate-shimmer bg-[length:200%_100%]"></div>
                <div class="h-4 bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 rounded w-3/4 animate-shimmer bg-[length:200%_100%]"></div>
            </div>
        </div>
        <div class="w-32 h-10 bg-gradient-to-r from-gray-300 via-gray-400 to-gray-300 rounded-lg animate-shimmer bg-[length:200%_100%]"></div>
    </div>

    {{-- Reward & Fun Fact --}}
    <div class="mt-8 grid grid-cols-1 gap-6">
        <div class="bg-gradient-to-r from-yellow-100 via-yellow-200 to-yellow-100 rounded-2xl shadow p-6 animate-pulse">
            <div class="h-5 bg-white/50 rounded w-32 mb-1"></div>
            <div class="h-4 bg-white/40 rounded w-64"></div>
        </div>
        <div class="bg-gradient-to-r from-blue-100 via-blue-200 to-blue-100 rounded-2xl shadow p-6 animate-pulse">
            <div class="h-5 bg-white/50 rounded w-40 mb-2"></div>
            <div class="h-4 bg-white/40 rounded w-full"></div>
        </div>
    </div>

    @else
    {{-- DASHBOARD GURU SKELETON (Daftar Kelas) --}}
    <div class="bg-white rounded-2xl shadow-lg p-8 border border-orange-100">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @for($i = 0; $i < 3; $i++)
            <div class="bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 rounded-2xl shadow-md p-6 h-48 animate-shimmer bg-[length:200%_100%]">
            </div>
            @endfor
        </div>
    </div>
    @endif

    {{-- Floating Button Skeleton --}}
    <div class="fixed bottom-20 md:bottom-6 right-6 w-14 h-14 bg-gradient-to-r from-gray-300 via-gray-400 to-gray-300 rounded-full shadow-lg animate-shimmer bg-[length:200%_100%] z-40"></div>
</div>

<style>
@keyframes shimmer {
    0% {
        background-position: -200% 0;
    }
    100% {
        background-position: 200% 0;
    }
}

.animate-shimmer {
    animation: shimmer 2s infinite linear;
}
</style>