<x-app-layout>

    <div class="max-w-screen-xl mx-auto">
        @if(! auth()->user()->hasRole(ROLE_APPLICANT))
            <livewire:tabs :applicant="$applicant??''"/>
        @endif

        @role(ROLE_APPLICANT)
            <div class="w-full max-w-screen-xl mx-auto">
                <div class="flex">
                    <div class="hidden lg:block flex-shrink-0 w-20 md:w-32 lg:w-40 2xl:w-64"></div>
                    <h1 class="mb-5 md:mb-9 text-primary text-2xl md:text-3xl lg:text-5xl font-light leading-tight">
                        {{ __('Forms') }}
                    </h1>
                </div>
            </div>
        @endrole

        <div class="lg:pl-40 2xl:pl-64 mt-5 md:mt-0">
            @if($applicant->getMeta('enrollment_at'))
                <div class="mt-4">
                    <a class="text-primary text-sm underline"
                        href="{{ URL::signedRoute('study-sheet', ['user' => $applicant->id]) }}" target="_blank">
                        {{__('Study sheet form')}}
                    </a>
                </div>
                <div class="mt-4">
                    <a class="text-primary text-sm underline"
                        href="{{ URL::signedRoute('government-form', ['user' => $applicant->id]) }}" target="_blank">
                        {{ __('Government form') }}
                    </a>
                </div>
            @else
                <div class="">
                    <p class="text-primary">{{ __('Applicant doesn\'t have study-sheet and government-form.') }}</p>
                </div>
            @endif
        </div>
    </div>

</x-app-layout>
