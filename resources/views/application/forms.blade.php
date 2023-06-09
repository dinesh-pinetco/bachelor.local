<x-app-layout>
    <div class="relative max-w-screen-xl mx-auto">
        @if(! auth()->user()->hasRole(ROLE_APPLICANT))
            <livewire:tabs :applicant="$applicant??''"/>
        @endif
        <div class="">
            @if($applicant->getMeta('enrollment_at'))
                <div class="mt-4">
                    <a class="text-primary text-sm" href="{{ URL::signedRoute('study-sheet', ['user' => $applicant->id]) }}" target="_blank">{{__('Study Sheet')}}:</a>
                </div>
                <div class="mt-4">
                    <a class="text-primary text-sm" href="{{ URL::signedRoute('government-form', ['user' => $applicant->id]) }}" target="_blank">{{ __('Government Form') }}:</a>
                </div>
            @else
                <div class="lg:pl-40 2xl:pl-64 mt-5 md:mt-0">
                    <p class="text-primary">{{ __('Applicant not submit study-sheet and government-form.') }}</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
