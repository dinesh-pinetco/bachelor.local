<div class="max-w-screen-xl mx-auto flex flex-wrap">
    <div class="hidden lg:block flex-shrink-0 w-20 md:w-32 lg:w-40 2xl:w-64">
        <div class="flex items-center justify-center py-8 lg:py-6 xl:py-0"></div>
    </div>
    <div class="flex-grow w-1/3">
        <h2 class="mb-5 md:mb-9 text-primary text-2xl md:text-3xl lg:text-5xl font-light leading-tight">
            {{ __('Support') }}
        </h2>

        <ul class="hidden sm:flex space-x-4 tabs overflow-x-auto pb-5 md:pb-10">
            <li>
                <x-jet-nav-link href="{{ route('faq.index') }}" :active="urlContains('faq')"
                                class="flex-shrink-0 whitespace-nowrap px-4 py-2 text-base bg-lightgray hover:bg-primary text-primary hover:text-lightgray leading-snug transition duration-200 ease-in-out rounded-sm">
                    {{ __('Faq') }}
                </x-jet-nav-link>
            </li>
            <li>
                <x-jet-nav-link href="{{ route('contact-us.index') }}" :active="urlContains('contact-us')"
                                class="flex-shrink-0 whitespace-nowrap px-4 py-2 text-base bg-lightgray hover:bg-primary text-primary hover:text-lightgray leading-snug transition duration-200 ease-in-out rounded-sm">
                    {{ __('Contact Us') }}
                </x-jet-nav-link>
            </li>
        </ul>

        <div class="block sm:hidden pb-5">

            <x-livewire-select isTab=true>
                <option {{ urlContains('faq') ? 'selected' : '' }} value="{{ route('faq.index') }}">
                    {{ __('Faq') }}
                </option>
                <option {{ urlContains('contact-us') ? 'selected' : '' }} value="{{ route('contact-us.index') }}">
                    {{ __('Contact Us') }}
                </option>
            </x-livewire-select>
        </div>
    </div>
</div>
