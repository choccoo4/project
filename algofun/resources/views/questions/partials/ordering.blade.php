<div class="text-center mb-6">
    <div class="inline-flex items-center space-x-2 bg-[#3B82F6]/10 px-4 py-2 rounded-xl border border-[#3B82F6]/20">
        <i data-lucide="arrow-up-down" class="w-5 h-5 text-[#3B82F6]"></i>
        <p class="text-[#374151] font-semibold">Urutkan langkahnya ya!</p>
    </div>
</div>

<!-- Area jawaban -->
<div id="answerArea"
     class="flex flex-wrap gap-3 justify-center mb-8 min-h-[80px] border-2 border-dashed border-[#EB580C]/30 rounded-2xl p-6 bg-[#FFF8F2]">
    <div class="flex items-center justify-center w-full h-full text-[#374151] text-center">
        <div class="flex flex-col items-center space-y-2">
            <i data-lucide="arrow-down" class="w-8 h-8 text-[#EB580C]"></i>
            <span class="font-semibold">Seret langkah ke sini untuk mengurutkan</span>
        </div>
    </div>
</div>

<!-- Area opsi -->
<div id="optionsArea" class="flex flex-wrap gap-3 justify-center">
    @foreach($question['options'] as $index => $option)
    <button
        class="order-option bg-white shadow-md px-6 py-3 rounded-2xl border-2 border-[#EB580C]/20 hover:bg-[#EB580C]/10 hover:border-[#EB580C]/40 transition-all duration-300 hover:scale-105 font-poppins font-semibold text-[#374151]"
        data-value="{{ $option }}">
        <div class="flex items-center space-x-2">
            <div class="w-6 h-6 bg-[#EB580C]/20 rounded-full flex items-center justify-center">
                <span class="text-xs font-extrabold text-[#EB580C]">{{ $index + 1 }}</span>
            </div>
            <span>{{ $option }}</span>
        </div>
    </button>
    @endforeach
</div>

<!-- Data untuk JavaScript -->
<div id="ordering-data" 
     data-correct-order="{{ json_encode($question['correct']) }}" 
     class="hidden" 
     aria-hidden="true">
</div>
