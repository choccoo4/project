<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title ?? 'AlgoFun' }}</title>

  <script src="https://cdn.tailwindcss.com"></script>
  @vite('resources/css/app.css')
  <script defer src="//unpkg.com/alpinejs"></script>

  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@600&family=Nunito:wght@400;600;800&display=swap" rel="stylesheet">

  <style>
      /* PAKSA mobile tanpa jarak sama sekali */
      @media (max-width: 1023px) {
          .no-gap {
              padding-top: 0 !important;
              padding-bottom: 0 !important;
          }
          .wave-mobile {
            display: block;
            margin: 0;
            padding: 0;
            line-height: 0;
    }
      }
  </style>
</head>

<body class="bg-[#FFF8F2] min-h-screen flex flex-col relative overflow-x-hidden">

    {{-- DESKTOP WAVE (LEFT SIDE) --}}
    <div class="hidden lg:block absolute inset-y-0 left-0 w-[40%] overflow-hidden pointer-events-none">
        <x-wave />
    </div>

    {{-- MOBILE WAVE TOP --}}
    <div class="lg:hidden w-full leading-none">
        <img src="{{ asset('images/asset/wavess.svg') }}" 
             class="w-full wave-mobile rotate-180"
             alt="Wave Top">
    </div>

    {{-- MAIN CONTENT WRAPPER --}}
<main class="flex-1 flex justify-center items-center px-4 py-0 lg:py-8 no-gap content-fix z-10"> 
    <div class="w-full lg:max-w-[480px] lg:ml-auto lg:pr-12">
        @yield('content')
    </div>
</main>

    {{-- MOBILE WAVE BOTTOM --}}
    <div class="lg:hidden w-full leading-none">
        <img src="{{ asset('images/asset/waves.svg') }}" 
     class="w-full wave-mobile"
     style="transform: rotate(180deg);"
     alt="Wave Bottom">
    </div>

</body>
</html>
