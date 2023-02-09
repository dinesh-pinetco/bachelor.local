<div class="container flex flex-wrap xl:px-20">
    <div class="w-full max-w-screen-xl mx-auto -mx-5">
        <div class="flex">
            <h1 class="mb-5 md:mb-9 text-primary text-2xl md:text-3xl lg:text-5xl font-light leading-tight">
                {{ __('Partner Companies') }}
            </h1>
        </div>


        <div class="flex-grow flex flex-col flex-wrap text-primary relative">
            @if (auth()->user()->application_status === ApplicationStatus::SHOW_APPLICATION_ON_MARKETPLACE)
                <p>
                    {{ __('Your profile activated on marketplace.') }}
                </p>
            @endif

            @if (auth()->user()->application_status === ApplicationStatus::PERSONAL_DATA_COMPLETED)
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
            @elseif(auth()->user()->application_status === ApplicationStatus::APPLYING_TO_SELECTED_COMPANY)
                <div class="flex flex-wrap items-start justify-between gap-5 max-w-4xl h-full">

                    <div class="flex-grow max-w-2xl sticky -top-5 xl:top-0 py-5 xl:py-0 bg-white">
                        <h6 class="text-lg lg:text-2xl font-medium text-primary mb-5">
                            {{__('Email Content')}}
                        </h6>
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
                    <div class="flex-shrink-0 h-full overflow-y-auto space-y-3 md:space-y-5">
                        <h6 class="text-lg lg:text-2xl font-medium text-primary">
                            {{__('Company list')}}
                        </h6>
                        @foreach ($companies as $key => $company)
                            <div class="flex items-center space-x-2">
                                <input
                                    class="flex-shrink-0 w-5 h-5 mt-1 form-checkbox focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 shadow-sm outline-none text-primary"
                                    type="checkbox" id="{{ $key }}" wire:model='selectedCompanies.{{ $company['id'] }}'
                                    value="{{ $company['name'] }}"> <label class="mb-0 cursor-pointer "
                                                                           for="{{ $key }}"> {{ ($company['name']) }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
    <script>
        let trixEditor = document.getElementById("email-content");

        function applyToSelectedCompany() {
        @this.set('mailContent', trixEditor.getAttribute('value'));
        @this.applyToSelectedCompany();
        }

        window.addEventListener('reset-mail-content', event => {
            trixEditor.value = "";
            document.getElementById('trix-editor').innerHTML = ""
        })
    </script>
</div>
