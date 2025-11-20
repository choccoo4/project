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

<body x-data="questionHandler" class="bg-orange-50 min-h-screen flex flex-col font-nunito">

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

        <button x-ref="skipBtn" @click="skipQuestion"
            class="flex-1 sm:flex-none sm:w-40 h-12 bg-zinc-100 rounded-3xl shadow-md hover:bg-zinc-200 transition text-neutral-600 text-lg font-semibold font-fredoka">
            Lompati
        </button>

        <button x-ref="checkBtn" @click="checkAnswer"
            class="flex-1 sm:flex-none sm:w-40 h-12 bg-sky-500 rounded-3xl shadow-md hover:bg-sky-600 transition text-white text-lg font-semibold font-fredoka">
            Periksa
        </button>

        <button x-ref="nextBtn" @click="nextQuestion"
            class="hidden flex-1 sm:flex-none sm:w-40 h-12 bg-gradient-to-r from-[#EB580C] to-[#F97316] hover:from-[#F97316] hover:to-[#EA580C] rounded-3xl shadow-md transition text-white text-lg font-semibold font-fredoka">
            Lanjutkan
        </button>
    </nav>

    <!-- ========================= FEEDBACK SECTION ========================= -->
    <div x-show="feedback" x-transition
        class="fixed inset-0 bg-black/40 flex items-end sm:items-center justify-center z-50 px-4 pb-6 sm:pb-10">

        <div class="w-full max-w-md sm:max-w-3xl rounded-2xl overflow-hidden shadow-xl"
            :class="feedback?.type === 'success' ? 'bg-green-50' : 'bg-red-100'">

            <div class="flex flex-col items-center justify-center text-center p-6 sm:p-8 space-y-5">
                <template x-if="feedback?.type === 'success'">
                    <img src='https://img.icons8.com/emoji/96/check-mark-emoji.png' alt='Benar' class="w-16 h-16 sm:w-20 sm:h-20">
                </template>
                <template x-if="feedback?.type === 'error'">
                    <img src='https://img.icons8.com/emoji/96/cross-mark-emoji.png' alt='Salah' class="w-16 h-16 sm:w-20 sm:h-20">
                </template>

                <h2 class="text-xl sm:text-2xl md:text-3xl font-fredoka font-semibold"
                    :class="feedback?.type === 'success' ? 'text-green-700' : 'text-red-700'"
                    x-text="feedback?.message"></h2>

                <template x-if="feedback?.type === 'error' && feedback?.correctAnswer">
                    <p class="text-base sm:text-lg text-red-800 font-semibold">
                        Jawaban yang benar: <span x-text="feedback.correctAnswer"></span>
                    </p>
                </template>

                <button @click="nextQuestion"
                    class="w-full sm:w-auto px-6 sm:px-8 py-3 rounded-2xl sm:rounded-3xl font-fredoka text-lg font-semibold text-white shadow-md transition"
                    :class="feedback?.type === 'success'
                        ? 'bg-green-500 hover:bg-green-600'
                        : 'bg-red-500 hover:bg-red-600'">
                    Lanjutkan
                </button>
            </div>
        </div>
    </div>
</body>

</html>