@extends('layouts.students')

@section('content')
<div class="max-w-2xl mx-auto p-6">
    <h2 class="text-xl font-bold text-center mb-4">{{ $question['text'] }}</h2>

    <div class="grid grid-cols-2 gap-4">
        <div>
            @foreach($question['left'] as $item)
                <div class="pair-left bg-gray-100 p-3 mb-2 rounded-lg cursor-pointer" data-id="{{ $item['id'] }}">
                    {{ $item['text'] }}
                </div>
            @endforeach
        </div>
        <div>
            @foreach($question['right'] as $item)
                <div class="pair-right bg-gray-100 p-3 mb-2 rounded-lg cursor-pointer" data-id="{{ $item['id'] }}">
                    {{ $item['text'] }}
                </div>
            @endforeach
        </div>
    </div>

    <div class="mt-6 flex justify-between">
        <button class="bg-gray-300 px-4 py-2 rounded-lg">Lompati</button>
        <button onclick="checkMatch()" class="bg-green-400 px-4 py-2 rounded-lg">Periksa</button>
    </div>
</div>

<script>
    let selectedLeft = null;
    let matches = [];

    document.querySelectorAll('.pair-left').forEach(el => {
        el.addEventListener('click', () => {
            selectedLeft = el.dataset.id;
            el.classList.add('bg-yellow-300');
        });
    });

    document.querySelectorAll('.pair-right').forEach(el => {
        el.addEventListener('click', () => {
            if(selectedLeft){
                matches.push([selectedLeft, el.dataset.id]);
                el.classList.add('bg-yellow-300');
                selectedLeft = null;
            }
        });
    });

    function checkMatch(){
        const correct = @json($question['correct']);
        if(JSON.stringify(matches.sort()) === JSON.stringify(correct.sort())){
            alert("✅ Benar! 🎉");
        } else {
            alert("❌ Salah, coba lagi!");
        }
    }
</script>
@endsection
