<x-app-layout>

    <div class="w-full max-w-screen-xl mx-auto lg:pl-40 2xl:pl-64">

        <div class="flex-grow flex flex-col flex-wrap text-primary relative">
            @if(! auth()->user()->hasRole(ROLE_APPLICANT))
                <livewire:tabs :applicant="$applicant??''"/>
            @endif

            @role(ROLE_APPLICANT)
                <div class="flex">
                    <h1 class="mb-5 md:mb-9 text-primary text-2xl md:text-3xl lg:text-5xl font-light leading-tight">
                        {{ __('Forms') }}
                    </h1>
                </div>
            @endrole

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
                <div class="lg:pl-40 2xl:pl-64 mt-5 md:mt-0">
                    <p class="text-primary">{{ __('Submit your study sheet and government form.') }}</p>
                </div>
            @endif
        </div>

    </div>
</x-app-layout>
