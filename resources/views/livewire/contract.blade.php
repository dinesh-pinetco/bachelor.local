<div class="relative max-w-screen-xl mx-auto">
    <livewire:tabs :applicant="$applicant??''" />

    <div>
        @if($applicant->application_status == \App\Enums\ApplicationStatus::APPLIED_TO_SELECTED_COMPANY)
            <svg width="35px" height="35px" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" color="#07a207">
                <path d="M5 13l4 4L19 7" stroke="#07a207" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        @else
            <svg width="35px" height="35px" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" color="#ff0000">
                <path d="M6.758 17.243L12.001 12m5.243-5.243L12 12m0 0L6.758 6.757M12.001 12l5.243 5.243" stroke="#ff0000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        @endif
        <span>{{ __("Applicant:in has transferred data to the company portal") }}</span>
    </div>
    <div>
        {{-- // --}}
    </div>
</div>
