<div>
  <h2 class="text-lg font-bold mb-4">{{ $soal['question'] }}</h2>
  <div id="ordering-options" class="flex flex-wrap gap-2">
    @foreach($soal['options'] as $opt)
      <button onclick="selectOrder(this)" class="px-4 py-2 rounded-lg bg-gray-200">
        {{ $opt }}
      </button>
    @endforeach
  </div>

  <div id="selected-order" class="flex gap-2 mt-4 min-h-[40px]"></div>
</div>

<script>
  let selectedOrder = [];
  const correctOrder = @json($soal['answer']);

  function selectOrder(btn){
    const val = btn.innerText.trim();

    if(selectedOrder.includes(val)){
      selectedOrder = selectedOrder.filter(x => x !== val);
      btn.classList.remove("bg-blue-300");
      btn.classList.add("bg-gray-200");
    } else {
      selectedOrder.push(val);
      btn.classList.remove("bg-gray-200");
      btn.classList.add("bg-blue-300");
    }

    document.getElementById("selected-order").innerHTML =
      selectedOrder.map((v,i)=> `<span class="px-3 py-1 rounded-full bg-blue-100">${i+1}. ${v}</span>`).join(" ");
  }

  // dipanggil oleh tombol Periksa (parent)
  window.localCheck = function(){
    const isCorrect = JSON.stringify(selectedOrder) === JSON.stringify(correctOrder);
    const correctText = correctOrder.join(' → ');
    handleCheckResult(isCorrect, correctText);
  };
</script>
