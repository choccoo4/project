<!-- Instruksi Soal -->
<div class="flex flex-col sm:flex-row items-center bg-[#DAF8FF] px-4 sm:px-6 py-4 sm:py-5 rounded-2xl 
            w-full sm:max-w-xl mx-auto mb-6 sm:mb-8 border border-[#3DA9FC]/30 text-center sm:text-left 
            shadow-sm">
    <img src="https://img.icons8.com/color/48/light-on.png"
        class="w-8 h-8 sm:w-8 sm:h-8 mb-3 sm:mb-0 sm:mr-3">
    <p class="text-[#2F3A56] text-lg sm:text-xl font-semibold leading-relaxed font-nunito mobile-text">
        Seret kata untuk membentuk kalimat yang benar!<br class="hidden sm:block">
        Setelah selesai, tekan <span class="text-[#3DA9FC]">"Periksa"</span>.
    </p>
</div>

<!-- Kalimat Soal -->
<div class="bg-[#FFF8F2] px-4 sm:px-6 py-4 sm:py-6 rounded-2xl mb-6 sm:mb-8 
            text-lg sm:text-lg shadow-md border border-[#FFB800]/20 
            font-nunito w-full sm:max-w-xl mx-auto">
    <div class="text-[#2F3A56] font-medium leading-relaxed text-center mobile-text">
        {{ $question['text'] }}
    </div>
</div>

<!-- Area Drop (Tempat Jawaban) -->
<div x-ref="answerArea"
    @drop="handleDrop($event)"
    @dragover="handleDragOver($event)"
    @dragenter="handleDragEnter($event)"
    @dragleave="handleDragLeave($event)"
    class="bg-white rounded-2xl p-6 sm:p-8 mb-8 w-full sm:max-w-xl mx-auto 
           min-h-[140px] border-2 transition-all duration-300 
           flex flex-wrap items-center justify-center gap-3 text-center shadow-sm"
    :class="userAnswer.length > 0 ? 
           'border-[#00BFA6] bg-[#E0FFE7]' : 
           'border-dashed border-[#FFB800]/30 hover:border-[#FFB800]/50'">

    <!-- Placeholder ketika kosong -->
    <template x-if="userAnswer.length === 0">
        <div class="flex flex-col items-center space-y-3">
            <div class="w-16 h-16 bg-[#FFB800]/20 rounded-full flex items-center justify-center">
                <img src="https://img.icons8.com/fluency/48/box-important.png" alt="Drop Icon" class="w-10 h-10">
            </div>
            <span class="font-nunito text-[#2F3A56] font-semibold">
                Seret kata ke sini!
            </span>
        </div>
    </template>

    <!-- Jawaban yang sudah di-drop -->
    <template x-for="(answer, index) in userAnswer" :key="index">
        <div class="bg-white border-2 px-4 py-3 rounded-2xl shadow-md 
                   transition-all duration-300 font-nunito font-semibold 
                   text-base flex items-center gap-2 cursor-move relative group"
            :class="{
                 'border-[#FF6F61] text-[#FF6F61]': index % 5 === 0,
                 'border-[#3DA9FC] text-[#3DA9FC]': index % 5 === 1,
                 'border-[#00BFA6] text-[#00BFA6]': index % 5 === 2,
                 'border-[#FFB800] text-[#FFB800]': index % 5 === 3,
                 'border-[#F59E0B] text-[#F59E0B]': index % 5 === 4
             }">
            <!-- Drag Handle -->
            <div class="w-6 h-6 bg-current/20 rounded-full flex items-center justify-center flex-shrink-0">
                <img src="https://img.icons8.com/?size=100&id=LnP8z2Ts71NZ&format=png&color=000000"
                    alt="Drag Icon" class="w-4 h-4 opacity-70">
            </div>
            <span x-text="answer" class="flex-1 text-center"></span>
            <button @click="removeAnswer(index)"
                class="text-[#2F3A56] hover:text-[#FF6F61] transition-colors">
                <img src="https://img.icons8.com/ios-filled/50/delete-sign.png" class="w-4 h-4">
            </button>
        </div>
    </template>
</div>

<!-- Pilihan Kata (Drag Source) -->
<div class="flex flex-wrap gap-4 justify-center w-full sm:max-w-xl mx-auto">
    <template x-for="(option, index) in availableOptions" :key="option">
        <div draggable="true"
            class="drag-item border-2 px-6 py-3 rounded-2xl 
                   shadow-md cursor-move transition-all duration-300 
                   hover:scale-105 hover:shadow-lg font-nunito font-semibold 
                   text-base flex items-center gap-2"
            :class="{
                'bg-[#FFE0E9] text-[#FF6F61] border-[#FF6F61]': index % 5 === 0,
                'bg-[#DAF8FF] text-[#3DA9FC] border-[#3DA9FC]': index % 5 === 1,
                'bg-[#E0FFE7] text-[#00BFA6] border-[#00BFA6]': index % 5 === 2,
                'bg-[#FFF6CF] text-[#FFB800] border-[#FFB800]': index % 5 === 3,
                'bg-[#FFEAD1] text-[#F59E0B] border-[#F59E0B]': index % 5 === 4
            }"
            :data-value="option"
            @dragstart="handleDragStart($event, -1)"
            @dragend="handleDragEnd($event)">
            <!-- Drag Handle -->
            <div class="w-6 h-6 bg-white/50 rounded-full flex items-center justify-center flex-shrink-0">
                <img src="https://img.icons8.com/?size=100&id=LnP8z2Ts71NZ&format=png&color=000000"
                    alt="Drag Icon" class="w-4 h-4">
            </div>
            <span x-text="option" class="flex-1 text-center"></span>
        </div>
    </template>
</div>