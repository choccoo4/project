<div class="text-center mb-6">
    <div
        class="inline-flex items-center space-x-2 bg-[#EB580C]/10 px-4 py-2 rounded-xl border border-[#EB580C]/20">
        <i data-lucide="book-open" class="w-5 h-5 text-[#EB580C]"></i>
        <p class="text-[#374151] font-semibold">Baca ceritanya lalu jawab pertanyaan!</p>
    </div>
</div>

<!-- Card Soal -->
<div class="bg-white shadow-md rounded-2xl p-6 mb-8 transition hover:shadow-lg">
    <!-- Gambar pendukung (opsional) -->
    @if(!empty($question['image']))
        <div class="flex justify-center mb-4">
            <img src="{{ $question['image'] }}" alt="Ilustrasi Soal"
                class="w-40 h-40 object-contain rounded-xl shadow">
        </div>
    @endif

    <!-- Teks soal -->
    <p class="text-[#374151] font-medium text-lg leading-relaxed mb-6">
        {{ $question['text'] }}
    </p>

    <!-- === Mode Pilihan Ganda === -->
    @if($question['type'] === 'multiple_choice')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($question['options'] as $index => $option)
                @php
                    $colors = [
                        'bg-[#3B82F6]/10 text-[#1E40AF] border-[#3B82F6]/30',
                        'bg-[#22C55E]/10 text-[#065F46] border-[#22C55E]/30',
                        'bg-[#EB580C]/10 text-[#9A3412] border-[#EB580C]/30',
                        'bg-[#8B5CF6]/10 text-[#4C1D95] border-[#8B5CF6]/30',
                    ];
                    $colorClass = $colors[$index % 4];
                @endphp

                <button
                    class="choice-btn {{ $colorClass }} border-2 px-6 py-4 rounded-2xl shadow-md transition-all duration-300 hover:scale-105 hover:shadow-lg text-left relative"
                    data-choice="{{ $option }}">
                    <span class="font-semibold text-base nunito">{{ $option }}</span>
                    <div class="choice-indicator hidden absolute top-2 right-2">
                        <i data-lucide="check-circle" class="w-5 h-5 text-green-500"></i>
                    </div>
                </button>
            @endforeach
        </div>
    @endif

    <!-- === Mode Isi Jawaban === -->
    @if($question['type'] === 'short_answer')
        <div class="mt-4">
            <input type="text"
                placeholder="Tulis jawabanmu di sini..."
                class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-[#EB580C] focus:ring-2 focus:ring-[#EB580C]/30 transition nunito text-gray-700 text-base shadow-sm">
        </div>
    @endif
</div>
