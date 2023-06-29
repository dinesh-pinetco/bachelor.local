<div>
    <p class="text-lg lg:text-2xl font-medium text-primary mb-3 md:mb-5">
        {{ __('You can now select companies and write an optional text that will be displayed to all selected companies.') }}
    </p>

    <h5 class="text-base font-medium md:text-lg text-primary mb-2">{{ __('Application to companies') }}</h5>

    <div class="w-full max-w-md">
        <x-jet-label>{{ __('Selected companies') }}</x-jet-label>
    </div>

    <div class="flex flex-wrap gap-4 mt-4">
        @foreach ($this->appliedCompanies as $appliedCompany)
            <div class="inline-flex items-center space-x-2 px-3 py-2 bg-primary bg-opacity-10 rounded-sm">
                <div class="text-xs">
                    {{ $appliedCompany->name }}
                </div>
                <button wire:click="removeCompany({{ $appliedCompany->id }})" class="ml-2 text-red">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>
                </button>
            </div>
        @endforeach
        <div class="self-center">
            <button class="flex justify-start items-center outline-none" wire:click="updateCompanies">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </button>
        </div>
    </div>
    <div wire:ignore class="w-full sm:max-w-lg xl:max-w-2xl mt-10">
        <h5 class="text-base font-medium md:text-lg text-primary mb-2">{{ __('Marketplace') }}</h5>
        <div class="flex justify-start items-center space-x-4 text-darkgreen rounded-sm mr-auto mb-7">
            <svg class="text-darkgreen stroke-current w-6 h-6 flex-shrink-0" width="44" height="44"
                viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M16.5 22L20.1667 25.6667L27.5 18.3333M38.5 22C38.5 24.1668 38.0732 26.3124 37.244 28.3143C36.4148 30.3161 35.1994 32.1351 33.6673 33.6673C32.1351 35.1994 30.3161 36.4148 28.3143 37.244C26.3124 38.0732 24.1668 38.5 22 38.5C19.8332 38.5 17.6876 38.0732 15.6857 37.244C13.6839 36.4148 11.8649 35.1994 10.3327 33.6673C8.80057 32.1351 7.58519 30.3161 6.75599 28.3143C5.92678 26.3124 5.5 24.1668 5.5 22C5.5 17.6239 7.23839 13.4271 10.3327 10.3327C13.4271 7.23839 17.6239 5.5 22 5.5C26.3761 5.5 30.5729 7.23839 33.6673 10.3327C36.7616 13.4271 38.5 17.6239 38.5 22Z"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>

            <p class="text-sm">
                {{ !is_null($user->show_application_on_marketplace_at)
                    ? __('You have applied to the marketplace.')
                    : __('You have opted out to show your profile on marketplace.') }}
            </p>
        </div>
    </div>
    <div class="flex items-start space-x-2 mt-5">
        <label for="is_see_test_results" class="flex cursor-pointer items-center mb-0">
            <input id="is_see_test_results" wire:model="is_see_test_results" type="checkbox"
                class="flex-shrink-0 w-5 h-5 form-checkbox focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 shadow-sm outline-none text-primary">
            <span class="checkbox-label flex-grow pl-2">
                {{ __('Selected companies can see the test results') }}
            </span>
        </label>
    </div>
    <div class="flex items-start space-x-2 mt-5">
        @if (!is_null($user->show_application_on_marketplace_at))
            <x-secondary-button class="h-11" wire:click="enrollIntoMarketPlace(false)" wire:loading.attr="disabled">
                {{ __('Not be listed anymore in Marketplace') }}
            </x-secondary-button>
        @else
            <x-primary-button class="h-11" type="button" wire:click="enrollIntoMarketPlace(true)">
                {{ __('Get listed in Marketplace') }}
            </x-primary-button>
        @endif
    </div>
    <x-primary-button id="submit" type="button" @click="applyToSelectedCompany()">
        {{ __('Update') }}
    </x-primary-button>
    <x-custom-modal wire:model="show" maxWidth="lg">
        <x-slot name="title">
            {{ __('Add companies') }}
        </x-slot>
        <div>
            <div class="space-y-3">
                <x-multi-select
                    name="company"
                    wire:model="selectedCompanies"
                    :placeholder="__('Select Company')"
                    :options="$companies"
                    :value="$selectedCompanies"
                    keyBy="id"
                    labelBy="name"
                />
            </div>
        </div>
        <x-slot name="footer">
            <div class="flex justify-end space-x-2">
                <x-secondary-button data-cy="submit-button" wire:click="applyToSelectedCompany"> {{ __('Submit') }} </x-secondary-button>
            </div>
        </x-slot>
    </x-custom-modal>

    <script>
        function applyToSelectedCompany() {
            @this.applyToSelectedCompany();
        }
    </script>
</div>
