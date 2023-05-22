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
    <link rel="stylesheet" href="{{ asset('plugins/intlTelInput.min.css') }}" />

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    @stack('styles')

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
<body>
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P8FRGXS"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->

<div class="font-sans text-white antialiased h-screen relative pb-10">
    <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 text-white relative h-full px-4 md:px-0">
        {{ $slot }}
    </div>
</div>
<div
    class="fixed bottom-0 w-full z-20 bg-white py-2 md:py-4 flex items-center justify-center divide-x divide-x-primary border-t border-gray">
    <a class="cursor-pointer px-2 text-primary hover:text-primary-light"
       href="{{route('privacy_policy')}}">{{__('Imprint')}}</a>
    <a class="cursor-pointer px-2 text-primary hover:text-primary-light"
       href="{{route('data_protection')}}">{{__('Privacy policy')}}</a>
</div>
        <script src="{{ asset('plugins/intlTelInput.min.js') }}"> </script>

@stack('scripts')
<script src="{{ asset('plugins/intlTelInput.min.js') }}"></script>
@livewireScripts
</body>
</html>
