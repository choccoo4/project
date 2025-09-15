<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Quiz - AlgoFun</title>
    @vite('resources/css/app.css')
    @vite('resources/js/question.js')
    <script src="https://unpkg.com/lucide@latest"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-10px); }
            60% { transform: translateY(-5px); }
        }
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        @keyframes wiggle {
            0%, 100% { transform: rotate(0deg); }
            25% { transform: rotate(5deg); }
            75% { transform: rotate(-5deg); }
        }
        @keyframes grow {
            0% { transform: scaleX(0); }
            100% { transform: scaleX(1); }
        }
        .bounce-animation { animation: bounce 0.6s ease-in-out; }
        .shake-animation { animation: shake 0.5s ease-in-out; }
        .pulse-animation { animation: pulse 0.3s ease-in-out; }
        .wiggle-animation { animation: wiggle 0.3s ease-in-out; }
        .grow-animation { animation: grow 0.5s ease-out; }
        .font-poppins { font-family: 'Poppins', sans-serif; }
    </style>
</head>

<body class="bg-[#FFF8F2] min-h-screen flex flex-col font-poppins" x-data="quizApp()">

    <!-- Header konsisten dengan desain aplikasi -->
    <header class="flex items-center justify-between p-6 bg-white rounded-2xl shadow-md mx-6 mt-6 mb-4">
        <!-- Tombol keluar konsisten dengan konfirmasi (Golden Rule: Error Prevention) -->
        <a href="{{ route('quiz.finish') }}" 
           class="flex items-center space-x-2 bg-red-100 hover:bg-red-200 text-red-600 px-4 py-2 rounded-xl transition-all duration-300 hover:scale-105 font-semibold"
           onclick="return confirm('Yakin ingin keluar? Progress akan disimpan.')"
           title="Keluar dari quiz">
            <i data-lucide="x" class="w-5 h-5"></i>
            <span class="hidden sm:inline">Keluar</span>
        </a>

        <!-- Progress bar konsisten dengan warna aplikasi -->
        <div class="flex-1 mx-8 flex items-center">
            @php $percent = $total > 0 ? round(($id / $total) * 100) : 0; @endphp
            <div class="w-full flex flex-col items-center">
                <div class="w-full h-4 bg-gray-200 rounded-full overflow-hidden shadow-inner">
                    <div id="progress-bar" 
                         class="h-4 bg-gradient-to-r from-[#EB580C] to-[#F97316] transition-all duration-700 ease-out relative grow-animation" 
                         data-progress="{{ $percent }}"
                         :style="`width: ${progress}%`">
                        <!-- Karakter yang bergerak di progress bar -->
                        <div class="absolute right-0 top-1/2 transform -translate-y-1/2 translate-x-1 text-lg" 
                             x-show="progress > 0" x-transition>
                            🚀
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- XP konsisten dengan desain -->
        <div class="flex items-center space-x-2 bg-gradient-to-r from-[#EB580C] to-[#F97316] text-white px-4 py-2 rounded-xl shadow-md font-semibold" 
             x-data="{ xp: {{ $xp ?? 0 }} }">
            <i data-lucide="zap" class="w-5 h-5"></i>
            <span class="font-extrabold text-lg" x-text="xp"></span>
            <span class="text-sm font-medium">XP</span>
        </div>
    </header>

    <!-- Konten soal konsisten dengan desain aplikasi -->
    <main class="flex-1 flex flex-col items-center justify-center p-6">
        <!-- Kartu soal konsisten -->
        <div class="w-full max-w-2xl">
            <div class="bg-white rounded-2xl shadow-md p-8 relative border border-gray-100">
                <!-- Judul soal dengan ikon konsisten -->
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-[#EB580C] to-[#F97316] rounded-full mb-6 shadow-lg hover:scale-105 transition-transform duration-300">
                        <i data-lucide="brain" class="w-10 h-10 text-white"></i>
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold mb-4 text-[#EB580C] leading-relaxed">
                        {{ $question['text'] }}
                    </h2>
                    <!-- Progress indicator yang jelas (Golden Rule: Reduce Cognitive Load) -->
                    <div class="inline-flex items-center space-x-2 bg-[#FFF8F2] px-4 py-2 rounded-xl border border-[#EB580C]/20">
                        <span class="text-[#EB580C] font-extrabold">Soal {{ $id }}</span>
                        <span class="text-[#374151]">•</span>
                        <span class="text-[#374151] font-semibold">{{ $total }} soal</span>
                        <span class="text-[#374151]">•</span>
                        <span class="text-sm text-[#374151]">{{ round(($id / $total) * 100) }}% selesai</span>
                    </div>
                    <!-- Instruksi yang jelas -->
                    <div class="mt-4 text-sm text-[#374151] bg-[#3B82F6]/10 px-4 py-3 rounded-xl border border-[#3B82F6]/20">
                        <div class="flex items-center justify-center space-x-2">
                            <i data-lucide="lightbulb" class="w-4 h-4 text-[#3B82F6]"></i>
                            <span class="font-semibold">Pilih jawaban yang paling tepat, lalu klik "Jawab"</span>
                        </div>
                    </div>
                </div>

                <!-- Konfigurasi quiz untuk JS -->
                <div id="quiz-config"
                    data-next-url="{{ url('/soal/' . ($id + 1 <= $total ? $id + 1 : 1)) }}"
                    data-total="{{ $total }}"
                    data-current="{{ $id }}"
                    @if($question['type'] === 'ordering')
                    data-correct-order='@json($question['correct'])'
                    @endif
                    @if($question['type'] === 'matching')
                    data-correct-matches='@json($question['correct'])'
                    @endif
                    @if($question['type'] === 'fill_blank')
                    data-correct-fill='@json($question['correct'])'
                    @endif
                    @if($question['type'] === 'drag_drop')
                    data-correct-drag='@json($question['correct'])'
                    @endif
                    class="hidden"></div>

                <!-- Render dynamic partial -->
                <div id="question-container" class="relative z-10">
                    @if($question['type'] === 'multiple_choice')
                    @include('questions.partials.multiple_choice', ['question' => $question])
                    @elseif($question['type'] === 'ordering')
                    @include('questions.partials.ordering', ['question' => $question])
                    @elseif($question['type'] === 'matching')
                    @include('questions.partials.matching', ['question' => $question])
                    @elseif($question['type'] === 'fill_blank')
                    @include('questions.partials.fill_blank', ['question' => $question])
                    @elseif($question['type'] === 'drag_drop')
                    @include('questions.partials.drag_drop', ['question' => $question])
                    @endif
                </div>
            </div>
        </div>
    </main>

    <!-- Footer navigasi konsisten -->
    <footer class="bg-white rounded-2xl shadow-md p-6 mx-6 mb-6 border border-gray-100">
        <div class="flex justify-between items-center max-w-4xl mx-auto gap-4">
            <!-- Tombol lompati konsisten -->
            <button id="skip-btn"
                class="flex items-center space-x-2 px-6 py-3 bg-gray-100 hover:bg-gray-200 text-[#374151] rounded-xl font-semibold transition-all duration-300 hover:scale-105 hover:shadow-md">
                <i data-lucide="skip-forward" class="w-5 h-5"></i>
                <span>Lompati</span>
            </button>

            <!-- Tombol aksi utama konsisten dengan loading state -->
            <div class="flex space-x-3">
                <button id="check-btn"
                    class="flex items-center space-x-2 px-8 py-4 bg-gradient-to-r from-[#22C55E] to-[#16A34A] hover:from-[#16A34A] hover:to-[#15803D] text-white font-extrabold rounded-xl shadow-md transition-all duration-300 hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed"
                    title="Periksa jawaban yang dipilih">
                    <i data-lucide="check-circle" class="w-5 h-5"></i>
                    <span>Jawab</span>
                </button>
                <button id="next-btn"
                    class="hidden flex items-center space-x-2 px-8 py-4 bg-gradient-to-r from-[#EB580C] to-[#F97316] hover:from-[#F97316] hover:to-[#EA580C] text-white font-extrabold rounded-xl shadow-md transition-all duration-300 hover:scale-105"
                    title="Lanjut ke soal berikutnya">
                    <span>Lanjut</span>
                    <i data-lucide="arrow-right" class="w-5 h-5"></i>
                </button>
                <!-- Loading indicator (Golden Rule: Feedback & Visibility) -->
                <div id="loading-indicator" class="hidden flex items-center space-x-2 px-8 py-4 bg-[#3B82F6] text-white font-extrabold rounded-xl">
                    <div class="animate-spin rounded-full h-5 w-5 border-b-2 border-white"></div>
                    <span>Memproses...</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Feedback popup konsisten -->
    <div id="tooltip"
        class="hidden fixed bottom-32 left-1/2 transform -translate-x-1/2 z-50">
        <div class="bg-white rounded-2xl shadow-2xl border-4 border-[#EB580C] p-6 max-w-sm mx-4 font-poppins">
            <div class="text-center">
                <div class="text-4xl mb-3" id="feedback-emoji">🎉</div>
                <div class="text-lg font-extrabold mb-2 text-[#EB580C]" id="feedback-title">Keren!</div>
                <div class="text-[#374151] font-semibold" id="feedback-message">Jawaban kamu benar!</div>
            </div>
        </div>
    </div>

    <!-- Keyboard shortcuts info (Golden Rule: Flexibility & Efficiency) -->
    <div class="fixed bottom-4 right-4 bg-white rounded-xl shadow-md p-3 text-xs text-[#374151] hidden border border-gray-200" id="shortcuts-info">
        <div class="font-extrabold mb-2 text-[#EB580C]">Shortcuts:</div>
        <div class="space-y-1">
            <div class="flex items-center space-x-2">
                <span class="bg-[#EB580C] text-white px-2 py-0.5 rounded text-xs font-bold">1-4</span>
                <span>Pilih jawaban</span>
            </div>
            <div class="flex items-center space-x-2">
                <span class="bg-[#22C55E] text-white px-2 py-0.5 rounded text-xs font-bold">Enter</span>
                <span>Jawab</span>
            </div>
            <div class="flex items-center space-x-2">
                <span class="bg-[#3B82F6] text-white px-2 py-0.5 rounded text-xs font-bold">Space</span>
                <span>Lanjut</span>
            </div>
            <div class="flex items-center space-x-2">
                <span class="bg-red-500 text-white px-2 py-0.5 rounded text-xs font-bold">Esc</span>
                <span>Keluar</span>
            </div>
        </div>
    </div>

    <!-- Alpine.js script untuk interaktivitas -->
    <script>
        // Alpine.js data untuk quiz app
        function quizApp() {
            return {
                progress: {{ $percent }},
                init() {
                    // Initialize progress bar
                    this.progress = {{ $percent }};
                }
            };
        }
    </script>

    <!-- Keyboard shortcuts implementation -->
    <script>
        document.addEventListener('keydown', function(e) {
            // Shortcuts info toggle
            if (e.key === 'F1') {
                e.preventDefault();
                const info = document.getElementById('shortcuts-info');
                info.classList.toggle('hidden');
                return;
            }
            
            // Number keys for answer selection (Golden Rule: Flexibility & Efficiency)
            if (e.key >= '1' && e.key <= '4') {
                const choiceIndex = parseInt(e.key) - 1;
                const choiceButtons = document.querySelectorAll('.choice-btn');
                if (choiceButtons[choiceIndex]) {
                    choiceButtons[choiceIndex].click();
                }
            }
            
            // Enter to check answer
            if (e.key === 'Enter') {
                const checkBtn = document.getElementById('check-btn');
                if (checkBtn && !checkBtn.classList.contains('hidden')) {
                    checkBtn.click();
                }
            }
            
            // Space to continue
            if (e.key === ' ') {
                e.preventDefault();
                const nextBtn = document.getElementById('next-btn');
                if (nextBtn && !nextBtn.classList.contains('hidden')) {
                    nextBtn.click();
                }
            }
            
            // Escape to exit
            if (e.key === 'Escape') {
                e.preventDefault();
                if (confirm('Yakin ingin keluar? Progress akan disimpan.')) {
                    window.location.href = "{{ route('quiz.finish') }}";
                }
            }
        });
    </script>

</body>

</html>