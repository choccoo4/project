<div class="text-center mb-6">
    <div class="inline-flex items-center space-x-2 bg-[#F59E0B]/10 px-4 py-2 rounded-xl border border-[#F59E0B]/20">
        <i data-lucide="edit-3" class="w-5 h-5 text-[#F59E0B]"></i>
        <p class="text-[#374151] font-semibold">Isi bagian yang kosong!</p>
    </div>
</div>

<div class="bg-[#FFF8F2] p-6 rounded-2xl mb-8 text-lg shadow-md border border-[#EB580C]/20 font-poppins">
    <div class="text-[#374151] font-semibold leading-relaxed">
        {!! $question['sentence'] !!}
    </div>
</div>

<div class="relative">
    <input id="userAnswer"
        class="border-2 border-[#EB580C]/30 p-4 pr-12 w-full rounded-2xl mb-10 focus:ring-4 focus:ring-[#EB580C]/20 focus:border-[#EB580C] transition-all duration-300 font-poppins font-semibold text-[#374151] placeholder-[#9CA3AF]"
        placeholder="Tulis jawabanmu di sini...">
    <div class="absolute right-7 top-1/3 -translate-y-[70%] pointer-events-none flex items-center justify-center">
        <i data-lucide="pen-tool" class="w-5 h-5 text-[#EB580C]"></i>
    </div>

</div>