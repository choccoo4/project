<!-- 🔹 Instruksi Soal -->
<div class="flex flex-col sm:flex-row items-center bg-sky-100 px-4 sm:px-6 py-4 sm:py-5 rounded-2xl 
            w-full sm:max-w-xl mx-auto mb-6 sm:mb-8 border border-sky-200 text-center sm:text-left 
            shadow-sm">
    <img src="https://img.icons8.com/color/48/light-on.png"
        class="w-8 h-8 sm:w-8 sm:h-8 mb-3 sm:mb-0 sm:mr-3" alt="Lamp Icon">
    <p class="text-zinc-700 text-lg sm:text-xl font-semibold leading-relaxed font-nunito mobile-text">
        Urutkan langkah-langkah di bawah ini dengan benar.<br class="hidden sm:block">
        Seret dan lepaskan ke urutan yang sesuai!
    </p>
</div>

<!-- 🔸 Kalimat Soal -->
<div class="bg-[#FFF8F2] px-4 sm:px-6 py-4 sm:py-6 rounded-2xl mb-6 sm:mb-8 
            text-lg sm:text-lg shadow-md border border-[#EB580C]/20 
            font-nunito w-full sm:max-w-xl mx-auto">
    <div class="text-[#374151] leading-relaxed text-center mobile-text">
        {{ $question['sentence'] ?? 'Susun langkah berikut agar menjadi urutan yang benar.' }}
    </div>
</div>

<!-- ⚪ Area Jawaban -->
<div id="answerArea"
    class="flex flex-wrap gap-3 justify-center mb-8 min-h-[80px] border-2 border-dashed border-[#EB580C]/30 rounded-2xl p-6 bg-[#FFF8F2] w-full sm:max-w-xl mx-auto transition-all duration-300 hover:border-[#EB580C]/50">
    <div class="flex items-center justify-center w-full h-full text-[#374151] text-center">
        <div class="flex flex-col items-center space-y-2">
            <img src="https://img.icons8.com/color/48/down-squared.png" alt="Arrow Down" class="w-8 h-8">
            <span class="font-nunito font-semibold text-[#374151]">Seret langkah ke sini untuk mengurutkan</span>
        </div>
    </div>
</div>

<!-- ⚪ Pilihan Jawaban -->
<div id="optionsArea" class="flex flex-wrap gap-3 justify-center w-full sm:max-w-xl mx-auto">
    @foreach($question['options'] as $index => $option)
    <button
        class="order-option bg-white shadow-md px-6 py-3 rounded-2xl border-2 border-[#EB580C]/20 
               hover:bg-[#EB580C]/10 hover:border-[#EB580C]/40 transition-all duration-300 
               hover:scale-105 font-nunito font-semibold text-[#374151] text-base cursor-move"
        data-value="{{ $option }}">
        <div class="flex items-center space-x-3">
            <div class="w-7 h-7 bg-[#EB580C]/20 rounded-full flex items-center justify-center">
                <span class="text-sm font-extrabold text-[#EB580C]">{{ $index + 1 }}</span>
            </div>
            <span>{{ $option }}</span>
        </div>
    </button>
    @endforeach
</div>

<!-- Hidden Data -->
<div id="ordering-data"
    data-correct-order="{{ json_encode($question['correct']) }}"
    class="hidden" aria-hidden="true">
</div>