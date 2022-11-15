@props(['id', 'maxWidth'])

@php
    $id = $id ?? md5($attributes->wire('model'));

    $maxWidth = [
        'sm' => 'sm:max-w-sm',
        'md' => 'sm:max-w-md',
        'lg' => 'sm:max-w-lg',
        'xl' => 'sm:max-w-xl',
        '2xl' => 'sm:max-w-2xl',
    ][$maxWidth ?? '2xl'];
@endphp

<div
    x-data="{
        show: @entangle($attributes->wire('model')).defer
    }"
>
    <div
        x-cloak
        x-show="show"
        x-on:click="show = false"
        @click="show=false"
        class="fixed inset-0 z-40 bg-black bg-opacity-75"
        x-on:keydown.escape.window="show = false"
        x-transition:enter="transition transform ease-in duration-150"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition transform ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">
        <div class="fixed inset-0 bg-black bg-opacity-20 z-40"></div>
    </div>

    {{--    <div x-cloak x-show="show" class="fixed inset-0 z-20 flex items-center w-full h-full m-auto {{ $maxWidth }} sm:mx-auto"--}}
    <div x-cloak x-show="show" data-cy="confirmation-model"
         class="fixed top-1/2 left-1/2 z-50 w-11/12 md:w-full max-w-lg transform -translate-x-1/2 -translate-y-1/2"
         x-transition:enter="transition transform ease-in duration-150"
         x-transition:enter-start="transform opacity-0 scale-90"
         x-transition:enter-end="transform opacity-100 scale-100"
         x-transition:leave="transition transform ease-in duration-150"
         x-transition:leave-start="transform opacity-100 scale-100"
         x-transition:leave-end="transform opacity-0 scale-90">
        <div class="flex flex-col items-center justify-center bg-white w-full rounded-md">
            <div class="p-4 flex items-center justify-between flex-wrap w-full border-b border-lightgray">
                <h4 class="text-primary font-medium tracking-wide">{{ isset($title) ? $title : null }}</h4>
                <a href="javascript:void(0);" @click="show = false"
                   class="text-xl text-primary  flex items-center justify-center rounded-md duration-300 hover:text-lightred">
                    <svg class="w-5 h-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <path
                            d="M312.1 375c9.369 9.369 9.369 24.57 0 33.94s-24.57 9.369-33.94 0L160 289.9l-119 119c-9.369 9.369-24.57 9.369-33.94 0s-9.369-24.57 0-33.94L126.1 256L7.027 136.1c-9.369-9.369-9.369-24.57 0-33.94s24.57-9.369 33.94 0L160 222.1l119-119c9.369-9.369 24.57-9.369 33.94 0s9.369 24.57 0 33.94L193.9 256L312.1 375z"/>
                    </svg>
                </a>
            </div>
            <div class="p-4 w-full">
                {{ $slot }}
            </div>
            <div class="p-4 border-t border-lightgray w-full">
                {{ $footer ?? '' }}
            </div>
        </div>
    </div>
</div>
