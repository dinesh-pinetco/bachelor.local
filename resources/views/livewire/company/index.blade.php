<div>
    <div class="w-full max-w-screen-xl mx-auto lg:pl-40 2xl:pl-64">
        <div class="flex">
            <h1 class="mb-5 md:mb-9 text-primary text-2xl md:text-3xl lg:text-5xl font-light leading-tight">
                {{ __('Partner companies') }}
            </h1>
        </div>

        <div class="flex-grow flex flex-col flex-wrap text-primary relative">
            @if (auth()->user()->application_status === ApplicationStatus::PERSONAL_DATA_COMPLETED && is_null(auth()->user()->show_application_on_marketplace_at))
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
            @elseif(auth()->user()->application_status === ApplicationStatus::TEST_RESULT_PDF_RETRIEVED_ON)
                <p>
                    {{ __("You have to submit your form from progress-bar.") }}
                </p>
            @endif

            @if(auth()->user()->application_status === ApplicationStatus::APPLYING_TO_SELECTED_COMPANY)

                <div class="flex flex-wrap items-start justify-between gap-5 max-w-4xl h-full">
                    @if ($showTextarea)
                        <div
                            class="flex flex-wrap xl:flex-nowrap w-full gap-10 xl:gap-6">
                            <div class="w-full xl:w-2/3 flex-shrink-0 h-full overflow-y-auto px-2 -mx-2">
                                <h6 class="text-lg lg:text-2xl font-medium text-primary mb-5">
                                    {{__('Email Content')}}
                                </h6>
                                <div class="w-full sm:max-w-lg xl:max-w-2xl" wire:ignore>
                                    <input id="email-content" type="hidden" name="mailContent">
                                    <trix-editor class="prose formatted-content"
                                                 id="trix-editor"
                                                 input="email-content"
                                                 wire:ignore
                                                 wire:key="competency_comment"></trix-editor>
                                </div>
                                <x-jet-input-error for="mailContent"/>
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
                                    @forelse ($companies as $company)
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
                <div class="inline-flex justify-center space-x-4 text-white p-4 bg-darkgreen rounded-sm mx-auto mb-5">
                    <svg class="text-white stroke-current w-6 h-6 flex-shrink-0" width="44" height="44"
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
                <h6 class="text-lg lg:text-2xl font-medium text-primary mb-2">{{ __('Appllied Company') }}: </h6>

                <div class="flex flex-wrap gap-2">
                    @foreach ($appliedCompanies as $appliedCompany)
                        <div class="text-xs py-2 px-4 bg-primary bg-opacity-10 rounded-sm" id="company">
                            {{ $appliedCompany->company->name }}
                        </div>
                    @endforeach
                </div>
                <div
                    class="inline-flex justify-center space-x-4 text-primary p-4 bg-secondary  rounded-sm mx-auto mt-5">
                    <svg class="text-primary fill-current w-5 h-5" width="24" height="24" viewBox="0 0 24 24"
                         fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12 2C10.0222 2 8.08879 2.58649 6.4443 3.6853C4.79981 4.78412 3.51809 6.3459 2.76121 8.17317C2.00433 10.0004 1.8063 12.0111 2.19215 13.9509C2.578 15.8907 3.53041 17.6725 4.92894 19.0711C6.32746 20.4696 8.10929 21.422 10.0491 21.8079C11.9889 22.1937 13.9996 21.9957 15.8268 21.2388C17.6541 20.4819 19.2159 19.2002 20.3147 17.5557C21.4135 15.9112 22 13.9778 22 12C22 10.6868 21.7413 9.38642 21.2388 8.17317C20.7363 6.95991 19.9997 5.85752 19.0711 4.92893C18.1425 4.00035 17.0401 3.26375 15.8268 2.7612C14.6136 2.25866 13.3132 2 12 2ZM12 20C10.4178 20 8.87104 19.5308 7.55544 18.6518C6.23985 17.7727 5.21447 16.5233 4.60897 15.0615C4.00347 13.5997 3.84504 11.9911 4.15372 10.4393C4.4624 8.88743 5.22433 7.46197 6.34315 6.34315C7.46197 5.22433 8.88743 4.4624 10.4393 4.15372C11.9911 3.84504 13.5997 4.00346 15.0615 4.60896C16.5233 5.21447 17.7727 6.23984 18.6518 7.55544C19.5308 8.87103 20 10.4177 20 12C20 14.1217 19.1572 16.1566 17.6569 17.6569C16.1566 19.1571 14.1217 20 12 20Z"
                            fill="currentColor"/>
                        <path
                            d="M12 17C12.5523 17 13 16.5523 13 16C13 15.4477 12.5523 15 12 15C11.4477 15 11 15.4477 11 16C11 16.5523 11.4477 17 12 17Z"
                            fill="currentColor"/>
                        <path
                            d="M12 7C11.7348 7 11.4804 7.10536 11.2929 7.29289C11.1054 7.48043 11 7.73478 11 8V13C11 13.2652 11.1054 13.5196 11.2929 13.7071C11.4804 13.8946 11.7348 14 12 14C12.2652 14 12.5196 13.8946 12.7071 13.7071C12.8946 13.5196 13 13.2652 13 13V8C13 7.73478 12.8946 7.48043 12.7071 7.29289C12.5196 7.10536 12.2652 7 12 7Z"
                            fill="currentColor"/>
                    </svg>
                    <p class="text-sm">
                        {!! trans('Would you also like to be listed on the applicant marketplace so that you become visible to all partner companies and they can even contact you directly?') !!}
                    </p>
                </div>
                <div class="flex flex-wrap items-end gap-4">
                    <x-primary-button class="h-11" type="button" wire:click="showProfileMarketplace">
                        {{ __('Yes') }}
                    </x-primary-button>
                    <x-secondary-button class="h-11" wire:click="DoNotShowProfileMarketplace" wire:loading.attr="disabled">
                        {{ __('No') }}
                    </x-secondary-button>
                </div>
                <div class="flex items-start space-x-2 mt-8">
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
            @endif

            @if((!is_null($user->show_application_on_marketplace_at) || !is_null($user->reject_marketplace_application_at)) && auth()->user()->application_status === ApplicationStatus::APPLIED_TO_SELECTED_COMPANY)
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
                <div wire:ignore class="mt-6">
                    <input wire:ignore id="email-content" type="hidden" name="mailContent">
                    <trix-editor class="prose formatted-content"
                                id="trix-editor"
                                input="email-content"
                                wire:ignore
                                wire:key="competency_comment"
                                wire:model="mailContent"></trix-editor>
                </div>
                <x-jet-input-error for="mailContent"/>
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
                    <x-primary-button id="submit" type="button" @click="applyToSelectedCompany()">
                        {{ __('Update') }}
                    </x-primary-button>
                @endif

                @if(!is_null($user->show_application_on_marketplace_at) && auth()->user()->application_status === ApplicationStatus::APPLIED_ON_MARKETPLACE)
                    <p class="text-primary">{{ __('You have applied to marketplace.') }}</p>
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
                    wire:model="selectedCompanies"
                    :placeholder="__('Select Company')"
                    :options="$companies"
                    :value="$selectedCompanies"
                    key-by="id"
                    label-by="name"
                />
                <x-jet-input-error for="mailContent"/>
            </div>
        </div>
        <x-slot name="footer">
            <div class="flex justify-end space-x-2">
                <x-secondary-button data-cy="cancel-button" x-on:click="show = false"> {{ __('Close') }} </x-secondary-button>
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
    @this.set('mailContent', trixEditor.getAttribute('value'));
    @this.applyToSelectedCompany();
    }
</script>
</div>
