<div class="relative max-w-screen-xl mx-auto">

    <livewire:tabs :applicant="$applicant??''"/>

    @if($applicant->companies()->exists())
        <div class="lg:pl-40 2xl:pl-64 mt-5 md:mt-0">
            <div class="space-y-6">
                <div class="flex items-center space-x-4">
                    <svg class="w-9 h-9 flex-shrink-0" width="35px" height="35px" stroke-width="1.5" viewBox="0 0 24 24"
                         fill="none"
                         xmlns="http://www.w3.org/2000/svg" color="#07a207">
                        <path d="M5 13l4 4L19 7" stroke="#07a207" stroke-width="1.5" stroke-linecap="round"
                              stroke-linejoin="round"></path>
                    </svg>
                    <span
                        class="text-lg lg:text-2xl font-medium text-primary mb-2">{{ __("Applicant has transferred data to the company portal") }}</span>
                </div>
                @if($applicant->show_application_on_marketplace_at != null)
                    <div class="flex items-center space-x-4 pl-12">
                        <img src="{{ asset('images/icon/cancel.svg') }}" alt="transfer-data"/>
                        <p>{{ __('Applicant has no active applications') }}</p>
                    </div>
                    <div class="flex items-center space-x-4 pl-12">
                        <img src="{{ asset('images/icon/check.svg') }}" alt="transfer-data"/>
                        <p>{{ __('Applicant is listed on market place') }}</p>
                    </div>
            </div>
            @else
                <div class="mt-4 pl-12">
                    <div class="flex items-center space-x-4">
                        <img src="{{ asset('images/icon/check.svg') }}" alt="transfer-data"/>
                        <p>{{ __("Active application to the following") }}:</p>
                    </div>
                    <div class="my-6 text-primary">
                        @foreach($companies as $company)
                            <li>{{ $company->company_name }}</li>
                        @endforeach
                    </div>
                    <div class="flex items-center space-x-4">
                        @if($applicant->show_application_on_marketplace_at == null)
                            <img src="{{ asset('images/icon/cancel.svg') }}" alt="transfer-data"/>
                        @else
                            <svg width="35px" height="35px" stroke-width="1.5" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg" color="#07a207">
                                <path d="M5 13l4 4L19 7" stroke="#07a207" stroke-width="1.5" stroke-linecap="round"
                                      stroke-linejoin="round"></path>
                            </svg>
                        @endif
                        <p>{{ __("listed on market place") }}</p>
                    </div>
                </div>
            @endif

            @if (count($contactedCompanies))
                <div class="pl-12">
                    <p>{{ __('The following companies have contacted the applicant') }}</p>
                    <div class="my-6 text-primary">
                        @foreach ($contactedCompanies as $contactedCompany)
                            <li>{{ $contactedCompany->company_name }}</li>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    @else
        <p>{{ __("Applicant have not applied to the company") }}</p>
    @endif
</div>
