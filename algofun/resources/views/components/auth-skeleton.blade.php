@props([
    'fields' => 5,
    'hasCheckbox' => false,
    'hasGoogleButton' => true,
    'layout' => 'auth' // 'auth' untuk login/forgot/reset, 'authregis' untuk register
])

{{-- Skeleton untuk layout AUTH (login, forgot, reset) --}}
@if($layout === 'auth')
<div class="auth-grid">
    {{-- LEFT SIDE - WAVE SKELETON (Desktop) --}}
    <div class="hidden lg:block wave-section">
        <div class="w-full h-full bg-gradient-to-br from-orange-100 via-orange-200 to-orange-300 animate-pulse"></div>
    </div>

    {{-- RIGHT SIDE - CONTENT SKELETON --}}
    <div class="content-section">
        {{-- MOBILE WAVE TOP SKELETON --}}
        <div class="lg:hidden w-full absolute top-0 z-0 wave-top">
            <div class="w-full h-full bg-gradient-to-r from-orange-100 via-orange-200 to-orange-100 animate-pulse"></div>
        </div>

        {{-- MAIN CONTENT SKELETON --}}
        <main class="flex-1 flex justify-center items-center px-6 lg:px-4 py-8 lg:py-8 mobile-content content-fix z-10 w-full relative">
            <div class="w-full lg:max-w-[400px] content-container">
                <div class="w-full max-w-lg mx-auto mt-20">
                    {{-- LOGO SKELETON --}}
                    <div class="relative w-full flex justify-center">
                        <div class="absolute -top-20 w-100 h-24 bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 rounded-2xl animate-shimmer bg-[length:200%_100%]"></div>
                    </div>

                    {{-- TITLE SKELETON --}}
                    <div class="mt-16 mb-1">
                        <div class="h-9 bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 rounded-lg mx-auto w-4/5 animate-shimmer bg-[length:200%_100%]"></div>
                    </div>

                    {{-- SUBTITLE SKELETON --}}
                    <div class="mb-6">
                        <div class="h-7 bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 rounded-lg mx-auto w-3/4 animate-shimmer bg-[length:200%_100%]"></div>
                    </div>

                    {{-- FORM SKELETON --}}
                    <div class="space-y-3 mt-6">
                        @for($i = 0; $i < $fields; $i++)
                        <div>
                            <div class="h-4 bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 rounded w-{{ ['16', '24', '32', '28', '20'][$i % 5] }} mb-1 animate-shimmer bg-[length:200%_100%]"></div>
                            <div class="w-full h-10 bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 rounded-lg animate-shimmer bg-[length:200%_100%]"></div>
                        </div>
                        @endfor

                        {{-- Remember & Forgot (untuk login) --}}
                        @if($fields === 2)
                        <div class="flex items-center justify-between pt-1">
                            <div class="h-4 bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 rounded w-24 animate-shimmer bg-[length:200%_100%]"></div>
                            <div class="h-4 bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 rounded w-32 animate-shimmer bg-[length:200%_100%]"></div>
                        </div>
                        @endif

                        {{-- BUTTON --}}
                        <div class="pt-2">
                            <div class="w-full h-10 bg-gradient-to-r from-gray-300 via-gray-400 to-gray-300 rounded-lg animate-shimmer bg-[length:200%_100%]"></div>
                        </div>

                        {{-- DIVIDER & GOOGLE --}}
                        @if($hasGoogleButton)
                        <div class="relative flex items-center justify-center my-4 pt-2">
                            <div class="border-t border-gray-200 w-full"></div>
                            <div class="absolute bg-white px-3">
                                <div class="h-4 w-12 bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 rounded animate-shimmer bg-[length:200%_100%]"></div>
                            </div>
                        </div>
                        <div class="w-full h-10 bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 rounded-lg animate-shimmer bg-[length:200%_100%]"></div>
                        @endif

                        {{-- FOOTER LINK --}}
                        <div class="text-center mt-4 pt-2">
                            <div class="h-4 bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 rounded w-48 mx-auto animate-shimmer bg-[length:200%_100%]"></div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        {{-- MOBILE WAVE BOTTOM SKELETON --}}
        <div class="lg:hidden w-full absolute bottom-0 z-0 wave-bottom">
            <div class="w-full h-full bg-gradient-to-r from-orange-100 via-orange-200 to-orange-100 animate-pulse"></div>
        </div>
    </div>
</div>
@endif

{{-- Skeleton untuk layout AUTHREGIS (register dengan card) --}}
@if($layout === 'authregis')
<div class="w-full max-w-lg mx-auto bg-white shadow-[0_8px_30px_rgba(255,150,90,0.25)]
            border border-[#EAEAEA] rounded-3xl 
            p-4 lg:p-8 
            mt-0 lg:mt-20">

    {{-- LOGO SKELETON --}}
    <div class="relative w-full flex justify-center">
        <div class="absolute -top-23 w-100 h-24 bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 rounded-2xl animate-shimmer bg-[length:200%_100%]"></div>
    </div>

    {{-- TITLE SKELETON --}}
    <div class="mt-10 mb-2">
        <div class="h-9 bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 rounded-lg mx-auto w-4/5 animate-shimmer bg-[length:200%_100%]"></div>
    </div>

    {{-- SUBTITLE SKELETON --}}
    <div class="mb-4">
        <div class="h-6 bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 rounded-lg mx-auto w-3/4 animate-shimmer bg-[length:200%_100%]"></div>
    </div>

    {{-- FORM SKELETON --}}
    <div class="space-y-3 font-nunito mt-6">
        @for($i = 0; $i < $fields; $i++)
        <div>
            <div class="h-4 bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 rounded w-{{ ['32', '28', '16', '24', '40'][$i % 5] }} mb-1 animate-shimmer bg-[length:200%_100%]"></div>
            <div class="w-full h-11 bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 rounded-lg animate-shimmer bg-[length:200%_100%]"></div>
        </div>
        @endfor

        @if($hasCheckbox)
        <div class="flex items-start gap-2 pt-1">
            <div class="w-4 h-4 bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 rounded animate-shimmer bg-[length:200%_100%] mt-1"></div>
            <div class="flex-1 h-4 bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 rounded animate-shimmer bg-[length:200%_100%]"></div>
        </div>
        @endif

        {{-- BUTTON --}}
        <div class="pt-2">
            <div class="w-full h-11 bg-gradient-to-r from-gray-300 via-gray-400 to-gray-300 rounded-lg animate-shimmer bg-[length:200%_100%]"></div>
        </div>

        @if($hasGoogleButton)
        <div class="relative flex items-center justify-center my-4 pt-2">
            <div class="border-t border-gray-200 w-full"></div>
            <div class="absolute bg-white px-3">
                <div class="h-4 w-12 bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 rounded animate-shimmer bg-[length:200%_100%]"></div>
            </div>
        </div>
        <div class="w-full h-11 bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 rounded-lg animate-shimmer bg-[length:200%_100%]"></div>
        @endif

        {{-- FOOTER LINK --}}
        <div class="text-center mt-4 pt-2">
            <div class="h-4 bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 rounded w-48 mx-auto animate-shimmer bg-[length:200%_100%]"></div>
        </div>
    </div>
</div>
@endif

<style>
@keyframes shimmer {
    0% {
        background-position: -200% 0;
    }
    100% {
        background-position: 200% 0;
    }
}

.animate-shimmer {
    animation: shimmer 2s infinite linear;
}
</style>