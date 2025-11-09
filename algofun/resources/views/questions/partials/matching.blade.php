<!-- 🔹 Instruksi soal -->
<div class="text-center mb-6">
    <div class="inline-flex items-center space-x-2 bg-sky-100 px-4 py-2 rounded-xl border border-sky-200">
        <img src="https://img.icons8.com/color/48/idea--v1.png" alt="Lamp Icon" class="w-6 h-6">
        <p class="text-[#374151] font-semibold">Cocokkan pasangan kata yang sesuai!</p>
    </div>
</div>

<!-- 🔸 Kalimat soal -->
<div class="bg-[#FFF8F2] px-4 sm:px-6 py-4 sm:py-6 rounded-2xl mb-6 sm:mb-8 
            text-lg sm:text-lg shadow-md border border-[#EB580C]/20 
            font-nunito w-full sm:max-w-xl mx-auto">
    <div class="text-[#374151] font-semibold leading-relaxed text-center mobile-text">
        {{ $question['text'] ?? 'Hubungkan kata di sebelah kiri dengan pasangannya di kanan!' }}
    </div>
</div>

<!-- ⚪ Pilihan kiri & kanan -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
    <!-- Kolom kiri -->
    <div class="space-y-3">
        <h3 class="text-lg font-extrabold text-[#3B82F6] text-center mb-4">Kiri</h3>
        @foreach($question['left'] as $item)
        <div class="pair-left bg-white shadow-md p-4 rounded-2xl cursor-pointer border-2 border-[#3B82F6]/20 hover:bg-[#3B82F6]/5 hover:border-[#3B82F6]/40 transition-all duration-300 hover:scale-105 relative font-nunito"
            data-id="{{ $item['id'] }}">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-[#3B82F6]/15 rounded-full flex items-center justify-center">
                    <img src="https://img.icons8.com/color/48/arrow.png" alt="Arrow Right" class="w-5 h-5 rotate-45 opacity-80">
                </div>
                <span class="text-[#374151]">{{ $item['text'] }}</span>
            </div>
            <span class="pair-badge absolute -left-2 -top-2 hidden text-xs font-extrabold px-2 py-1 rounded-full bg-[#8B5CF6] text-white border-2 border-white shadow-md"></span>
        </div>
        @endforeach
    </div>

    <!-- Kolom kanan -->
    <div class="space-y-3">
        <h3 class="text-lg font-extrabold text-[#22C55E] text-center mb-4">Kanan</h3>
        @foreach($question['right'] as $item)
        <div class="pair-right bg-white shadow-md p-4 rounded-2xl cursor-pointer border-2 border-[#22C55E]/20 hover:bg-[#22C55E]/5 hover:border-[#22C55E]/40 transition-all duration-300 hover:scale-105 relative font-nunito"
            data-id="{{ $item['id'] }}">
            <div class="flex items-center space-x-3 justify-between">
                <span class="text-[#374151]">{{ $item['text'] }}</span>
                <div class="w-8 h-8 bg-[#22C55E]/15 rounded-full flex items-center justify-center">
                    <img src="https://img.icons8.com/color/48/link--v1.png" alt="Link Icon" class="w-5 h-5 opacity-80">
                </div>
            </div>
            <span class="pair-badge absolute -right-2 -top-2 hidden text-xs font-extrabold px-2 py-1 rounded-full bg-[#8B5CF6] text-white border-2 border-white shadow-md"></span>
        </div>
        @endforeach
    </div>
</div>

<!-- 🟣 Ringkasan pasangan -->
<div id="pairs-legend" class="mb-10 space-y-3 text-center"></div>

<!-- Tailwind safelist -->
<div class="hidden" aria-hidden="true">
    <span class="ring-rose-400 border-rose-400 bg-rose-100 text-rose-700"></span>
    <span class="ring-amber-400 border-amber-400 bg-amber-100 text-amber-700"></span>
    <span class="ring-emerald-400 border-emerald-400 bg-emerald-100 text-emerald-700"></span>
    <span class="ring-sky-400 border-sky-400 bg-sky-100 text-sky-700"></span>
    <span class="ring-violet-400 border-violet-400 bg-violet-100 text-violet-700"></span>
    <span class="ring-fuchsia-400 border-fuchsia-400 bg-fuchsia-100 text-fuchsia-700"></span>
    <span class="ring-lime-400 border-lime-400 bg-lime-100 text-lime-700"></span>
    <span class="ring-cyan-400 border-cyan-400 bg-cyan-100 text-cyan-700"></span>
    <span class="ring-orange-400 border-orange-400 bg-orange-100 text-orange-700"></span>
</div>