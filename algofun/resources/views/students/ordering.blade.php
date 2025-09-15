@extends('layouts.students')

@section('content')
<div class="max-w-xl mx-auto p-6">
    <!-- Progress bar -->
    <div class="w-full bg-gray-200 rounded-full h-2 mb-6">
        <div class="bg-yellow-400 h-2 rounded-full" style="width: 40%"></div>
    </div>

    <!-- Soal -->
    <h2 class="text-xl font-bold text-center mb-4">{{ $question['text'] }}</h2>

    <!-- Gambar opsi -->
    <div class="flex justify-center space-x-4 mb-6">
        @foreach($question['images'] as $index => $img)
            <div class="flex flex-col items-center">
                <img src="{{ asset('images/'.$img) }}" class="w-20 h-20 object-contain">
                <p class="mt-2 font-medium">{{ $question['options'][$index] }}</p>
            </div>
        @endforeach
    </div>

    <!-- Area jawaban (drag & drop / klik urutan) -->
    <div id="answerArea" class="flex space-x-2 justify-center mb-6">
        @foreach($question['options'] as $option)
            <button 
                class="option-btn bg-gray-100 px-4 py-2 rounded-lg border border-gray-300 hover:bg-yellow-100 transition">
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
    let selected = [];
    const correctOrder = @json($question['correct']); 

    document.querySelectorAll('.option-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            selected.push(btn.innerText);
            btn.disabled = true;
            btn.classList.add('bg-yellow-300');
        });
    });

    function checkAnswer() {
        if(JSON.stringify(selected) === JSON.stringify(correctOrder)){
            alert("✅ Benar! Bagus sekali 🎉");
        } else {
            alert("❌ Coba lagi yuk!");
        }
    }
</script>
@endsection
