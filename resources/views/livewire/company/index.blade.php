<div class="container flex flex-wrap xl:px-20">
    <div class="w-full max-w-screen-xl mx-auto -mx-5">
        <div class="flex">
            <h1 class="mb-5 md:mb-9 text-primary text-2xl md:text-3xl lg:text-5xl font-light leading-tight">
                {{ __('Partner companies') }}
            </h1>
        </div>

        <div class="flex-grow flex flex-col flex-wrap text-primary relative">
            @if (auth()->user()->application_status === ApplicationStatus::PERSONAL_DATA_COMPLETED && is_null(auth()->user()->show_application_on_marketplace_at))
                <p>
                    {{ __('You can either actively apply to selected companies with the previously entered data or be listed on the marketplace of the company portal') }}
                </p>
                <div>
                    <x-primary-button type="button"
                                      wire:click="selectCompany"
                                      wire:loading.attr="disabled"
                                      class="mr-2">
                        {{ __('Apply directly to selected company') }}
                    </x-primary-button>

                    <x-primary-button type="button"
                                      wire:click="showProfileMarketplace"
                                      wire:loading.attr="disabled">
                        {{ __('Show my profile directly on marketplace') }}
                    </x-primary-button>
                </div>
            @endif
            @if(auth()->user()->application_status === ApplicationStatus::APPLYING_TO_SELECTED_COMPANY)
                <div class="flex flex-wrap items-start justify-between gap-5 max-w-4xl h-full">
                    @if ($showTextarea)
                        <div class="flex-grow max-w-2xl sticky -top-5 xl:top-0 py-5 xl:py-0 bg-white">
                            <h6 class="text-lg lg:text-2xl font-medium text-primary mb-5">
                                {{__('Email Content')}}
                            </h6>
                            @foreach ($selectedCompanies as $key => $selectedCompany)
                                <div class="flex items-center space-x-2">
                                    <span>
                                        {{ $selectedCompany }}
                                    </span>
                                    <br/>
                                </div>
                            @endforeach
                            <div wire:ignore>
                                <input id="email-content" type="hidden" name="mailContent">
                                <trix-editor class="prose formatted-content"
                                             id="trix-editor"
                                             input="email-content"
                                             wire:ignore
                                             wire:key="competency_comment"></trix-editor>
                            </div>
                            <x-jet-input-error for="mailContent"/>

                            <x-primary-button type="button"
                                              wire:loading.attr="disabled"
                                              @click="applyToSelectedCompany()">
                                {{ __('Apply to Selected Company') }}
                            </x-primary-button>
                        </div>
                    @else
                        <x-jet-input wire:model='search' placeholder="{{ __('Search by name') }}"/>
                        <x-jet-input wire:model='zip_code' placeholder="{{ __('Search by zip code') }}"/>

                        <div class="flex-shrink-0 h-full overflow-y-auto space-y-3 md:space-y-5">
                            <h6 class="text-lg lg:text-2xl font-medium text-primary">
                                {{__('Company list')}}
                            </h6>
                            @foreach ($companies as $company)
                                <div class="flex items-center space-x-2">
                                    <label class="mb-0 cursor-pointer"
                                           for="{{ $company->id }}"> {{ ($company->name) }}</label>
                                    <input
                                        class="flex-shrink-0 w-5 h-5 mt-1 form-checkbox focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 shadow-sm outline-none text-primary"
                                        type="checkbox"
                                        id="{{ $company->id }}"
                                        wire:model="selectedCompanies"
                                        value="{{ $company->name }}">
                                </div>
                            @endforeach
                        </div>
                        <div class="flex-shrink-0 h-full overflow-y-auto space-y-3 md:space-y-5">
                            <h6 class="text-lg lg:text-2xl font-medium text-primary">
                                {{__('Selected companies')}}
                            </h6>
                            @foreach ($selectedCompanies as $key => $selectedCompany)
                                <div class="flex items-center space-x-2">
                                    <span>
                                        {{ $selectedCompany }}
                                    </span>
                                    <br/>
                                </div>
                            @endforeach
                        </div>
            </div>
                        <x-primary-button wire:click="next">{{ __('Apply now') }}</x-primary-button>
                    @endif
            @endif

                <div class="flex-grow max-w-2xl sticky -top-5 xl:top-0 py-5 xl:py-0 bg-white">
                    @if(is_null($user->show_application_on_marketplace_at) && auth()->user()->companies()->exists())
                        <h6 class="text-lg lg:text-2xl font-medium text-primary mb-5">
                            {{__('Congratulations! You have applied to the following companies. You can edit the selected companies or add more at any time.')}}
                        </h6>

                        <h6 class="text-bold-300">{{ __('Appllied Company') }} :- </h6>

                        @foreach ($appliedCompanies as $appliedCompany)
                            <div class="flex items-center space-x-2">
                                <span id="company">
                                    {{ $appliedCompany->company_name }}
                                </span>
                            </div>
                        @endforeach

                        <h6 class="text-lg lg:text-2xl font-medium text-primary mb-5">
                            {{__('Additionally, would you like to be listed on the market place so companies can contact you?')}}
                        </h6>

                        <x-primary-button type="button"
                                        wire:click="showProfileMarketplace"
                                        wire:loading.attr="disabled">
                            {{ __('Yes, get listed') }}
                        </x-primary-button>
                    @endif

                    @if(!is_null($user->show_application_on_marketplace_at))
                            <p>{{ __("You can now select companies and write an optional text that will be displayed to all selected companies.") }}</p>
                            @foreach ($appliedCompanies as $appliedCompany)
                                <div class="flex items-center space-x-2">
                                    <span>
                                        {{ $appliedCompany->company_name }}
                                    </span>
                                    <div class="mt-4">
                                        <button wire:click="removeCompany({{ $appliedCompany->id }})" class="ml-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                            <div wire:ignore class="mt-4">
                                <input id="email-content" type="hidden" name="mailContent">
                                <trix-editor class="prose formatted-content"
                                             id="trix-editor"
                                             input="email-content"
                                             wire:ignore
                                             wire:key="competency_comment"
                                             wire:model="mailContent"></trix-editor>
                            </div>
                            <x-jet-input-error for="mailContent"/>

                            <x-primary-button id="submit" type="button"
                                              wire:loading.attr="disabled"
                                              @click="applyToSelectedCompany()">
                                {{ __('Apply to Selected Company') }}
                            </x-primary-button>
                    @endif
                </div>
        </div>
    </div>
    <script>
        var companys= @js($appliedCompanies);

        let trixEditor = companys == null ? "" : document.getElementById("email-content");

        window.addEventListener('init-trix-editor', event => {
            trixEditor = document.getElementById("email-content");
        })

        function applyToSelectedCompany() {
            @this.set('mailContent', trixEditor.getAttribute('value'));
            @this.applyToSelectedCompany();
        }

        window.addEventListener('refresh-page', event => {
            location.reload();
        })
    </script>
</div>
