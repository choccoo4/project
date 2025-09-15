<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Quiz Selesai - AlgoFun</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white min-h-screen flex flex-col items-center justify-center p-6">
    <h1 class="text-2xl font-bold mb-2">🎉 Selesai!</h1>
    <p class="mb-1">Soal benar: <b>{{ $benar }}</b> / {{ $total }}</p>
    <p class="mb-1">Skor: <b>{{ $scorePercent }}%</b></p>
    <p class="mb-6">Total XP: <span class="font-bold text-yellow-500">{{ $xp }}</span></p>

    <a href="{{ url('/belajar') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Kembali</a>
</body>

</html>