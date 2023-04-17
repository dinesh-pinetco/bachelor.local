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
    @livewireStyles
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    @stack('styles')

</head>
<body>


<main class="relative isolate min-h-screen flex flex-col items-center">
    <div
        class="fixed top-0 w-full z-20 bg-white py-2 md:py-4 flex items-center justify-center border-b border-gray">
        <a
            href="{{ route('dashboard') }}"
            class="inline-block w-full pl-4 cursor-pointer">
            <x-jet-application-mark class="block w-auto ml-0"/>
        </a>
    </div>
    <div class="m-auto max-w-7xl px-6 py-32 text-center sm:py-40 lg:px-8 relative">
        {{ $slot }}
    </div>
    <div
        class="fixed bottom-0 w-full z-20 bg-white py-2 md:py-4 flex items-center justify-center divide-x divide-x-primary border-t border-gray">
        <a class="cursor-pointer px-2 text-primary hover:text-primary-light"
           href="{{route('privacy_policy')}}">{{__('Imprint')}}</a>
        <a class="cursor-pointer px-2 text-primary hover:text-primary-light"
           href="{{route('data_protection')}}">{{__('Privacy policy')}}</a>
    </div>
</main>
</body>
</html>
