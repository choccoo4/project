<div id="choices" class="grid grid-cols-1 gap-4 mb-8" role="list">
    @foreach($question['options'] as $index => $option)
    @php
        $colors = [
            'bg-[#3B82F6]/10 hover:bg-[#3B82F6]/20 text-[#3B82F6] border-[#3B82F6]/30',
            'bg-[#22C55E]/10 hover:bg-[#22C55E]/20 text-[#22C55E] border-[#22C55E]/30', 
            'bg-[#EB580C]/10 hover:bg-[#EB580C]/20 text-[#EB580C] border-[#EB580C]/30',
            'bg-[#8B5CF6]/10 hover:bg-[#8B5CF6]/20 text-[#8B5CF6] border-[#8B5CF6]/30'
        ];
        $icons = ['circle', 'square', 'triangle', 'hexagon'];
        $colorClass = $colors[$index % 4];
        $icon = $icons[$index % 4];
    @endphp
    <button
        type="button"
        class="choice-btn group flex items-center justify-between {{ $colorClass }} border-2 shadow-md px-6 py-4 rounded-2xl text-left transition-all duration-300 hover:scale-105 hover:shadow-lg focus:outline-none focus:ring-4 focus:ring-[#EB580C]/20 font-poppins"
        data-answer="{{ $option }}"
        data-correct="{{ $option === $question['correct'] ? 'true' : 'false' }}"
        aria-pressed="false"
        role="button">
        
        <!-- Ikon pilihan dengan nomor (Golden Rule: Match with Real World) -->
        <div class="flex items-center space-x-4">
            <div class="w-12 h-12 bg-white/70 rounded-full flex items-center justify-center relative shadow-sm">
                <i data-lucide="{{ $icon }}" class="w-6 h-6"></i>
                <!-- Nomor untuk keyboard shortcut -->
                <div class="absolute -top-1 -right-1 w-6 h-6 bg-gradient-to-br from-[#EB580C] to-[#F97316] text-white text-xs font-extrabold rounded-full flex items-center justify-center shadow-md">
                    {{ $index + 1 }}
                </div>
            </div>
            <span class="choice-label text-lg font-semibold text-[#374151]">{{ $option }}</span>
        </div>

        {{-- indikator (default hidden) --}}
        <div class="choice-indicator ml-4 w-8 h-8 rounded-full flex items-center justify-center text-white bg-gradient-to-br from-[#22C55E] to-[#16A34A] hidden shadow-md" aria-hidden="true">
            <i data-lucide="check" class="w-5 h-5"></i>
        </div>
    </button>
    @endforeach
</div>