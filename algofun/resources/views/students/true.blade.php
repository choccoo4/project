@extends('layouts.students')

@section('content')
<div class="max-w-xl mx-auto p-6 text-center">
    <h2 class="text-xl font-bold mb-6">{{ $question['text'] }}</h2>

    <div class="flex justify-center space-x-6 mb-6">
        <button onclick="checkAnswer(true)" class="bg-green-300 px-6 py-3 rounded-lg">Benar</button>
        <button onclick="checkAnswer(false)" class="bg-red-300 px-6 py-3 rounded-lg">Salah</button>
    </div>
</div>

<script>
    const correct = @json($question['correct']);

    function checkAnswer(ans){
        if(ans === correct){
            alert("✅ Betul sekali!");
        } else {
            alert("❌ Masih salah!");
        }
    }
</script>
@endsection
