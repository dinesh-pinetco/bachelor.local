<div class="relative max-w-screen-xl mx-auto">

    <livewire:tabs :applicant="$applicant??''" />

    @if($applicant->application_status == \App\Enums\ApplicationStatus::SHOW_APPLICATION_ON_MARKETPLACE || $applicant->application_status == \App\Enums\ApplicationStatus::APPLIED_TO_SELECTED_COMPANY)
        <div>
            <div>
                <svg width="35px" height="35px" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" color="#07a207">
                    <path d="M5 13l4 4L19 7" stroke="#07a207" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <span>{{ __("Applicant has transferred data to the company portal") }}</span>
                @if($applicant->application_status == \App\Enums\ApplicationStatus::SHOW_APPLICATION_ON_MARKETPLACE)
                    <img src="{{ asset('images/icon/cancel.svg') }}" alt="transfer-data" />
                    <span>{{ __('Applicant has no active applications') }}</span> <br>

                    <img src="{{ asset('images/icon/check.svg') }}" alt="transfer-data" />
                    <span>{{ __('Applicant is listed on market place') }}</span>

                    <div>
                        <span>{{ __('The following companies have contacted the applicant') }}</span>
                        <li>Company goes here</li>
                    </div>
            </div>
            @elseif($applicant->application_status == \App\Enums\ApplicationStatus::APPLIED_TO_SELECTED_COMPANY)
                <div class="mt-4">
                        <img src="{{ asset('images/icon/check.svg') }}" alt="transfer-data" />
                        <h2>{{ __("Active application to the following") }}:</h2>
                        <div class="mt-6">
                            @foreach($companies as $company)
                                <li>{{ $company->company_name }}</li>
                            @endforeach
                        </div>
                        <div>
                            @if($applicant->application_status != \App\Enums\ApplicationStatus::SHOW_APPLICATION_ON_MARKETPLACE)
                                <img src="{{ asset('images/icon/cancel.svg') }}" alt="transfer-data" />
                            @else
                                <svg width="35px" height="35px" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" color="#07a207">
                                    <path d="M5 13l4 4L19 7" stroke="#07a207" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            @endif
                            <span>{{ __("listed on market place") }}</span>
                        </div>
                </div>
            @endif
        </div>
    @else
        <h2>{{ __("You have not applied to the company") }}</h2>
    @endif
</div>
