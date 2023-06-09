<div class="relative max-w-screen-xl mx-auto">

    <livewire:tabs :applicant="$applicant??''"/>

    @if($applicant->application_status->id() >= \App\Enums\ApplicationStatus::APPLYING_TO_SELECTED_COMPANY->id())
        <div class="lg:pl-40 2xl:pl-64 mt-5 md:mt-0">
            <div class="space-y-6">
                <div class="flex items-center space-x-4">
                    @if ($applicant->application_status->id() >= \App\Enums\ApplicationStatus::APPLIED_TO_SELECTED_COMPANY->id())
                        <svg class="w-9 h-9 flex-shrink-0" width="35px" height="35px" stroke-width="1.5" viewBox="0 0 24 24"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg" color="#07a207">
                                <path d="M5 13l4 4L19 7" stroke="#07a207" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                        </svg>
                    @else
                        <svg width="35px" height="35px" class="w-9 h-9 flex-shrink-0" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" color="#ff0000">
                            <path d="M6.758 17.243L12.001 12m5.243-5.243L12 12m0 0L6.758 6.757M12.001 12l5.243 5.243" stroke="#ff0000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            </path>
                        </svg>
                    @endif
                    <span class="text-lg lg:text-2xl font-medium text-primary mb-2">{{ __("Applicant has transferred data to the company portal") }}</span>
                </div>

                <div class="mt-4 pl-12">
                    <div class="flex items-center space-x-4">
                        @if($applicant->companies()->exists())
                            <img src="{{ asset('images/icon/check.svg') }}" alt="transfer-data"/>
                        @else
                            <img src="{{ asset('images/icon/cancel.svg') }}" alt="transfer-data"/>
                        @endif
                        <p>{{ __("Active application to the following companies") }}:</p>
                    </div>
                    <div class="pl-12 my-6 text-primary">
                        @foreach($companies as $applicantCompany)
                            <li>{{ $applicantCompany->company->name }}</li>
                        @endforeach
                    </div>
                </div>

                <div class="flex items-center space-x-4 pl-12">
                    @if($applicant->show_application_on_marketplace_at)
                        <img src="{{ asset('images/icon/check.svg') }}" alt="transfer-data"/>
                    @else
                        <img src="{{ asset('images/icon/cancel.svg') }}" alt="transfer-data"/>
                    @endif
                    <p>{{ __('Applicant is listed on market place') }}</p>
                </div>

            </div>
            @if (count($contactedCompanies))
                <div class="pl-12 my-6">
                    <p class="font-bold">{{ __('The following companies have contacted the applicant') }}</p>
                    <div class="pl-12 my-6 text-primary">
                        @foreach ($contactedCompanies as $contactedCompany)
                            <li>{{ $contactedCompany->company->name }}</li>
                        @endforeach
                    </div>
                </div>
            @endif

            @if (count($rejectedCompanies))
                <div class="pl-12 my-6">
                    <p class="font-bold">{{ __('The following companies have rejected the applicant') }}</p>
                    <div class="pl-12 my-6 text-primary">
                        @foreach ($rejectedCompanies as $contactedCompany)
                            <li>{{ $contactedCompany->company->name }}</li>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

    @else
        <div class="lg:pl-40 2xl:pl-64 mt-5 md:mt-0">
            <p class="text-primary">{{ __("Applicant have not applied to the company.") }}</p>
        </div>
    @endif
</div>
