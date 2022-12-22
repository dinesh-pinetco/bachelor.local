<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="icon" href="/images/favicon.ico" type="image/x-icon">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ mix('css/nice-select.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css"/>


    @livewireStyles
    @stack('styles')
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-P8FRGXS');</script>
    <!-- End Google Tag Manager -->
</head>
<body class="font-sans antialiased">
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P8FRGXS"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->

<x-jet-banner/>

<div x-data="{ open: false }"
     class="h-screen bg-white flex flex-wrap">

    <button type="button" @click="open = true"
            class="p-2 appearance-none absolute left-3 top-3 lg:hidden">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-primary" viewBox="0 0 24 24" stroke-width="1.5"
             stroke="currentcolor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <line x1="4" y1="6" x2="20" y2="6"/>
            <line x1="4" y1="12" x2="20" y2="12"/>
            <line x1="4" y1="18" x2="20" y2="18"/>
        </svg>
    </button>


    <div x-show="open" x-cloak
         @click="open = false"
         class="bg-black bg-opacity-60 fixed inset-0 z-40"
         x-transition:enter="ease-in-out duration-700"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in-out duration-700"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
    >
    </div>


    <div x-show="open" x-cloak
         class="sidebar flex-shrink-0 w-60 lg:w-64 absolute lg:relative left-0 inset-y-0 z-40 bg-white"
         x-transition:enter="transform transition ease-in-out duration-500"
         x-transition:enter-start="-translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transform transition ease-in-out duration-500"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="-translate-x-full"
    >
        @livewire('navigation-menu')
    </div>


    <!-- Page Heading -->
    @if (isset($header))
        <header class="bg-white">
            <div class="max-w-screen-xl	mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif

    <!-- Page Content -->
    <main class="flex-grow w-1/3 flex flex-col h-full">

        @include('top-nav')

        <div class="flex-grow overflow-y-auto h-full pt-4 pb-16 px-6 scroll">
            {{ $slot }}
        </div>
    </main>
    <div
        class="fixed bottom-0 w-full z-20 bg-white py-2 md:py-4 flex items-center justify-center divide-x divide-x-primary border-t border-gray">
        <a class="cursor-pointer px-2 text-primary hover:text-primary-light"
           href="{{route('privacy_policy')}}">{{__('Imprint')}}</a>
        <a class="cursor-pointer px-2 text-primary hover:text-primary-light"
           href="{{route('data_protection')}}">{{__('Privacy policy')}}</a>
    </div>
</div>
<x-notification/>

@stack('modals')

<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://unpkg.com/tippy.js@6"></script>
@livewireScripts
</body>
</html>
