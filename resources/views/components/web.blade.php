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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css"/>


    @livewireStyles
@stack('styles')
<!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>
<body class="font-sans antialiased">
<x-jet-banner/>

<div x-data="{ open: false }"
     class="h-screen bg-white flex flex-wrap">

    <!-- Page Content -->
    <main class="flex-grow w-1/3 flex flex-col h-full">
        @include('logo')
        <div class="flex-grow overflow-y-auto h-full pt-4 pb-16 px-6 shadow">
            {{ $slot }}
        </div>
    </main>
    <div
        class="fixed bottom-0 w-full z-50 bg-white py-2 flex items-center justify-center border-t border-gray">
        <a class="cursor-pointer px-2 text-primary hover:text-primary-light"
           href="{{route('privacy_policy')}}">{{__('Imprint')}}</a> /
        <a class="cursor-pointer px-2 text-primary hover:text-primary-light"
           href="{{route('data_protection')}}">{{__('Privacy policy')}}</a>
    </div>
</div>
<x-notification/>

@stack('modals')

<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script>

@stack('scripts')
<script src="{{ asset('plugins/intlTelInput.min.js') }}"></script>
@livewireScripts
</body>
</html>
