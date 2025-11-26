<!-- Instruksi Soal -->
<div class="flex flex-col sm:flex-row items-center bg-sky-100 px-4 sm:px-6 py-4 sm:py-5 rounded-2xl 
            w-full sm:max-w-xl mx-auto mb-6 sm:mb-8 border border-sky-200 text-center sm:text-left 
            shadow-sm">
    <img src="https://img.icons8.com/color/48/light-on.png"
        class="w-8 h-8 sm:w-8 sm:h-8 mb-3 sm:mb-0 sm:mr-3">
    <p class="text-zinc-700 text-lg sm:text-xl font-semibold leading-relaxed font-nunito mobile-text">
        Pilih jawaban yang paling tepat!<br class="hidden sm:block">
        Tekan salah satu pilihan untuk menjawab.
    </p>
</div>

<!-- Kalimat Soal -->
<div class="bg-[#FFF8F2] px-4 sm:px-6 py-4 sm:py-6 rounded-2xl mb-6 sm:mb-8 
            text-lg sm:text-lg shadow-md border border-[#EB580C]/20 
            font-nunito w-full sm:max-w-xl mx-auto leading-relaxed text-center font-fredoka mobile-text">
    {{ $question['text'] }}
</div>

<!-- Pilihan Jawaban -->
<div class="grid grid-cols-1 gap-4 mb-8 w-full sm:max-w-xl mx-auto">
    @foreach($question['options'] as $index => $option)
    @php
    $letters = ['A', 'B', 'C', 'D'];
    @endphp

    <button
        type="button"
        class="choice-btn group flex items-center justify-between w-full bg-white border-2 rounded-2xl p-4 shadow-sm 
               transition-all duration-300 hover:-translate-y-1 hover:shadow-md hover:border-[#EB580C]
               focus:outline-none focus:ring-4 focus:ring-[#FCD34D]/30"
        :class="{
            'border-[#EB580C] bg-orange-50': userAnswer === '{{ $option }}' && !feedback,
            'border-green-500 bg-green-50': feedback && userAnswer === '{{ $option }}' && '{{ $option === $question['correct'] }}' === '1',
            'border-red-500 bg-red-50': feedback && userAnswer === '{{ $option }}' && '{{ $option === $question['correct'] }}' === '',
            'border-green-500 bg-green-50': feedback && userAnswer !== '{{ $option }}' && '{{ $option === $question['correct'] }}' === '1',
            'border-[#FFD8B1]': userAnswer !== '{{ $option }}' && !feedback
        }"
        @click="if(!feedback) userAnswer = '{{ $option }}'"
        :disabled="feedback"
        aria-pressed="false"
        role="button">

        {{-- Label & isi --}}
        <div class="flex items-center gap-4 text-left">
            {{-- Icon huruf pilihan --}}
            <div class="w-10 h-10 rounded-full flex items-center justify-center shadow-inner"
                :class="{
                    'bg-orange-200 border-orange-400': userAnswer === '{{ $option }}' && !feedback,
                    'bg-green-200 border-green-400': feedback && userAnswer === '{{ $option }}' && '{{ $option === $question['correct'] }}' === '1',
                    'bg-red-200 border-red-400': feedback && userAnswer === '{{ $option }}' && '{{ $option === $question['correct'] }}' === '',
                    'bg-green-200 border-green-400': feedback && userAnswer !== '{{ $option }}' && '{{ $option === $question['correct'] }}' === '1',
                    'bg-[#FFF0E0] border-[#FDBA74]': userAnswer !== '{{ $option }}' && !feedback
                 }">
                <span class="font-fredoka text-lg font-extrabold"
                    :class="{
                        'text-orange-700': userAnswer === '{{ $option }}' && !feedback,
                        'text-green-700': feedback && userAnswer === '{{ $option }}' && '{{ $option === $question['correct'] }}' === '1',
                        'text-red-700': feedback && userAnswer === '{{ $option }}' && '{{ $option === $question['correct'] }}' === '',
                        'text-green-700': feedback && userAnswer !== '{{ $option }}' && '{{ $option === $question['correct'] }}' === '1',
                        'text-[#EB580C]': userAnswer !== '{{ $option }}' && !feedback
                      }">
                    {{ $letters[$index] ?? '?' }}
                </span>
            </div>

            {{-- Isi teks pilihan --}}
            <span class="font-nunito text-base font-semibold leading-snug"
                :class="{
                    'text-orange-700': userAnswer === '{{ $option }}' && !feedback,
                    'text-green-700': feedback && userAnswer === '{{ $option }}' && '{{ $option === $question['correct'] }}' === '1',
                    'text-red-700': feedback && userAnswer === '{{ $option }}' && '{{ $option === $question['correct'] }}' === '',
                    'text-green-700': feedback && userAnswer !== '{{ $option }}' && '{{ $option === $question['correct'] }}' === '1',
                    'text-[#374151]': userAnswer !== '{{ $option }}' && !feedback
                  }">
                {{ $option }}
            </span>
        </div>
    </button>
    @endforeach
</div>