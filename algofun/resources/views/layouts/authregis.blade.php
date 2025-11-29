<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'AlgoFun' }}</title>

    @vite('resources/css/app.css')
    <script defer src="//unpkg.com/alpinejs"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@600&family=Nunito:wght@400;600;800&display=swap" rel="stylesheet">

    <style>
        /* Mobile spacing yang SUPER besar */
        @media (max-width: 1023px) {
            .mobile-content {
                padding-top: 8rem !important;
                padding-bottom: 8rem !important;
                min-height: 100vh;
                display: flex;
                align-items: center;
            }

            .wave-mobile {
                display: block;
                margin: 0;
                padding: 0;
                line-height: 0;
            }

            .wave-top {
                height: 160px;
            }

            .wave-bottom {
                height: 170px;
            }

            .content-container {
                margin-top: 3rem;
                margin-bottom: 4rem;
            }
        }

        /* Grid layout untuk desktop - FIXED */
        @media (min-width: 1024px) {
            .auth-grid {
                display: grid;
                grid-template-columns: 45% 55%;
                min-height: 100vh;
            }

            .wave-section {
                position: relative;
                overflow: visible !important;
                /* UBAH: biar wave bisa extend */
            }

            /* Container wave yang lebih lebar */
            .wave-extended {
                position: absolute;
                top: 0;
                left: -50px;
                /* Extend 50px ke kiri */
                width: calc(100% + 100px);
                /* Lebih lebar 100px total */
                height: 100%;
            }

            /* Pastikan wave SVG memenuhi container extended */
            .wave-extended svg {
                width: 100%;
                height: 100%;
                display: block;
            }

            .content-section {
                display: flex;
                align-items: center;
                justify-content: center;
                position: relative;
                z-index: 1;
                /* Pastikan content di atas wave */
            }

            .content-container {
                margin-top: 0;
                margin-bottom: 0;
            }
        }
    </style>
</head>

<body class="bg-[#FFF8F2] min-h-screen flex flex-col relative overflow-x-hidden">

    {{-- GRID CONTAINER --}}
    <div class="auth-grid">

        {{-- LEFT SIDE - WAVE (EXTENDED) --}}
        <div class="hidden lg:block wave-section">
            <div class="wave-extended">
                <x-wave />
            </div>
        </div>

        {{-- RIGHT SIDE - CONTENT --}}
        <div class="content-section">
            {{-- MOBILE WAVE TOP --}}
            <div class="lg:hidden w-full leading-none absolute top-0 z-0 wave-top">
                <img src="{{ asset('images/asset/wavess.svg') }}"
                    class="w-full h-full object-cover wave-mobile"
                    alt="Wave Top">
            </div>

            {{-- MAIN CONTENT dengan spacing mobile yang SUPER besar --}}
            <main class="flex-1 flex justify-center items-center px-6 lg:px-4 py-8 lg:py-8 mobile-content content-fix z-10 w-full relative">
                <div class="w-full lg:max-w-[400px] content-container">
                    @yield('content')
                </div>
            </main>

            {{-- MOBILE WAVE BOTTOM --}}
            <div class="lg:hidden w-full leading-none absolute bottom-0 z-0 wave-bottom">
                <img src="{{ asset('images/asset/wavess.svg') }}"
                    class="w-full h-full object-cover wave-mobile"
                    style="transform: rotate(180deg);"
                    alt="Wave Bottom">
            </div>
        </div>
    </div>

</body>

</html>