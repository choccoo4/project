@extends('layouts.students')

@section('content')
<div class="max-w-xl mx-auto p-6">
    <!-- Progress bar -->
    <div class="w-full bg-gray-200 rounded-full h-2 mb-6">
        <div class="bg-yellow-400 h-2 rounded-full" style="width: 70%"></div>
    </div>

    <!-- Soal -->
    <h2 class="text-xl font-bold text-center mb-4">{{ $question['text'] }}</h2>

    <!-- Gambar (opsional, kalau soal ada ilustrasi) -->
    @if(!empty($question['image']))
        <div class="flex justify-center mb-6">
            <img src="{{ asset('images/'.$question['image']) }}" class="w-32 h-32 object-contain">
        </div>
    @endif

    <!-- Pilihan jawaban -->
    <div id="choices" class="grid grid-cols-1 gap-4 mb-6">
        @foreach($question['options'] as $option)
            <button 
                class="choice-btn bg-gray-100 px-4 py-3 rounded-lg border border-gray-300 text-left hover:bg-yellow-100 transition">
                {{ $option }}
            </button>
        @endforeach
    </div>

    <!-- Tombol -->
    <div class="flex justify-between">
        <button class="bg-gray-300 px-4 py-2 rounded-lg">Lompati</button>
        <button onclick="checkAnswer()" class="bg-green-400 px-4 py-2 rounded-lg">Periksa</button>
    </div>
</div>

<script>
    let selected = null;
    const correctAnswer = @json($question['correct']);

    document.querySelectorAll('.choice-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.choice-btn').forEach(b => b.classList.remove('bg-yellow-300'));
            btn.classList.add('bg-yellow-300');
            selected = btn.innerText;
        });
    });

    function checkAnswer() {
        if(selected === null){
            alert("⚠️ Pilih jawaban dulu ya!");
            return;
        }
        if(selected === correctAnswer){
            alert("✅ Benar! Hebat 🎉");
        } else {
            alert("❌ Salah, coba lagi yuk!");
        }
    }
</script>
@endsection
