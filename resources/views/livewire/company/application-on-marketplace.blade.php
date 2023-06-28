<div>
    <div class="inline-flex justify-center space-x-2 text-darkgreen mx-auto lg:mb-10 mb-6">
        <svg class="text-darkgreen stroke-current w-6 h-6 flex-shrink-0" width="44" height="44"
             viewBox="0 0 44 44"
             fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M16.5 22L20.1667 25.6667L27.5 18.3333M38.5 22C38.5 24.1668 38.0732 26.3124 37.244 28.3143C36.4148 30.3161 35.1994 32.1351 33.6673 33.6673C32.1351 35.1994 30.3161 36.4148 28.3143 37.244C26.3124 38.0732 24.1668 38.5 22 38.5C19.8332 38.5 17.6876 38.0732 15.6857 37.244C13.6839 36.4148 11.8649 35.1994 10.3327 33.6673C8.80057 32.1351 7.58519 30.3161 6.75599 28.3143C5.92678 26.3124 5.5 24.1668 5.5 22C5.5 17.6239 7.23839 13.4271 10.3327 10.3327C13.4271 7.23839 17.6239 5.5 22 5.5C26.3761 5.5 30.5729 7.23839 33.6673 10.3327C36.7616 13.4271 38.5 17.6239 38.5 22Z"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <p class="text-sm">
            {!! trans('Congratulations! You have applied to the following companies. You can edit the selected companies or add more at any time.')!!}
        </p>
    </div>
    <h6 class="text-black text-xs font-light mb-3">{{ __('Appllied Company') }}: </h6>

    <div class="flex flex-wrap gap-2 mb-10">
        @foreach ($this->appliedCompanies as $appliedCompany)
            <div class="text-xs py-2 px-4 bg-primary bg-opacity-10 rounded-sm" id="company">
                {{ $appliedCompany->company->name }}
            </div>
        @endforeach
    </div>
    <div class="border border-[#163976] rounded-sm lg:p-8 p-5 space-y-6">
        <div>
            <h3 class="text-lg font-medium text-primary mb-2"> {{__('Would you also like to be listed on the applicant marketplace?')}} </h3>

            <p class="text-sm text-black font-light">
                {!! trans('Would you also like to be listed on the applicant marketplace so that you become visible to all partner companies and they can even contact you directly?') !!}
            </p>
        </div>
        <div class="flex items-start space-x-2">
            <label for="marketplacePrivacyPolicyAccepted" class="flex cursor-pointer items-center mb-0">
                <input
                    id="marketplacePrivacyPolicyAccepted"
                    wire:model="marketplacePrivacyPolicyAccepted"
                    type="checkbox"
                    class="flex-shrink-0 w-5 h-5 form-checkbox focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 shadow-sm outline-none text-primary">
                <span class="checkbox-label flex-grow pl-2 text-sm">
                                {!! trans('I have read and agree to the privacy policy.') !!}
                            </span>
            </label>
        </div>
        <div class="flex flex-wrap items-end gap-4 btn-grp">
            <x-primary-button class="h-11" type="button" wire:click="showProfileMarketplace">
                {{ __('Yes') }}
            </x-primary-button>
            <x-secondary-button class="h-11" wire:click="doNotShowProfileMarketplace" wire:loading.attr="disabled">
                {{ __('No') }}
            </x-secondary-button>
        </div>
    </div>
</div>
