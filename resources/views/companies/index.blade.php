<x-app-layout>
    <div class="w-full max-w-screen-xl mx-auto lg:pl-40 2xl:pl-64 2xl:pr-20 lg:pr-16">
        <div class="flex">
            <h1 class="mb-5 md:mb-10 text-primary text-2xl md:text-3xl lg:text-5xl font-thin leading-tight">
                {{ __('Your company selection') }}
            </h1>
        </div>
        <div>
            @if ($applicant && $applicant->application_status === ApplicationStatus::TEST_RESULT_PDF_RETRIEVED_ON && is_null($applicant->show_application_on_marketplace_at))
                <livewire:company.ask-to-apply :user="$applicant??''"/>
            @endif

            @if($applicant->application_status === ApplicationStatus::APPLYING_TO_SELECTED_COMPANY)
                <livewire:company.applying-to-companies :user="$applicant??''"/>
            @endif

            @if((is_null($applicant->show_application_on_marketplace_at) && is_null($applicant->reject_marketplace_application_at)) && $applicant->companies()->exists())
                <livewire:company.application-on-marketplace :user="$applicant??''"/>
            @endif

            @if((!is_null($applicant->show_application_on_marketplace_at) || !is_null($applicant->reject_marketplace_application_at)) && $applicant->application_status->id() >= ApplicationStatus::APPLIED_TO_SELECTED_COMPANY->id() && $applicant->application_status->id() < ApplicationStatus::ENROLLMENT_ON->id())
                <livewire:company.application-to-company :user="$applicant??''">
            @endif

            @if($applicant->application_status->id() >= \App\Enums\ApplicationStatus::ENROLLMENT_ON->id())
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
        </div>
    </div>
</x-app-layout>
