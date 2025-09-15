<!doctype html>
<html lang="id" x-data="quizResult()" class="antialiased">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Hasil Quiz • AlgoFun</title>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CDN (for quick paste) — replace with your compiled CSS in production -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>

    <!-- Alpine -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        :root {
            --accent: #EB580C;
            /* Oranye utama */
            --bg: #FFF8F2;
            /* Kuning pastel / near-white */
            --success: #22C55E;
            /* Hijau */
            --info: #3B82F6;
            /* Biru muda */
            --text: #374151;
            /* teks utama */
        }

        body {
            font-family: "Poppins", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            background: var(--bg);
            color: var(--text);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Circular progress (SVG) animation helper */
        .progress-ring__circle {
            transition: stroke-dashoffset 800ms cubic-bezier(.2, .9, .2, 1);
            transform: rotate(-90deg);
            transform-origin: 50% 50%;
        }

        /* confetti pieces */
        .conf-piece {
            position: fixed;
            width: 10px;
            height: 10px;
            border-radius: 2px;
            z-index: 60;
            pointer-events: none;
            will-change: transform, opacity;
        }

        /* subtle bounce for icons */
        .btn-raise {
            transition: transform .18s ease, box-shadow .18s ease;
        }

        .btn-raise:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        }

        /* small helper to visually hide but keep accessible */
        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }
    </style>
</head>

