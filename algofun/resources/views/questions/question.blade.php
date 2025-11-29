<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Soal - AlgoFun</title>

    @vite('resources/css/app.css')
    @vite('resources/js/question.js')

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500;600;700&family=Nunito:wght@500;600;700&display=swap"
        rel="stylesheet">
</head>

<body x-data="{ ...questionHandler(), loading: true }"
      x-init="setTimeout(() => loading = false, 700)"
      class="bg-orange-50 min-h-screen flex flex-col font-nunito">

    {{-- SKELETON LOADING --}}
    <div x-show="loading" class="flex-1 flex flex-col items-center mt-6 sm:mt-10 px-4 space-y-4 animate-pulse">
        {{-- Skeleton header --}}
        <div class="w-11/12 max-w-4xl flex items-center gap-3">
            <div class="w-8 h-8 bg-gray-200 rounded-full"></div>
            <div class="flex-1 h-3 bg-gray-200 rounded-full"></div>
            <div class="w-16 h-6 bg-gray-200 rounded-full"></div>
        </div>

        {{-- Skeleton timer --}}
        <div class="w-full max-w-xs sm:max-w-md h-12 sm:h-14 bg-gray-200 rounded-2xl"></div>

        {{-- Skeleton card soal --}}
        <div class="w-11/12 sm:w-10/12 md:w-8/12 h-64 sm:h-72 bg-gray-200 rounded-2xl"></div>

        {{-- Skeleton buttons --}}
        <div class="w-11/12 sm:w-10/12 md:w-8/12 flex gap-3 sm:gap-4">
            <div class="flex-1 h-11 sm:h-12 bg-gray-200 rounded-xl"></div>
            <div class="flex-1 h-11 sm:h-12 bg-gray-200 rounded-xl"></div>
        </div>
    </div>

    {{-- KONTEN ASLI --}}
    <div x-show="!loading" x-transition>

        <!-- ========================= HEADER ========================= -->
        <header
            class="sticky top-0 z-20 backdrop-blur-sm px-4 py-3 sm:px-6 flex items-center justify-between gap-3 max-w-4xl mx-auto w-full">

            <!-- Tombol Exit -->
            <a href="{{ url('/belajar') }}"
               class="flex-shrink-0 flex items-center gap-2 text-neutral-600 hover:text-neutral-800 text-lg font-semibold">
                <img src="https://img.icons8.com/?size=100&id=m98bKDgySJIR&format=png" class="w-7 h-7">
            </a>

            <!-- Progress Bar -->
            <div class="flex-1 relative h-3 bg-zinc-300 rounded-full overflow-hidden">
                <div class="absolute top-0 left-0 h-3 bg-amber-400 rounded-full transition-all duration-500"
                     :style="'width:' + progress + '%'"></div>
            </div>

            <!-- XP -->
            <div class="flex-shrink-0 flex items-center gap-2">
                <img src="https://img.icons8.com/?size=100&id=n0H0dOO5qgEG&format=png" class="w-7 h-7">
                <span class="text-neutral-700 text-lg font-semibold" x-text="xp + ' XP'"></span>
            </div>
        </header>

        <!-- ========================= TIMER ========================= -->
        <section class="mx-auto mt-5 sm:mt-6 flex justify-center px-4">
            <div
                class="w-full max-w-xs sm:max-w-md h-12 sm:h-14 rounded-2xl border border-orange-600 shadow-md 
                       flex items-center justify-center gap-2 sm:gap-3 bg-white px-3 sm:px-4">
                <img src="https://img.icons8.com/color/48/alarm-clock.png" class="w-7 sm:w-9 h-7 sm:h-9 flex-shrink-0">
                <span class="text-orange-500 text-lg sm:text-2xl font-semibold font-fredoka whitespace-nowrap"
                      x-text="timeLeft + ' detik'"></span>
            </div>
        </section>

        <!-- ========================= CARD SOAL ========================= -->
        <main
            class="relative w-11/12 sm:w-10/12 md:w-8/12 mx-auto mt-6 sm:mt-8 bg-white rounded-2xl border border-stone-300 p-5 sm:p-8 shadow-sm">
            @includeIf('questions.partials.' . $question['type'], ['question' => $question])
        </main>

        <!-- ========================= NAVIGATION BUTTONS ========================= -->
        <nav
            class="flex justify-between items-center w-11/12 sm:w-10/12 md:w-8/12 mx-auto mt-8 sm:mt-10 mb-10 sm:mb-12 gap-3 sm:gap-4">

            <x-button
                x-ref="skipBtn"
                variant="soft"
                size="md"
                block="true"
                class="sm:w-40"
                @click="skipQuestion">
                Lompati
            </x-button>

            <x-button
                x-ref="checkBtn"
                variant="info"
                size="md"
                block="true"
                class="sm:w-40 relative transition-all duration-200"
                x-bind:disabled="!hasAnswer"
                @click="checkAnswer"
                x-tooltip="!hasAnswer ? 'Silakan pilih jawaban terlebih dahulu' : ''">
                Periksa
            </x-button>
        </nav>

        <!-- ========================= FEEDBACK SECTION - SIMPLE VERSION ========================= -->
        <div x-show="feedback" x-transition
             class="fixed inset-0 bg-black/40 flex items-end sm:items-center justify-center z-50 px-4 pb-6 sm:pb-10">

            <!-- FEEDBACK BENAR -->
            <template x-if="feedback?.type === 'success'">
                <div class="w-full max-w-2xl bg-[#EFFFF3] rounded-2xl overflow-hidden shadow-xl">
                    <div class="p-6 sm:p-8 flex flex-col sm:flex-row items-center gap-4 sm:gap-6">
                        <div class="w-16 h-16 sm:w-20 sm:h-20 flex-shrink-0">
                            <img src="https://img.icons8.com/color/96/checkmark--v1.png" alt="Benar" class="w-full h-full">
                        </div>
                        <div class="flex-1 text-center sm:text-left">
                            <h2 class="text-xl sm:text-2xl font-fredoka font-semibold text-[#579F52] mb-2"
                                x-text="feedback?.message"></h2>
                            <p class="text-[#579F52] font-nunito text-lg">
                                Terus pertahankan ya!
                            </p>
                        </div>
                        <x-button
                            variant="success"
                            size="lg"
                            block="true"
                            class="w-full sm:w-44 hover:scale-105 transition-all duration-300"
                            @click="nextQuestion()">
                            Lanjutkan
                        </x-button>
                    </div>
                </div>
            </template>

            <!-- FEEDBACK SALAH -->
            <template x-if="feedback?.type === 'error'">
                <div class="w-full max-w-2xl bg-[#FFE2E2] rounded-2xl overflow-hidden shadow-xl">
                    <div class="p-6 sm:p-8">
                        <div class="text-center mb-6">
                            <h2 class="text-xl sm:text-2xl font-fredoka font-semibold text-[#ED4141] mb-2"
                                x-text="feedback?.message"></h2>
                            <p class="text-[#ED4141] font-nunito text-lg">
                                Jawaban yang benar:
                            </p>
                        </div>
                        <div class="bg-white rounded-2xl border-2 border-[#ED4141] p-4 sm:p-6 mb-6">
                            <div class="text-center">
                                <template x-if="Array.isArray(correctAnswer)">
                                    <div class="flex flex-wrap gap-2 justify-center">
                                        <template x-for="(answer, index) in correctAnswer" :key="index">
                                            <div class="bg-[#FFE2E2] text-[#ED4141] text-lg sm:text-xl font-semibold font-nunito 
                                                        px-4 py-2 rounded-xl border border-[#ED4141]"
                                                 x-text="answer"></div>
                                        </template>
                                    </div>
                                </template>
                                <template x-if="!Array.isArray(correctAnswer)">
                                    <div class="text-[#ED4141] text-2xl sm:text-3xl font-bold font-nunito underline py-2"
                                         x-text="correctAnswer"></div>
                                </template>
                            </div>
                        </div>
                        <x-button
                            variant="danger"
                            size="lg"
                            block="true"
                            class="w-full hover:scale-105 transition-all duration-300"
                            @click="nextQuestion()">
                            Lanjutkan
                        </x-button>
                    </div>
                </div>
            </template>
        </div>
    </div>
</body>

<script>
    window.correctAnswer = @json($correctAnswer);
    window.nextQuestionId = @json($nextQuestionId);
    window.questionOptions = @json($questionOptions ?? []);
</script>

</html>
