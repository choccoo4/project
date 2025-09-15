@extends('layouts.students')

@section('content')
<div class="max-w-xl mx-auto p-6">
    <h2 class="text-xl font-bold text-center mb-4">{{ $question['text'] }}</h2>

    <div class="bg-gray-100 p-4 rounded-lg mb-6">
        {!! $question['sentence'] !!}
    </div>

    <input id="userAnswer" class="border p-2 w-full rounded-lg mb-6" placeholder="Tulis jawabanmu di sini">

    <div class="flex justify-between">
        <button class="bg-gray-300 px-4 py-2 rounded-lg">Lompati</button>
        <button onclick="checkFill()" class="bg-green-400 px-4 py-2 rounded-lg">Periksa</button>
    </div>
</div>

<script>
    const correct = @json($question['correct']);

    function checkFill(){
        const answer = document.getElementById('userAnswer').value.trim();
        if(answer.toLowerCase() === correct.toLowerCase()){
            alert("✅ Benar!");
        } else {
            alert("❌ Coba lagi yuk!");
        }
    }
</script>
@endsection
