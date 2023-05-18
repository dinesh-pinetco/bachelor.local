@props(['color' => 'primary', 'link'])
<header class="relative text-sm">
    <p class="flex flex-wrap py-2.5 items-center bg-{{ $color }} bg-opacity-10 px-4 font-medium text-black px-4 md:px-10">
        {{ $slot }}

        @if(isset($link))
            <a {{ $link->attributes->merge(['class' => 'text-'.$color.' underline']) }}>
                {{ $link }}
            </a>
        @endif
    </p>
</header>
