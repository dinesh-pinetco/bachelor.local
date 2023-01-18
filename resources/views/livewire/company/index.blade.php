<div class="container flex flex-wrap xl:px-20">
    <div class="w-full max-w-screen-xl mx-auto">
        <div class="flex">
            <div class="hidden lg:block flex-shrink-0 w-20 md:w-32 lg:w-40 2xl:w-64"></div>
            <h1 class="mb-5 md:mb-9 text-primary text-2xl md:text-3xl lg:text-5xl font-light leading-tight">
                {{ __('Partner Companies') }}
            </h1>
        </div>
    </div>

    <div class="flex-grow flex flex-wrap text-primary">
        <span>
            {{ __('You can either actively apply to selected companies with the previously entered data or be listed on the marketplace of the company portal') }}
        </span>
        <x-primary-button type="button"
                          wire:click="submitProfileInformation"
                          wire:loading.attr="disabled"
        class="mr-2">
            {{ __('Apply directly to selected company') }}
        </x-primary-button>

        <x-primary-button type="button"
                          wire:click="submitProfileInformation"
                          wire:loading.attr="disabled">
            {{ __('Show my profile directly on marketplace') }}
        </x-primary-button>
    </div>
</div>
