<div class="text-center mb-6">
    <div class="inline-flex items-center space-x-2 bg-[#8B5CF6]/10 px-4 py-2 rounded-xl border border-[#8B5CF6]/20">
        <i data-lucide="link" class="w-5 h-5 text-[#8B5CF6]"></i>
        <p class="text-[#374151] font-semibold">Cocokkan pasangan kata!</p>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
    <div class="space-y-3">
        <h3 class="text-lg font-extrabold text-[#EB580C] text-center mb-4">Kiri</h3>
        @foreach($question['left'] as $item)
        <div class="pair-left bg-white shadow-md p-4 rounded-2xl cursor-pointer border-2 border-[#3B82F6]/20 hover:bg-[#3B82F6]/5 hover:border-[#3B82F6]/40 transition-all duration-300 hover:scale-105 relative font-poppins"
            data-id="{{ $item['id'] }}">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-[#3B82F6]/20 rounded-full flex items-center justify-center">
                    <i data-lucide="arrow-right" class="w-4 h-4 text-[#3B82F6]"></i>
                </div>
                <span class="font-semibold text-[#374151]">{{ $item['text'] }}</span>
            </div>
            <span class="pair-badge absolute -left-2 -top-2 hidden text-xs font-extrabold px-2 py-1 rounded-full bg-[#EB580C] text-white border-2 border-white shadow-md"></span>
        </div>
        @endforeach
    </div>
    <div class="space-y-3">
        <h3 class="text-lg font-extrabold text-[#22C55E] text-center mb-4">Kanan</h3>
        @foreach($question['right'] as $item)
        <div class="pair-right bg-white shadow-md p-4 rounded-2xl cursor-pointer border-2 border-[#22C55E]/20 hover:bg-[#22C55E]/5 hover:border-[#22C55E]/40 transition-all duration-300 hover:scale-105 relative font-poppins"
            data-id="{{ $item['id'] }}">
            <div class="flex items-center space-x-3">
                <span class="font-semibold text-[#374151]">{{ $item['text'] }}</span>
                <div class="w-8 h-8 bg-[#22C55E]/20 rounded-full flex items-center justify-center">
                    <i data-lucide="arrow-left" class="w-4 h-4 text-[#22C55E]"></i>
                </div>
            </div>
            <span class="pair-badge absolute -right-2 -top-2 hidden text-xs font-extrabold px-2 py-1 rounded-full bg-[#EB580C] text-white border-2 border-white shadow-md"></span>
        </div>
        @endforeach
    </div>
</div>

<!-- Ringkasan pasangan yang sudah dibuat -->
<div id="pairs-legend" class="mb-10 space-y-3"></div>

<!-- Safelist warna Tailwind agar tidak di-purge (digunakan JS) -->
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