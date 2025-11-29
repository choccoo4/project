{{-- FILE: resources/views/components/modal-skeleton.blade.php --}}

@props([
    'type' => 'student' // 'student' untuk Gabung Kelas, 'teacher' untuk Buat Kelas
])

<div class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm">
    <div class="bg-white w-[90%] max-w-md rounded-2xl p-6 shadow-lg border border-orange-100">
        
        {{-- Title Skeleton --}}
        <div class="mb-4 flex justify-center">
            <div class="h-8 bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 rounded-lg w-40 animate-shimmer bg-[length:200%_100%]"></div>
        </div>

        {{-- Form Skeleton --}}
        <div class="space-y-5">
            
            @if($type === 'teacher')
            {{-- Nama Kelas (untuk Guru) --}}
            <div>
                <div class="h-4 bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 rounded w-24 mb-1 animate-shimmer bg-[length:200%_100%]"></div>
                <div class="w-full h-10 bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 rounded-lg animate-shimmer bg-[length:200%_100%]"></div>
            </div>
            @endif

            {{-- Kode Kelas --}}
            <div>
                <div class="h-4 bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 rounded w-24 mb-1 animate-shimmer bg-[length:200%_100%]"></div>
                
                @if($type === 'teacher')
                {{-- Input + Button Buat Kode (Guru) --}}
                <div class="flex gap-2">
                    <div class="flex-1 h-10 bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 rounded-lg animate-shimmer bg-[length:200%_100%]"></div>
                    <div class="w-24 h-10 bg-gradient-to-r from-gray-300 via-gray-400 to-gray-300 rounded-lg animate-shimmer bg-[length:200%_100%]"></div>
                </div>
                @else
                {{-- Input saja (Siswa) --}}
                <div class="w-full h-10 bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 rounded-lg animate-shimmer bg-[length:200%_100%]"></div>
                @endif
            </div>

            {{-- Tombol Action --}}
            <div class="flex justify-end gap-3 mt-6">
                @if($type === 'teacher')
                {{-- Guru: Buat + Simpan --}}
                <div class="w-20 h-9 bg-gradient-to-r from-gray-300 via-gray-400 to-gray-300 rounded-lg animate-shimmer bg-[length:200%_100%]"></div>
                <div class="w-24 h-9 bg-gradient-to-r from-gray-300 via-gray-400 to-gray-300 rounded-lg animate-shimmer bg-[length:200%_100%]"></div>
                @else
                {{-- Siswa: Batal + Gabung --}}
                <div class="w-20 h-9 bg-gradient-to-r from-gray-300 via-gray-400 to-gray-300 rounded-lg animate-shimmer bg-[length:200%_100%]"></div>
                <div class="w-24 h-9 bg-gradient-to-r from-gray-300 via-gray-400 to-gray-300 rounded-lg animate-shimmer bg-[length:200%_100%]"></div>
                @endif
            </div>
        </div>
    </div>
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