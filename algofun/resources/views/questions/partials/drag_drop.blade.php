<div class="text-center mb-6">
    <div class="inline-flex items-center space-x-2 bg-[#EB580C]/10 px-4 py-2 rounded-xl border border-[#EB580C]/20">
        <i data-lucide="target" class="w-5 h-5 text-[#EB580C]"></i>
        <p class="text-[#374151] font-semibold">Seret kata ke tempat yang benar!</p>
    </div>
</div>

<div class="bg-[#FFF8F2] shadow-md rounded-2xl p-8 mb-8 min-h-[140px] border-2 border-dashed border-[#EB580C]/30 transition-all duration-300 hover:border-[#EB580C]/50" 
     id="dropZone" 
     data-drop-zone="true">
    <div class="text-center text-[#374151] text-lg font-medium flex items-center justify-center h-full">
        <div class="flex flex-col items-center space-y-3">
            <div class="w-16 h-16 bg-[#EB580C]/20 rounded-full flex items-center justify-center">
                <i data-lucide="package" class="w-8 h-8 text-[#EB580C]"></i>
            </div>
            <span class="font-semibold">Area jawaban - seret kata ke sini!</span>
        </div>
    </div>
</div>

<div class="flex flex-wrap gap-4 justify-center" id="dragSource">
    @foreach($question['options'] as $index => $option)
    @php
        $colors = [
            'bg-[#3B82F6]/10 text-[#3B82F6] border-[#3B82F6]/30',
            'bg-[#22C55E]/10 text-[#22C55E] border-[#22C55E]/30', 
            'bg-[#EB580C]/10 text-[#EB580C] border-[#EB580C]/30',
            'bg-[#8B5CF6]/10 text-[#8B5CF6] border-[#8B5CF6]/30'
        ];
        $colorClass = $colors[$index % 4];
    @endphp
    <div draggable="true"
        class="drag-item {{ $colorClass }} border-2 px-6 py-4 rounded-2xl shadow-md cursor-move transition-all duration-300 hover:scale-110 hover:shadow-lg font-poppins font-semibold text-lg"
        data-drag-item="{{ $option }}"
        data-original-index="{{ $index }}">
        <div class="flex items-center space-x-2">
            <div class="w-6 h-6 bg-white/50 rounded-full flex items-center justify-center">
                <i data-lucide="grip-vertical" class="w-4 h-4"></i>
            </div>
            <span>{{ $option }}</span>
        </div>
    </div>
    @endforeach
</div>