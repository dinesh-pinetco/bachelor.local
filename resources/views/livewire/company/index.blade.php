<div>
    <div class="w-full max-w-screen-xl mx-auto lg:pl-40 2xl:pl-64">
        <div class="flex">
            <h1 class="mb-5 md:mb-10 text-primary text-2xl md:text-3xl lg:text-5xl font-thin leading-tight">
                {{ __('Partner companies') }}
            </h1>
        </div>

        <div class="flex-grow flex flex-col flex-wrap text-primary relative">
            @if (auth()->user()->application_status === ApplicationStatus::TEST_RESULT_PDF_RETRIEVED_ON && is_null(auth()->user()->show_application_on_marketplace_at))
                <p>
                    {{ __("You've almost made it, now all you have to do is choose one or more partner companies where you would like to apply for a position as a dual student.") }}
                </p>
                <p class="mt-4">
                    {{ __("You can also unlock yourself for our applicant marketplace. This will make you visible to ALL companies, so that they can approach you if necessary (no guarantee, so make sure to apply yourself):") }}
                </p>
                <div>
                    <x-primary-button type="button" wire:click="selectCompany" class="mr-2">
                        {{ __('Apply directly to selected company') }}
                    </x-primary-button>
                </div>
            @endif

            @if(auth()->user()->application_status === ApplicationStatus::APPLYING_TO_SELECTED_COMPANY)

                <div class="flex flex-wrap items-start justify-between gap-5 max-w-4xl h-full">
                    @if ($showTextarea)
                        <div
                            class="flex flex-wrap xl:flex-nowrap w-full gap-10 xl:gap-6">
                            <div class="w-full xl:w-2/3 flex-shrink-0 h-full overflow-y-auto px-2 -mx-2">
                                <div class="flex items-start space-x-2 mt-5">
                                    <label for="is_see_test_results" class="flex cursor-pointer items-center mb-0">
                                        <input
                                            id="is_see_test_results"
                                            wire:model="is_see_test_results"
                                            type="checkbox"
                                            class="flex-shrink-0 w-5 h-5 form-checkbox focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 shadow-sm outline-none text-primary">
                                        <span class="checkbox-label flex-grow pl-2">
                                            {{ __('Selected companies can see the test results') }}
                                        </span>
                                    </label>
                                </div>
                                <x-primary-button type="button" @click="applyToSelectedCompany()">
                                    {{ __('Apply to Selected Company') }}
                                </x-primary-button>
                            </div>
                            <div class="w-full xl:w-1/3 flex-shrink-0 h-full overflow-y-auto">
                                <h6 class="text-lg lg:text-2xl font-medium text-primary mb-3 md:mb-5">
                                    {{__('Selected companies')}}
                                </h6>
                                <div class="flex flex-wrap gap-2">
                                    @forelse ($companies->whereIn('id', $selectedCompanies) as $selectedCompany)
                                        <div class="text-xs py-2 px-4 bg-primary bg-opacity-10 rounded-sm">
                                            {{ $selectedCompany->name }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="flex flex-wrap gap-2 md:gap-4">
                            <x-jet-input class="w-full md:w-auto" wire:model='search'
                                         placeholder="{{ __('Search by name') }}"/>
                            <x-jet-input class="w-full md:w-auto" wire:model='zip_code'
                                         placeholder="{{ __('Search by zip code') }}"/>
                            <x-primary-button class="-mt-0" wire:click="next">{{ __('Apply now') }}</x-primary-button>
                        </div>
                        <div class="flex flex-wrap md:flex-nowrap w-full gap-10 md:gap-6">
                            <div class="w-full md:w-1/2 flex-shrink-0 h-full overflow-y-auto">
                                <h6 class="text-lg lg:text-2xl font-medium text-primary mb-3 md:mb-5">
                                    {{__('Company list')}}
                                </h6>
                                <div class="max-h-64 overflow-y-auto">
                                    @forelse ($filterCompanies as $company)
                                        <div class="flex items-center gap-2 py-1">
                                            <input
                                                class="m-1 flex-shrink-0 w-5 h-5 form-checkbox focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 shadow-sm outline-none text-primary"
                                                type="checkbox"
                                                id="{{ $company->id }}"
                                                wire:model="selectedCompanies.{{ $company->id }}"
                                                value="{{ $company->id }}">
                                            <label class="mb-0 cursor-pointer text-sm"
                                                   for="{{ $company->id }}"> {{ ($company->name) }}</label>
                                        </div>
                                    @empty
                                        <p class="text-sm text-darkgray">{{__('No Company Found')}}</p>
                                    @endforelse
                                </div>
                            </div>
                            <div class="w-full md:w-1/2 flex-shrink-0 h-full overflow-y-auto">
                                <h6 class="text-lg lg:text-2xl font-medium text-primary mb-3 md:mb-5">
                                    {{__('Selected companies')}}
                                </h6>
                                <div class="flex flex-wrap gap-2">
                                    @forelse ($selectedCompanies as $selectedCompanyId)
                                        @if ($selectedCompany = $companies->firstWhere('id', $selectedCompanyId))
                                            <div class="text-xs py-2 px-4 bg-primary bg-opacity-10 rounded-sm">
                                                {{ $selectedCompany->name }}
                                            </div>
                                        @endif
                                    @empty
                                        <p class="text-sm text-darkgray">{{__('please select the companies')}}</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                </div>
                @endif
        </div>
        @endif

        @if(auth()->user()->application_status->id() >= \App\Enums\ApplicationStatus::ENROLLMENT_ON->id())
            <div class="inline-flex justify-start space-x-4 text-white p-4 bg-darkgreen rounded-sm mr-auto mb-5">
                <svg class="text-white stroke-current w-6 h-6 flex-shrink-0" width="44" height="44"
                     viewBox="0 0 44 44"
                     fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M16.5 22L20.1667 25.6667L27.5 18.3333M38.5 22C38.5 24.1668 38.0732 26.3124 37.244 28.3143C36.4148 30.3161 35.1994 32.1351 33.6673 33.6673C32.1351 35.1994 30.3161 36.4148 28.3143 37.244C26.3124 38.0732 24.1668 38.5 22 38.5C19.8332 38.5 17.6876 38.0732 15.6857 37.244C13.6839 36.4148 11.8649 35.1994 10.3327 33.6673C8.80057 32.1351 7.58519 30.3161 6.75599 28.3143C5.92678 26.3124 5.5 24.1668 5.5 22C5.5 17.6239 7.23839 13.4271 10.3327 10.3327C13.4271 7.23839 17.6239 5.5 22 5.5C26.3761 5.5 30.5729 7.23839 33.6673 10.3327C36.7616 13.4271 38.5 17.6239 38.5 22Z"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <p class="text-sm">
                    {{__("Congratulations! You have been hired for the position you applied for.")}}
                </p>
            </div>
        @endif
        <div class="flex-grow max-w-4xl">
            @if((is_null($user->show_application_on_marketplace_at) && is_null($user->reject_marketplace_application_at)) && auth()->user()->companies()->exists())
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
                    @foreach ($appliedCompanies as $appliedCompany)
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

            @endif

            @if((!is_null($user->show_application_on_marketplace_at) || !is_null($user->reject_marketplace_application_at)) && auth()->user()->application_status->id() >= ApplicationStatus::APPLIED_TO_SELECTED_COMPANY->id() && auth()->user()->application_status->id() < ApplicationStatus::ENROLLMENT_ON->id())
                <p class="text-lg lg:text-2xl font-medium text-primary mb-3 md:mb-5">{{ __("You can now select companies and write an optional text that will be displayed to all selected companies.") }}</p>

                <h5 class="text-base font-medium md:text-lg text-primary mb-2">{{ __('Application to companies') }}</h5>

                <div class="w-full max-w-md">
                    <x-jet-label>{{ __('Selected companies') }}</x-jet-label>
                </div>

                <div class="flex flex-wrap gap-4 mt-4">
                    @foreach ($appliedCompanies as $appliedCompany)
                        <div class="inline-flex items-center space-x-2 px-3 py-2 bg-primary bg-opacity-10 rounded-sm">
                            <div class="text-xs">
                                {{ $appliedCompany->company?->name }}
                            </div>
                            <button wire:click="removeCompany({{ $appliedCompany->company_id }})" class="ml-2 text-red">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                </svg>
                            </button>
                        </div>
                    @endforeach
                    <div class="self-center">
                        <button class="flex justify-start items-center outline-none" wire:click="updateCompanies">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </button>
                    </div>
                </div>
                    <div wire:ignore class="w-full sm:max-w-lg xl:max-w-2xl mt-10">
                        <h5 class="text-base font-medium md:text-lg text-primary mb-2">{{ __('Marketplace') }}</h5>
                        <div class="flex justify-start items-center space-x-4 text-darkgreen rounded-sm mr-auto mb-7">
                            <svg class="text-darkgreen stroke-current w-6 h-6 flex-shrink-0" width="44" height="44"
                                    viewBox="0 0 44 44"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M16.5 22L20.1667 25.6667L27.5 18.3333M38.5 22C38.5 24.1668 38.0732 26.3124 37.244 28.3143C36.4148 30.3161 35.1994 32.1351 33.6673 33.6673C32.1351 35.1994 30.3161 36.4148 28.3143 37.244C26.3124 38.0732 24.1668 38.5 22 38.5C19.8332 38.5 17.6876 38.0732 15.6857 37.244C13.6839 36.4148 11.8649 35.1994 10.3327 33.6673C8.80057 32.1351 7.58519 30.3161 6.75599 28.3143C5.92678 26.3124 5.5 24.1668 5.5 22C5.5 17.6239 7.23839 13.4271 10.3327 10.3327C13.4271 7.23839 17.6239 5.5 22 5.5C26.3761 5.5 30.5729 7.23839 33.6673 10.3327C36.7616 13.4271 38.5 17.6239 38.5 22Z"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>

                            <p class="text-sm">
                                {{ !is_null($user->show_application_on_marketplace_at) ? __('You have applied to the marketplace.') : __('You have opted out to show your profile on marketplace.')}}
                            </p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-2 mt-5">
                        <label for="is_see_test_results" class="flex cursor-pointer items-center mb-0">
                            <input
                                id="is_see_test_results"
                                wire:model="is_see_test_results"
                                type="checkbox"
                                class="flex-shrink-0 w-5 h-5 form-checkbox focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 shadow-sm outline-none text-primary">
                            <span class="checkbox-label flex-grow pl-2">
                                {{ __('Selected companies can see the test results') }}
                            </span>
                        </label>
                    </div>
                    <div class="flex items-start space-x-2 mt-5">
                        @if(!is_null($user->show_application_on_marketplace_at))
                            <x-secondary-button class="h-11" wire:click="enrollIntoMarketPlace(false)" wire:loading.attr="disabled">
                                {{ __('Remove from marketplace') }}
                            </x-secondary-button>
                        @else
                            <x-primary-button class="h-11" type="button"  wire:click="enrollIntoMarketPlace(true)">
                                {{ __('I want to go to the marketplace') }}
                            </x-primary-button>
                        @endif
                    </div>
                    <x-primary-button id="submit" type="button" @click="applyToSelectedCompany()">
                        {{ __('Update') }}
                    </x-primary-button>
                @endif
        </div>
    </div>
    <x-custom-modal wire:model="show" maxWidth="lg">
        <x-slot name="title">
            {{ __('Add companies') }}
        </x-slot>
        <div>
            <div class="space-y-3">
                <x-multi-select
                    name="company"
                    wire:model="addNewCompaniesToApplicant"
                    :placeholder="__('Select Company')"
                    :options="$companies"
                    :value="$selectedCompanies"
                    key-by="id"
                    label-by="name"
                />
            </div>
        </div>
        <x-slot name="footer">
            <div class="flex justify-end space-x-2">
                <x-secondary-button data-cy="submit-button" wire:click="applyToSelectedCompany"> {{ __('Submit') }} </x-secondary-button>
            </div>
        </x-slot>
    </x-custom-modal>
</div>
<script>
    var companys = @js($appliedCompanies);

    let trixEditor = companys == null ? "" : document.getElementById("email-content");

    window.addEventListener('init-trix-editor', event => {
        trixEditor = document.getElementById("email-content");
    })

    function applyToSelectedCompany() {
    @this.applyToSelectedCompany();
    }
</script>
</div>
