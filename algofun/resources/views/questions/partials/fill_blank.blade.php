<!-- Instruksi Soal -->
<div class="flex flex-col sm:flex-row items-center bg-sky-100 px-4 sm:px-6 py-4 sm:py-5 rounded-2xl 
            w-full sm:max-w-xl mx-auto mb-6 sm:mb-8 border border-sky-200 text-center sm:text-left 
            shadow-sm">
    <img src="https://img.icons8.com/color/48/light-on.png"
        class="w-8 h-8 sm:w-8 sm:h-8 mb-3 sm:mb-0 sm:mr-3">
    <p class="text-zinc-700 text-lg sm:text-xl font-semibold leading-relaxed font-nunito mobile-text">
        Isi bagian yang kosong dengan jawaban yang benar.<br class="hidden sm:block">
        Ketik lalu tekan <span class="text-sky-600">"Periksa"</span>.
    </p>
</div>

<!-- Kalimat Soal -->
<div class="bg-[#FFF8F2] px-4 sm:px-6 py-4 sm:py-6 rounded-2xl mb-6 sm:mb-8 
            text-lg sm:text-lg shadow-md border border-[#EB580C]/20 
            font-nunito w-full sm:max-w-xl mx-auto">
    <div class="text-[#374151] font-semibold leading-relaxed text-center mobile-text">
        {!! $question['sentence'] !!}
    </div>
</div>

<!-- Input Jawaban -->
<div class="relative w-full sm:max-w-xl mx-auto px-1 sm:px-0">
    <input
        x-model="userAnswer"
        id="userAnswer"
        class="border-2 border-[#EB580C]/30 p-4 pr-12 w-full rounded-2xl
    focus:ring-4 focus:ring-[#EB580C]/20 focus:border-[#EB580C] transition-all
    font-nunito font-semibold text-[#374151] placeholder-[#9CA3AF] text-lg sm:text-base mobile-input"
        placeholder="Ketik jawaban di sini...">
    <div class="absolute right-4 sm:right-6 top-1/2 -translate-y-1/2 pointer-events-none">
        <img src="https://img.icons8.com/color/48/pen.png" class="w-6 h-6 sm:w-6 sm:h-6">
    </div>
</div>