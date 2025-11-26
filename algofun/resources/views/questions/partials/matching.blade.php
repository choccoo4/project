<!-- 🔹 Instruksi soal -->
<div class="text-center mb-6">
    <div class="inline-flex items-center space-x-2 bg-[#DAF8FF] px-4 py-2 rounded-xl border border-[#3DA9FC]/30">
        <img src="https://img.icons8.com/color/48/idea--v1.png" alt="Lamp Icon" class="w-6 h-6">
        <p class="text-[#2F3A56] font-semibold">Cocokkan pasangan kata yang sesuai!</p>
    </div>
</div>

<!-- 🔸 Kalimat soal -->
<div class="bg-[#FFF8F2] px-4 sm:px-6 py-4 sm:py-6 rounded-2xl mb-6 sm:mb-8 
            text-lg sm:text-lg shadow-md border border-[#FFB800]/20 
            font-nunito w-full sm:max-w-xl mx-auto">
    <div class="text-[#2F3A56] font-semibold leading-relaxed text-center mobile-text">
        {{ $question['text'] ?? 'Hubungkan kata di sebelah kiri dengan pasangannya di kanan!' }}
    </div>
</div>

<!-- ⚪ Pilihan kiri & kanan -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
    <!-- Kolom kiri -->
    <div class="space-y-3">
        <h3 class="text-lg font-extrabold text-[#3DA9FC] text-center mb-4">Kiri</h3>
        @foreach($question['left'] as $item)
        <div
            class="matching-left bg-white shadow-md p-4 rounded-2xl cursor-pointer border-2 transition-all duration-300 hover:scale-105 relative font-nunito"
            :class="{
                'border-[#3DA9FC] bg-[#DAF8FF]': selectedLeft === '{{ $item['id'] }}',
                'border-[#FF6F61] bg-[#FFE0E9]': getPairColor('{{ $item['id'] }}') === 'pink',
                'border-[#3DA9FC] bg-[#DAF8FF]': getPairColor('{{ $item['id'] }}') === 'blue', 
                'border-[#00BFA6] bg-[#E0FFE7]': getPairColor('{{ $item['id'] }}') === 'green',
                'border-[#FFB800] bg-[#FFF6CF]': getPairColor('{{ $item['id'] }}') === 'yellow',
                'border-[#F59E0B] bg-[#FFEAD1]': getPairColor('{{ $item['id'] }}') === 'orange',
                'border-[#2F3A56]/20 hover:border-[#2F3A56]/40': !getPairForLeft('{{ $item['id'] }}') && selectedLeft !== '{{ $item['id'] }}'
            }"
            data-id="{{ $item['id'] }}"
            data-text="{{ $item['text'] }}"
            @click="selectLeft('{{ $item['id'] }}', '{{ $item['text'] }}')">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 rounded-full flex items-center justify-center">
                    <img src="https://img.icons8.com/color/48/arrow.png" alt="Arrow Right"
                        class="w-5 h-5 rotate-45 invert">
                </div>
                <span class="text-[#2F3A56] font-semibold">{{ $item['text'] }}</span>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Kolom kanan -->
    <div class="space-y-3">
        <h3 class="text-lg font-extrabold text-[#00BFA6] text-center mb-4">Kanan</h3>
        @foreach($question['right'] as $item)
        <div
            class="matching-right bg-white shadow-md p-4 rounded-2xl cursor-pointer border-2 transition-all duration-300 hover:scale-105 relative font-nunito"
            :class="{
                'border-[#00BFA6] bg-[#E0FFE7]': selectedRight === '{{ $item['id'] }}',
                'border-[#FF6F61] bg-[#FFE0E9]': getPairColor('{{ $item['id'] }}') === 'pink',
                'border-[#3DA9FC] bg-[#DAF8FF]': getPairColor('{{ $item['id'] }}') === 'blue',
                'border-[#00BFA6] bg-[#E0FFE7]': getPairColor('{{ $item['id'] }}') === 'green',
                'border-[#FFB800] bg-[#FFF6CF]': getPairColor('{{ $item['id'] }}') === 'yellow',
                'border-[#F59E0B] bg-[#FFEAD1]': getPairColor('{{ $item['id'] }}') === 'orange',
                'border-[#2F3A56]/20 hover:border-[#2F3A56]/40': !getPairForRight('{{ $item['id'] }}') && selectedRight !== '{{ $item['id'] }}'
            }"
            data-id="{{ $item['id'] }}"
            data-text="{{ $item['text'] }}"
            @click="selectRight('{{ $item['id'] }}', '{{ $item['text'] }}')">
            <div class="flex items-center space-x-3 justify-between">
                <span class="text-[#2F3A56] font-semibold">{{ $item['text'] }}</span>
                <div class="w-8 h-8 rounded-full flex items-center justify-center">
                    <img src="https://img.icons8.com/color/48/link--v1.png" alt="Link Icon"
                        class="w-5 h-5 invert">
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- 🟣 Ringkasan pasangan -->
<div class="mb-10 space-y-3 text-center">
    <h3 class="text-lg font-extrabold text-[#2F3A56] mb-4">Pasangan Terpilih</h3>
    <div class="flex flex-wrap gap-3 justify-center">
        <template x-for="(pair, index) in userAnswer" :key="index">
            <div class="inline-flex items-center space-x-3 px-4 py-3 rounded-xl border-2 font-semibold transition-all duration-300 shadow-sm"
                :class="{
                    'border-[#FF6F61] bg-[#FFE0E9] text-[#FF6F61]': getPairColorByIndex(index) === 'pink',
                    'border-[#3DA9FC] bg-[#DAF8FF] text-[#3DA9FC]': getPairColorByIndex(index) === 'blue',
                    'border-[#00BFA6] bg-[#E0FFE7] text-[#00BFA6]': getPairColorByIndex(index) === 'green',
                    'border-[#FFB800] bg-[#FFF6CF] text-[#FFB800]': getPairColorByIndex(index) === 'yellow',
                    'border-[#F59E0B] bg-[#FFEAD1] text-[#F59E0B]': getPairColorByIndex(index) === 'orange'
                 }">
                <span x-text="pair.leftText"></span>
                <span class="text-[#2F3A56]/60">→</span>
                <span x-text="pair.rightText"></span>
                <button @click="removePair(index)" class="ml-2 hover:scale-110 transition-transform">
                    <img src="https://img.icons8.com/ios-filled/50/delete-sign.png" class="w-4 h-4">
                </button>
            </div>
        </template>
        <p x-show="userAnswer.length === 0" class="text-[#2F3A56]/60 text-center w-full">Belum ada pasangan yang dipilih</p>
    </div>
</div>