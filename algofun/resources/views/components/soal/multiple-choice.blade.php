<div>
  <h2 class="text-lg font-bold mb-4">{{ $soal['question'] }}</h2>
  <div id="choices" class="space-y-2">
    @foreach($soal['options'] as $option)
      <button onclick="selectChoice(this)" 
              class="w-full px-4 py-2 rounded-lg bg-gray-200 text-left">
        {{ $option }}
      </button>
    @endforeach
  </div>
</div>

<script>
  let selectedChoice = null;
  const correctAnswerMCQ = @json($soal['answer']);

  function selectChoice(btn){
    document.querySelectorAll("#choices button").forEach(b => {
      b.classList.remove("bg-blue-300");
      b.classList.add("bg-gray-200");
    });
    btn.classList.remove("bg-gray-200");
    btn.classList.add("bg-blue-300");
    selectedChoice = btn.innerText.trim();
  }

  // dipanggil oleh tombol Periksa (parent)
  window.localCheck = function(){
    const isCorrect = (selectedChoice === correctAnswerMCQ);
    const correctText = correctAnswerMCQ;
    handleCheckResult(isCorrect, correctText);
  };
</script>
