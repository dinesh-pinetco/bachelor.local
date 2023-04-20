<x-error>
    <div class="flex flex-col flex-grow items-center justify-center relative">
        <x-icons.429/>
        <p class="text-xl text-black mt-10">{{ __('Too Many Requests') }}</p>
    </div>
    <div class="flex-shrink-0 space-x-4 mt-8">
        <x-link-button href="{{ route('dashboard') }}" class="py-3 !px-8 -mt-0"
        >
            <span>{{ __('Go to Dashboard') }}</span>
        </x-link-button>
    </div>
</x-error>
