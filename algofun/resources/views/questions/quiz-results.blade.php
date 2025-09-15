<!DOCTYPE html>
<html lang="id" x-data="quizResult()" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <title>Hasil Quiz - AlgoFun</title>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body {
            background: linear-gradient(135deg, #f9e8ff, #dff6ff, #fff7e5);
            font-family: "Poppins", sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .result-card {
            background: #fff;
            border-radius: 2rem;
            padding: 2rem;
            width: 90%;
            max-width: 480px;
            text-align: center;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .ribbon {
            width: 120px;
            height: 30px;
            background: #ff7eb3;
            color: white;
            font-weight: bold;
            line-height: 30px;
            border-radius: 8px 8px 0 0;
            position: absolute;
            top: -30px;
            left: 50%;
            transform: translateX(-50%);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        .circle-progress {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            background: conic-gradient(#ff7eb3 calc(var(--percent)*1%), #eee 0);
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 1.5rem auto;
            position: relative;
        }

        .circle-progress span {
            position: absolute;
            font-size: 1.5rem;
            font-weight: bold;
            color: #444;
        }

        .xp-box {
            background: linear-gradient(135deg, #ffe27d, #ffc107);
            border-radius: 1rem;
            padding: 1rem;
            margin: 1.5rem 0;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.8rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
            animation: pulse 2s infinite;
        }

        .coin {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: radial-gradient(circle at 30% 30%, #fff9c4, #fbc02d);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            animation: spin 3s linear infinite;
        }

        @keyframes spin {
            from {
                transform: rotateY(0deg);
            }

            to {
                transform: rotateY(360deg);
            }
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.9rem 1.5rem;
            margin: 0.5rem;
            border-radius: 1rem;
            font-weight: bold;
            color: white;
            text-decoration: none;
            transition: 0.3s;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        .btn:hover {
            transform: translateY(-3px) scale(1.05);
        }

        .btn-retry {
            background: linear-gradient(135deg, #ff7eb3, #ff5277);
        }

        .btn-home {
            background: linear-gradient(135deg, #00c6ff, #0072ff);
        }
    </style>
</head>

<body>
    <div class="result-card" x-data="quizResult()">
        <div class="ribbon">🎉 Hasil</div>

        <!-- Ikon -->
        <div style="margin-top:2rem; margin-bottom:1rem;">
            <i :data-lucide="result.icon" class="w-12 h-12" :class="result.color"></i>
            <h2 x-text="result.text" class="mt-2 text-xl font-bold text-gray-700"></h2>
        </div>

        <!-- Circular Progress -->
        <div class="circle-progress" :style="`--percent:${percentage}`">
            <span x-text="`${percentage}%`"></span>
        </div>
        <div class="text-gray-600 font-semibold" x-text="`${correctCount} benar / ${totalQuestions} soal`"></div>

        <!-- XP -->
        <div class="xp-box">
            <div class="coin">⭐</div>
            <div>
                <div class="text-lg font-bold text-yellow-800">+<span x-text="xp"></span> XP</div>
                <div class="text-sm text-yellow-900">Skor energi kamu 🎯</div>
            </div>
        </div>

        <!-- Tombol -->
        <div>
            <a href="/soal/1" class="btn btn-retry">
                <i data-lucide="refresh-cw"></i> Ulangi Quiz
            </a>
            <a href="/" class="btn btn-home">
                <i data-lucide="home"></i> Beranda
            </a>
        </div>
    </div>

    <script>
        function quizResult() {
            const dummyData = {
                correctCount: 3,
                wrongCount: 2,
                xp: 15,
                totalQuestions: 5
            };
            const results = JSON.parse(localStorage.getItem('quizResults') || JSON.stringify(dummyData));

            const correctCount = results.correctCount || 0;
            const wrongCount = results.wrongCount || 0;
            const xp = results.xp || 0;
            const totalQuestions = results.totalQuestions || 0;
            const percentage = totalQuestions > 0 ? Math.round((correctCount / totalQuestions) * 100) : 0;

            let result = {};
            if (percentage >= 90) result = {
                text: "Sempurna!",
                icon: "trophy",
                color: "text-green-600"
            };
            else if (percentage >= 70) result = {
                text: "Bagus!",
                icon: "thumbs-up",
                color: "text-blue-600"
            };
            else if (percentage >= 50) result = {
                text: "Cukup baik!",
                icon: "seedling",
                color: "text-yellow-600"
            };
            else result = {
                text: "Coba lagi!",
                icon: "zap",
                color: "text-orange-600"
            };

            return {
                correctCount,
                wrongCount,
                xp,
                totalQuestions,
                percentage,
                result
            };
        }

        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) window.lucide.createIcons();
        });
    </script>
</body>

</html>