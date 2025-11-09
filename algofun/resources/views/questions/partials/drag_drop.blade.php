<!-- Instruksi Soal -->
<div class="flex flex-col sm:flex-row items-center bg-sky-100 px-4 sm:px-6 py-4 sm:py-5 rounded-2xl 
            w-full sm:max-w-xl mx-auto mb-6 sm:mb-8 border border-sky-200 text-center sm:text-left 
            shadow-sm">
    <img src="https://img.icons8.com/color/48/light-on.png"
        class="w-8 h-8 sm:w-8 sm:h-8 mb-3 sm:mb-0 sm:mr-3">
    <p class="text-zinc-700 text-lg sm:text-xl font-semibold leading-relaxed font-nunito mobile-text">
        Seret kata untuk membentuk kalimat yang benar!<br class="hidden sm:block">
        Setelah selesai, tekan <span class="text-sky-600">"Periksa"</span>.
    </p>
</div>

<!-- Kalimat Soal -->
<div class="bg-[#FFF8F2] px-4 sm:px-6 py-4 sm:py-6 rounded-2xl mb-6 sm:mb-8 
            text-lg sm:text-lg shadow-md border border-[#EB580C]/20 
            font-nunito w-full sm:max-w-xl mx-auto">
    <div class="text-[#374151] font-medium leading-relaxed text-center mobile-text">
        {{ $question['text'] }}
    </div>
</div>

<!-- Area Drop (Tempat Jawaban) -->
<div id="dropZone" data-drop-zone="true"
    class="bg-white rounded-2xl p-6 sm:p-8 mb-8 w-full sm:max-w-xl mx-auto 
           min-h-[140px] border-2 border-dashed border-[#EB580C]/30 
           transition-all duration-300 hover:border-[#EB580C]/50 
           flex items-center justify-center text-center shadow-sm">
    <div class="flex flex-col items-center space-y-3">
        <div class="w-16 h-16 bg-[#EB580C]/20 rounded-full flex items-center justify-center">
            <img src="https://img.icons8.com/fluency/48/box-important.png" alt="Drop Icon" class="w-10 h-10">
        </div>
        <span class="font-nunito text-[#374151] font-semibold">
            Seret kata ke sini!
        </span>
    </div>
</div>

<!-- Pilihan Kata (Drag Source) -->
<div id="dragSource" class="flex flex-wrap gap-4 justify-center w-full sm:max-w-xl mx-auto">
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
        class="drag-item {{ $colorClass }} border-2 px-6 py-3 sm:py-4 rounded-2xl 
                   shadow-md cursor-move transition-all duration-300 
                   hover:scale-110 hover:shadow-lg font-nunito font-semibold 
                   text-base sm:text-lg flex items-center gap-2"
        data-drag-item="{{ $option }}"
        data-original-index="{{ $index }}">
        <div class="w-6 h-6 bg-white/50 rounded-full flex items-center justify-center">
            <img src="https://img.icons8.com/?size=100&id=LnP8z2Ts71NZ&format=png&color=000000" alt="Option Icon" class="w-6 h-6">
        </div>
        <span>{{ $option }}</span>
    </div>
    @endforeach
</div>