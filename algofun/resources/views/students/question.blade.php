<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Quiz - AlgoFun</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white min-h-screen flex flex-col justify-between">

    <!-- Header -->
    <div class="flex items-center justify-between p-4 border-b">
        <button class="text-gray-500 font-bold text-lg" onclick="window.location='{{ route('quiz.finish') }}'">✕</button>

        <!-- Progress bar (berdasarkan jumlah soal benar / total) -->
        <div class="flex-1 mx-4">
            @php $percent = $total>0 ? round(($solvedCount/$total)*100) : 0; @endphp
            <div class="w-full h-2 bg-gray-200 rounded-full">
                <div id="progress-bar" class="h-2 bg-yellow-400 rounded-full transition-all duration-300"
                    style="width: {{ $percent }}%"></div>
            </div>
        </div>

        <!-- XP -->
        <div class="flex items-center text-sm font-bold text-yellow-500">
            ⚡ <span id="xp" class="ml-1">{{ $xp }} XP</span>
        </div>
    </div>

    <!-- Area soal -->
    <div class="flex-1 p-6" id="question-container">
        @if($soal['type'] === 'multiple_choice')
        @include('components.soal.multiple-choice', ['soal' => $soal, 'index' => $index])
        @elseif($soal['type'] === 'ordering')
        @include('components.soal.ordering', ['soal' => $soal, 'index' => $index])
        @endif
    </div>

    <!-- Footer -->
    <div class="flex justify-between items-center p-4 border-t">
        <button id="skip-btn" class="px-4 py-2 rounded-lg bg-gray-200" onclick="skipQuestion()">Lompati</button>
        <div class="space-x-2">
            <button id="check-btn" onclick="triggerLocalCheck()" class="px-4 py-2 rounded-lg bg-green-300">Periksa</button>
            <button id="next-btn" onclick="goNext()" class="hidden px-4 py-2 rounded-lg bg-blue-500 text-white">Lanjutkan ➝</button>
        </div>
    </div>

    <!-- Tooltip feedback -->
    <div id="tooltip" class="hidden text-center p-4"></div>

    <script>
        // state terakhir hasil cek lokal (front-end)
        let _last = {
            isCorrect: false,
            correctText: ''
        };
        const NEXT_URL = "{{ route('quiz.next', ['index' => $index]) }}";

        // dipanggil dari komponen soal setelah validasi lokal
        function handleCheckResult(isCorrect, correctText) {
            _last = {
                isCorrect,
                correctText
            };
            // tampilkan feedback
            const tip = document.getElementById('tooltip');
            tip.classList.remove('hidden');
            tip.innerHTML = `<div class="font-bold ${isCorrect ? 'text-green-600' : 'text-red-500'}">
        ${isCorrect ? '✅ Keren! Jawaban benar' : '❌ Salah.'} 
        ${!isCorrect ? (' Jawaban benar: ' + correctText) : ''}
      </div>`;

            // tombol: sembunyikan Periksa, tampilkan Lanjutkan (SELALU, baik benar maupun salah)
            document.getElementById('check-btn').classList.add('hidden');
            document.getElementById('next-btn').classList.remove('hidden');
        }

        // dipanggil tombol "Periksa" → minta komponen soal melakukan cek lokal
        function triggerLocalCheck() {
            // komponen soal harus mendefinisikan window.localCheck()
            if (typeof window.localCheck === 'function') {
                window.localCheck(); // ini akan memanggil handleCheckResult(...)
            }
        }

        function goNext() {
            const result = _last.isCorrect ? 'correct' : 'incorrect';
            window.location.href = NEXT_URL + '?result=' + result;
        }

        function skipQuestion() {
            window.location.href = NEXT_URL + '?result=skip';
        }
    </script>
</body>

</html>