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
        @if (auth()->user()->application_status === ApplicationStatus::PERSONAL_DATA_COMPLETED)
            <span>
                {{ __('You can either actively apply to selected companies with the previously entered data or be listed on the marketplace of the company portal') }}
            </span>
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
        @elseif(auth()->user()->application_status === ApplicationStatus::APPLYING_TO_SELECTED_COMPANY)
            @foreach ($companies as $key => $company)
                <input type="checkbox" id="{{ $key }}" wire:model='selectedCompanies.{{ $company['id'] }}' value="{{ $company['name'] }}"> <label for="{{ $key }}"> {{ ($company['name']) }}</label><br>
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
        @endif
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