<body>

    <!-- Confetti container -->
    <div id="confetti-root" aria-hidden="true"></div>

    <!-- Page container -->
    <div class="min-h-screen flex flex-col items-center px-4 py-8">

        <!-- Header -->
        <header class="w-full max-w-4xl flex items-center justify-between mb-6">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center bg-white shadow">
                    <!-- use lucide award icon -->
                    <i data-lucide="award" class="w-6 h-6 text-[var(--accent)]"></i>
                </div>
                <div>
                    <h1 class="text-xl font-extrabold" style="color:var(--accent)">AlgoFun • Hasil Quiz</h1>
                    <p class="text-sm text-gray-600">Ringkasan hasil & hadiah XP kamu</p>
                </div>
            </div>

            <nav class="flex items-center gap-3">
                <a href="/dashboard" class="inline-flex items-center gap-2 bg-white rounded-2xl px-3 py-2 shadow text-sm hover:bg-white/80 btn-raise">
                    <i data-lucide="home" class="w-4 h-4 text-[var(--text)]"></i>
                    <span class="text-[var(--text)] font-semibold">Beranda</span>
                </a>
            </nav>
        </header>

        <!-- Main card -->
        <main class="w-full max-w-4xl">
            <section class="bg-white rounded-2xl shadow p-6 lg:p-8">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">

                    <!-- LEFT: big result + feedback -->
                    <div class="lg:col-span-2 rounded-xl p-4">
                        <!-- hero -->
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-20 h-20 rounded-2xl flex items-center justify-center bg-[var(--accent)]/10 border border-[var(--accent)]/10">
                                <i data-lucide="trophy" class="w-8 h-8 text-[var(--accent)]"></i>
                            </div>
                            <div>
                                <h2 class="text-2xl font-extrabold" style="color:var(--accent)" x-text="result.title">Kerja Bagus!</h2>
                                <p class="text-sm text-gray-600 mt-1" x-text="result.subtitle">Kamu menyelesaikan kuis — berikut ringkasannya.</p>
                            </div>
                        </div>

                        <!-- feedback box -->
                        <div class="rounded-2xl p-4 mb-4 border border-[var(--accent)]/10 bg-[var(--accent)]/5">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-sm">
                                    <i :data-lucide="result.icon" class="w-6 h-6 text-[var(--accent)]"></i>
                                </div>
                                <div>
                                    <div class="font-semibold text-[var(--text)]" x-text="result.message">Bagus — teruskan!</div>
                                    <div class="text-xs text-gray-500">Tip: klik "Ulangi" untuk latihan tambahan.</div>
                                </div>
                            </div>
                        </div>

                        <!-- stats badges -->
                        <div class="grid grid-cols-3 gap-3 mt-2">
                            <div class="bg-white rounded-2xl p-3 shadow border border-gray-100 flex flex-col items-center">
                                <div class="text-xs text-gray-500">Benar</div>
                                <div class="text-2xl font-extrabold text-[var(--success)]" x-text="correctCount">0</div>
                            </div>
                            <div class="bg-white rounded-2xl p-3 shadow border border-gray-100 flex flex-col items-center">
                                <div class="text-xs text-gray-500">Salah</div>
                                <div class="text-2xl font-extrabold text-red-500" x-text="wrongCount">0</div>
                            </div>
                            <div class="bg-white rounded-2xl p-3 shadow border border-gray-100 flex flex-col items-center">
                                <div class="text-xs text-gray-500">XP</div>
                                <div class="text-2xl font-extrabold text-yellow-600" x-text="xp">0</div>
                            </div>
                        </div>

                        <!-- progress (linear) -->
                        <div class="mt-5">
                            <div class="flex items-center justify-between mb-2">
                                <div class="text-sm font-semibold text-[var(--text)]">Progress</div>
                                <div class="text-sm font-semibold text-[var(--accent)]" x-text="`${correctCount}/${totalQuestions}`">0/0</div>
                            </div>

                            <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden">
                                <div id="linear-bar" class="h-full bg-[var(--accent)] transition-all duration-700" :style="`width:${percentage}%`"></div>
                            </div>

                            <div class="text-xs text-gray-500 mt-2" x-text="`${percentage}% selesai`">0% selesai</div>
                        </div>
                    </div>

                    <!-- RIGHT: circular progress + actions -->
                    <aside class="flex flex-col items-center gap-4 p-4">
                        <!-- circular progress SVG -->
                        <div class="rounded-2xl bg-white p-4 shadow w-48 flex flex-col items-center">
                            <svg width="120" height="120" viewBox="0 0 120 120" class="mb-2">
                                <defs>
                                    <linearGradient id="g1" x1="0" x2="1" y1="0" y2="1">
                                        <stop offset="0" stop-color="#FFB703" />
                                        <stop offset="1" stop-color="#EB580C" />
                                    </linearGradient>
                                </defs>
                                <circle cx="60" cy="60" r="48" fill="#fff" stroke="#f0f0f0" stroke-width="8"></circle>
                                <circle cx="60" cy="60" r="48" fill="transparent" stroke="url(#g1)" stroke-width="8"
                                    stroke-linecap="round" class="progress-ring__circle" :stroke-dasharray="strokeDashArray" :style="`stroke-dashoffset:${strokeDashOffset}`" />
                                <text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" class="font-bold" style="fill:var(--text); font-size:18px;" x-text="`${percentage}%`">0%</text>
                            </svg>

                            <div class="text-sm text-gray-600 mb-2">Kamu menyelesaikan</div>
                            <div class="text-lg font-extrabold text-[var(--accent)]" x-text="levelText">Level</div>

                            <div class="mt-3 w-full">
                                <button @click="retry()" class="w-full inline-flex items-center justify-center gap-2 px-3 py-2 rounded-2xl bg-[var(--accent)] text-white font-semibold btn-raise">
                                    <i data-lucide="refresh-cw" class="w-4 h-4"></i> Ulangi
                                </button>
                                <a href="/dashboard" class="mt-2 w-full inline-flex items-center justify-center gap-2 px-3 py-2 rounded-2xl bg-[var(--info)] text-white font-semibold btn-raise">
                                    <i data-lucide="home" class="w-4 h-4"></i> Beranda
                                </a>
                            </div>
                        </div>

                        <!-- small tips card -->
                        <div class="w-full rounded-2xl p-3 bg-[var(--bg)] border border-[var(--accent)]/10 text-sm text-gray-700">
                            <div class="font-semibold text-[var(--accent)] mb-1">Tips Cepat</div>
                            <div x-text="quickTip">Coba ulang materi bagian yang salah.</div>
                        </div>
                    </aside>

                </div>
            </section>
        </main>
    </div>

    <!-- Script: Alpine data + animations -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('quizResult', () => ({

                // data placeholders (ambil dari localStorage atau dummy)
                correctCount: 0,
                wrongCount: 0,
                xp: 0,
                totalQuestions: 0,
                percentage: 0,
                levelText: 'Desa Pemula',
                result: {
                    title: 'Kerja Bagus!',
                    subtitle: 'Ringkasan hasilmu',
                    icon: 'trophy',
                    message: 'Terus berlatih untuk dapat lebih banyak XP!'
                },
                quickTip: 'Ulangi soal yang salah dan coba lagi!',

                // computed helpers for SVG circle
                strokeDashArray: null,
                strokeDashOffset: null,

                init() {
                    // load results (format sama seperti yang kamu simpan)
                    const stored = JSON.parse(localStorage.getItem('quizResults') || 'null');
                    const data = stored || {
                        correctCount: 3,
                        wrongCount: 1,
                        totalQuestions: 4,
                        xp: 30
                    };

                    this.correctCount = data.correctCount || 0;
                    this.wrongCount = data.wrongCount || 0;
                    this.xp = data.xp || 0;
                    this.totalQuestions = data.totalQuestions || 0;
                    this.percentage = this.totalQuestions > 0 ? Math.round((this.correctCount / this.totalQuestions) * 100) : 0;

                    // result message & icon based on percentage (consistent and simple)
                    if (this.percentage >= 90) {
                        this.result.title = 'Sempurna!';
                        this.result.icon = 'award';
                        this.result.message = 'Luar biasa — kamu hebat!';
                        this.levelText = 'Master';
                        this.quickTip = 'Ayo tantang dirimu di level berikutnya!';
                        this.triggerConfetti();
                    } else if (this.percentage >= 70) {
                        this.result.title = 'Bagus!';
                        this.result.icon = 'star';
                        this.result.message = 'Kamu hampir sempurna — lanjutkan!';
                        this.levelText = 'Terampil';
                        this.quickTip = 'Ulangi 1-2 soal yang salah untuk jadi lebih kuat.';
                        this.triggerConfetti();
                    } else if (this.percentage >= 50) {
                        this.result.title = 'Cukup!';
                        this.result.icon = 'thumbs-up';
                        this.result.message = 'Usaha bagus — terus berlatih!';
                        this.levelText = 'Berlatih';
                        this.quickTip = 'Perhatikan penjelasan pada soal yang salah.';
                    } else {
                        this.result.title = 'Tetap Semangat!';
                        this.result.icon = 'heart';
                        this.result.message = 'Jangan khawatir — coba lagi dan kamu pasti bisa!';
                        this.levelText = 'Pemula';
                        this.quickTip = 'Coba ulang kuis untuk memperbaiki skor.';
                    }

                    // prepare SVG circular progress values
                    const radius = 48; // matches SVG r
                    const circumference = 2 * Math.PI * radius;
                    this.strokeDashArray = `${circumference} ${circumference}`;
                    // offset such that 0% shows full circumference hidden (stroke-dashoffset = circumference)
                    this.strokeDashOffset = circumference - (this.percentage / 100) * circumference;

                    // animate linear bar (slightly delayed for feel)
                    setTimeout(() => {
                        const linear = document.getElementById('linear-bar');
                        if (linear) linear.style.width = `${this.percentage}%`;
                    }, 200);

                    // animate numbers (gentle)
                    setTimeout(() => this.animateNumber('#', '#'), 250);

                    // render lucide icons
                    if (window.lucide && typeof window.lucide.createIcons === 'function') {
                        window.lucide.createIcons();
                    }
                },

                // simple confetti effect (pastel pieces)
                triggerConfetti() {
                    const root = document.getElementById('confetti-root');
                    if (!root) return;
                    const colors = ['#FEC5E5', '#A2D2FF', '#C8FFD4', '#FFF6BD', '#E5B8F4'];
                    for (let i = 0; i < 36; i++) {
                        const el = document.createElement('div');
                        el.className = 'conf-piece';
                        el.style.left = Math.random() * 100 + 'vw';
                        el.style.top = (-10 - Math.random() * 30) + 'vh';
                        el.style.background = colors[Math.floor(Math.random() * colors.length)];
                        el.style.transform = `translateY(0) rotate(${Math.random()*360}deg)`;
                        el.style.opacity = '0.95';
                        el.style.width = `${6 + Math.random()*8}px`;
                        el.style.height = `${6 + Math.random()*8}px`;
                        // animate using CSS + JS
                        const duration = 2000 + Math.random() * 2000;
                        el.animate([{
                                transform: `translateY(0) rotate(0deg)`,
                                opacity: 1
                            },
                            {
                                transform: `translateY(${80 + Math.random()*400}vh) rotate(${540 + Math.random()*720}deg)`,
                                opacity: 0
                            }
                        ], {
                            duration,
                            easing: 'cubic-bezier(.2,.9,.2,1)'
                        });
                        root.appendChild(el);
                        setTimeout(() => el.remove(), duration + 100);
                    }
                },

                // Called when user clicks retry
                retry() {
                    // simple redirect — you can change to route or in-page reset
                    window.location.href = '/soal/1';
                },

                // small animated counters if needed (kept minimal)
                animateNumber() {
                    const correctEl = document.querySelector('[x-text="correctCount"]') || document.getElementById('correct-count');
                    const wrongEl = document.querySelector('[x-text="wrongCount"]') || document.getElementById('wrong-count');
                    const xpEl = document.querySelector('[x-text="xp"]') || null;

                    // animate by simple increments (non-blocking)
                    function tween(el, from, to, ms = 1000) {
                        if (!el) return;
                        const start = performance.now();
                        const step = (now) => {
                            const t = Math.min((now - start) / ms, 1);
                            const val = Math.round(from + (to - from) * t);
                            el.textContent = val;
                            if (t < 1) requestAnimationFrame(step);
                        };
                        requestAnimationFrame(step);
                    }

                    tween(document.getElementById('correct-count'), 0, this.correctCount, 900);
                    tween(document.getElementById('wrong-count'), 0, this.wrongCount, 900);
                    const xpNode = document.getElementById('xp-node');
                    if (xpNode) tween(xpNode, 0, this.xp, 1000);
                }

            }));
        });

        // init data after DOM ready (so Alpine init runs)
        document.addEventListener('DOMContentLoaded', () => {
            // Alpine will auto init; ensure icons are rendered
            if (window.lucide && typeof window.lucide.createIcons === 'function') {
                window.lucide.createIcons();
            }
        });
    </script>
</body>

</html>