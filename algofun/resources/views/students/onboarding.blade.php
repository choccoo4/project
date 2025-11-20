<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Onboarding • AlgoFun</title>

    @vite('resources/css/app.css')

    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600;700&family=Nunito:wght@400;600;700&display=swap"
        rel="stylesheet">

    <style>
        .slide-active {
            opacity: 1;
            transform: translateX(0);
        }
    </style>
</head>

<body class="bg-[#FFF8F2] h-screen overflow-hidden flex">

    <!-- WRAPPER -->
    <div class="w-full h-full relative overflow-hidden">

        <!-- SKIP -->
        <a href="{{ url('/login') }}"
            class="absolute top-5 right-5 font-fredoka text-orange-500 font-semibold z-20">
            Skip
        </a>

        <!-- SLIDE CONTAINER -->
        <div id="slides" class="w-full h-full flex transition-transform duration-500">

            <!-- SLIDE 1 -->
            <div class="w-full h-full flex flex-col items-center justify-center px-8 flex-shrink-0">
                <img src="https://img.icons8.com/color/480/kawaii-dinosaur.png" class="w-52 mb-6">
                <h2 class="font-fredoka text-3xl text-orange-500 font-bold text-center mb-3">
                    Selamat Datang di AlgoFun!
                </h2>
                <p class="text-gray-600 text-center max-w-sm">
                    Belajar matematika jadi lebih seru dengan level, XP, misi harian, dan soal interaktif.
                </p>
            </div>

            <!-- SLIDE 2 -->
            <div class="w-full h-full flex flex-col items-center justify-center px-8 flex-shrink-0">
                <img src="https://img.icons8.com/color/480/idea.png" class="w-52 mb-6">
                <h2 class="font-fredoka text-3xl text-orange-500 font-bold text-center mb-3">
                    Belajar Matematika Secara Bertahap
                </h2>
                <p class="text-gray-600 text-center max-w-sm">
                    Kamu belajar lewat soal-soal yang disusun dari yang mudah hingga sulit, mengikuti kemampuanmu.
                </p>
            </div>

            <!-- SLIDE 3 -->
            <div class="w-full h-full flex flex-col items-center justify-center px-8 flex-shrink-0">
                <img src="https://img.icons8.com/color/480/controller.png" class="w-52 mb-6">
                <h2 class="font-fredoka text-3xl text-orange-500 font-bold text-center mb-3">Belajar Ala Petualangan</h2>
                <p class="text-gray-600 text-center max-w-sm">
                    Naik level, kumpulkan XP, selesaikan misi, dan buka step pembelajaran berikutnya!
                </p>
            </div>

            <!-- SLIDE 4 -->
            <div class="w-full h-full flex flex-col items-center justify-center px-8 flex-shrink-0">
                <img src="https://img.icons8.com/color/480/artificial-intelligence.png" class="w-52 mb-6">
                <h2 class="font-fredoka text-3xl text-orange-500 font-bold text-center mb-3">Soal Otomatis dari AI</h2>
                <p class="text-gray-600 text-center max-w-sm">
                    Soal dibuat otomatis berdasarkan materi dari buku-buku, jadi selalu relevan.
                </p>
            </div>

            <!-- SLIDE 5 -->
            <div class="w-full h-full flex flex-col items-center justify-center px-8 flex-shrink-0">
                <img src="https://img.icons8.com/color/480/combo-chart.png" class="w-52 mb-6">
                <h2 class="font-fredoka text-3xl text-orange-500 font-bold text-center mb-3">Analisis Belajar</h2>
                <p class="text-gray-600 text-center max-w-sm">
                    AI membantu menemukan kelemahanmu dan memberi latihan remedial yang tepat sasaran.
                </p>

                <a href="{{ url('/login') }}"
                    class="mt-6 bg-orange-500 text-white font-fredoka px-8 py-3 rounded-2xl text-lg shadow hover:bg-orange-600">
                    Mulai Belajar
                </a>
            </div>

        </div>

        <!-- INDICATOR -->
        <div class="absolute bottom-18 w-full flex justify-center gap-2">
            <div class="dot w-3 h-3 bg-orange-200 rounded-full transition-all"></div>
            <div class="dot w-3 h-3 bg-orange-200 rounded-full transition-all"></div>
            <div class="dot w-3 h-3 bg-orange-200 rounded-full transition-all"></div>
            <div class="dot w-3 h-3 bg-orange-200 rounded-full transition-all"></div>
            <div class="dot w-3 h-3 bg-orange-200 rounded-full transition-all"></div>
        </div>

        <!-- NEXT BUTTON -->
        <button id="nextBtn"
            class="absolute bottom-10 right-6 bg-orange-500 text-white font-fredoka font-semibold px-6 py-3 rounded-2xl shadow hover:bg-orange-600">
            Next
        </button>

    </div>

    <script>
        const slides = document.getElementById("slides");
        const dots = document.querySelectorAll(".dot");
        const nextBtn = document.getElementById("nextBtn");

        let index = 0;
        const total = 5;

        function updateSlide() {
            slides.style.transform = `translateX(-${index * 100}%)`;

            dots.forEach((d, i) => {
                d.style.width = i === index ? "20px" : "12px";
                d.style.backgroundColor = i === index ? "#EB580C" : "#FBD1B0";
            });

            // Hide next button on last slide
            nextBtn.style.display = index === total - 1 ? "none" : "block";
        }

        nextBtn.addEventListener("click", () => {
            if (index < total - 1) index++;
            updateSlide();
        });

        updateSlide();
    </script>

</body>

</html>