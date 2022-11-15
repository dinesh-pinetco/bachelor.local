<div>
    <div class="xl:px-20 w-full max-w-screen-xl mx-auto">
        <div>
            <div class="-mx-4">
                <div class="px-4 mb-7 md:mb-12 lg:mb-16 ">
                    <h2 class="text-primary text-2xl md:text-3xl lg:text-5xl font-light leading-tight">{{ __('Industry Option') }}</h2>
                    <p class="mt-2 text-sm text-darkgray">
                        {{ __('This information will be displayed publicly so be careful what you share.') }}
                    </p>
                </div>
                <div class="mt-5 md:mt-0 px-4 w-full lg:w-1/2 xl:w-2/5">
                    <form wire:submit.prevent="submit" id="courseForm">
                        <div class="space-y-8">
                            <div>
                                <x-jet-label for="key" class="block required">{{ __('Key') }}</x-jet-label>
                                <x-jet-input class="w-full" type="text" name="key" :placeholder="__('Key')"
                                             wire:model.defer="option.key" id="key"></x-jet-input>
                                <x-jet-input-error for="option.key"/>
                            </div>

                            <div>
                                <x-jet-label for="value" class="block required">{{ __('value') }}</x-jet-label>
                                <x-jet-input class="w-full" type="text" name="value" :placeholder="__('value')"
                                             wire:model.defer="option.value" id="value"></x-jet-input>
                                <x-jet-input-error for="option.value"/>
                            </div>

                        </div>
                        <div class="py-3 text-right">
                            <x-primary-button type="submit" class="">
                                {{ __('Save') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
