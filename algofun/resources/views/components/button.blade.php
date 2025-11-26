{{-- resources/views/components/button.blade.php --}}
@props([
'variant' => 'primary', // primary | secondary | soft | danger | outline | icon | floating
'size' => 'md', // sm | md | lg
'block' => false,
'icon' => null,
'color' => null, // optional override hex or tailwind color
'href' => null,
'type' => 'button',
'disabled' => false,
])

@php
// size map (mobile-first)
$sizes = [
'sm' => 'px-4 py-2.5 text-[14px] sm:text-[15px]',
'md' => 'px-5 py-3 text-[16px] sm:text-[17px]',
'lg' => 'px-6 py-4 text-[18px] sm:text-[20px]',
];

// palette (defaults)
$palette = [
'orange' => '#EB580C',
'orange_hover' => '#ff6a1f',
'lime' => '#8EE000',
'lime_hover' => '#7BC800',
'sky' => '#1CB0F6',
'sky_hover' => '#0FA3DB',
'yellow' => '#FFC107',
'yellow_hover' => '#E0A800',
'danger' => '#EF4444',
'danger_hover' => '#d73a3a',
'neutral' => '#F4F4F4',
'neutral_text' => '#4C4C4C',
];

// default config per variant (no closures)
if ($variant === 'primary') {
$cfg = [
'bg' => $color ?? $palette['orange'],
'hover' => $color ? null : $palette['orange_hover'],
'text' => '#FFFFFF',
'rounded' => 'rounded-3xl',
'shadow' => 'shadow-md',
'pclasses' => null,
'border' => null,
];
} elseif ($variant === 'secondary') {
$cfg = [
'bg' => '#FFFFFF',
'hover' => null,
'text' => $color ?? $palette['orange'],
'rounded' => 'rounded-3xl',
'shadow' => 'shadow-sm',
'pclasses' => null,
'border' => $color ?? $palette['orange'],
];
} elseif ($variant === 'soft') {
$cfg = [
'bg' => $palette['neutral'],
'hover' => null,
'text' => $palette['neutral_text'],
'rounded' => 'rounded-3xl',
'shadow' => 'shadow-sm',
'pclasses' => null,
'border' => null,
];
} elseif ($variant === 'danger') {
$cfg = [
'bg' => $palette['danger'],
'hover' => $palette['danger_hover'],
'text' => '#FFFFFF',
'rounded' => 'rounded-3xl',
'shadow' => 'shadow-md',
'pclasses' => null,
'border' => null,
];
} elseif ($variant === 'outline') {
$cfg = [
'bg' => '#FFFFFF',
'hover' => null,
'text' => $color ?? $palette['orange'],
'rounded' => 'rounded-3xl',
'shadow' => 'shadow-none',
'pclasses' => null,
'border' => $color ?? $palette['orange'],
];
} elseif ($variant === 'icon') {
$cfg = [
'bg' => 'transparent',
'hover' => null,
'text' => $color ?? $palette['orange'],
'rounded' => 'rounded-full',
'shadow' => 'shadow-none',
'pclasses' => 'p-2',
'border' => null,
];
} elseif ($variant === 'floating') {
$cfg = [
'bg' => '#FFFFFF',
'hover' => null,
'text' => '#555555',
'rounded' => 'rounded-full',
'shadow' => 'shadow-md',
'pclasses' => 'px-5 py-3',
'border' => $color ?? $palette['lime'],
];
} else {
// fallback = primary
$cfg = [
'bg' => $color ?? $palette['orange'],
'hover' => $color ? null : $palette['orange_hover'],
'text' => '#FFFFFF',
'rounded' => 'rounded-3xl',
'shadow' => 'shadow-md',
'pclasses' => null,
'border' => null,
];
}

// disabled handling
if ($disabled) {
$disabledClass = 'opacity-70 pointer-events-none';
} else {
$disabledClass = '';
}

// compose classes
$base = 'inline-flex items-center justify-center gap-2 font-fredoka font-semibold transition-all duration-300 focus:outline-none';
$blockClass = $block ? 'w-full' : 'inline-flex';
$padding = $cfg['pclasses'] ?? $sizes[$size];
$rounded = $cfg['rounded'] ?? 'rounded-3xl';
$shadow = $cfg['shadow'] ?? 'shadow-md';
$borderClass = $cfg['border'] ? 'border' : '';
$borderColorStyle = $cfg['border'] ? "border-[{$cfg['border']}]" : '';
$textColor = $cfg['text'] ?? '#FFFFFF';
$bgStyle = $cfg['bg'] ? "background: {$cfg['bg']};" : '';
$hoverBg = $cfg['hover'] ?? null;
@endphp

@php
// final classes string (we'll still allow extra classes via $attributes)
$finalClasses = trim("{$base} {$blockClass} {$padding} {$rounded} {$shadow} {$borderClass} {$disabledClass}");
@endphp

{{-- Render --}}
@if($href)
<a href="{{ $href }}"
    {!! $attributes->merge(['class' => $finalClasses . ' ' . ($cfg['border'] ? $borderColorStyle : '')]) !!}
    style="{{ $bgStyle }} color: {{ $textColor }};"
    @if(!$disabled)
    onmouseenter="this.style.filter='brightness(.95)';"
    onmouseleave="this.style.filter='';"
    @endif
    >
    @if($icon)
    {{-- adjust this block to match your icon system; using <img> fallback --}}
    @if(Str::startsWith($icon, ['http','/']))
    <img src="{{ $icon }}" class="w-4 h-4" alt="icon">
    @else
    <i data-lucide="{{ $icon }}" class="w-5 h-5"></i>
    @endif
    @endif

    {{ $slot }}
</a>
@else
<button type="{{ $type }}"
    {!! $attributes->merge(['class' => $finalClasses . ' ' . ($cfg['border'] ? $borderColorStyle : '')]) !!}
    style="{{ $bgStyle }} color: {{ $textColor }};"
    @if(!$disabled)
    onmouseenter="this.style.filter='brightness(.95)';"
    onmouseleave="this.style.filter='';"
    @endif
    @if($disabled) disabled @endif
    >
    @if($icon)
    @if(Str::startsWith($icon, ['http','/']))
    <img src="{{ $icon }}" class="w-4 h-4" alt="icon">
    @else
    <i data-lucide="{{ $icon }}" class="w-5 h-5"></i>
    @endif
    @endif

    {{ $slot }}
</button>
@endif