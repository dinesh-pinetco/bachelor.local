<x-web>
    <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
        <div
            class="w-full max-w-screen-lg md:p-6 bg-white overflow-hidden text-black sm:rounded-lg text-xs md:text-sm space-y-6">
            <h2 class="mb-4 2xl:mb-0 text-primary text-2xl md:text-3xl lg:text-5xl font-light leading-tight">
                {{__('Selection test result')}}
            </h2>
        </div>
        @if($user->application_status->id() < \App\Enums\ApplicationStatus::TEST_RESULT_PDF_RETRIEVED_ON->id())
            <div>
                <img height="100px" width="100px" src="https://cdn-icons-png.flaticon.com/512/463/463612.png"
                     alt="failed">
                <h2>You failed in exam try again.</h2>
            </div>
            <div>
                <div>
                    <h2>Name: {{ $user->first_name }}</h2>
                    <h2>Zip: {{ $zipCode }}</h2>
                    <h2>City: {{ $city }}</h2>
                    <h2>Date Of Birth: {{ $date_of_birth }}</h2>
                </div>
            </div>
        @else
            <div style="margin-top: 3%;">
                <img height="100px" width="100px" src="https://cdn-icons-png.flaticon.com/512/190/190411.png"
                     alt="Passed">
                <h2>You have passed exam.</h2>
            </div>
            <div>
                <div>
                    <h2>Name: {{ $user->first_name }}</h2>
                    <h2>Zip: {{ $zipCode }}</h2>
                    <h2>City: {{ $city }}</h2>
                    <h2>Date Of Birth: {{ $date_of_birth }}</h2>
                </div>
            </div>
        @endif
        <div>
            <x-link-button href="{{ route('dashboard') }}">
                {{ __('Okay') }}
            </x-link-button>
        </div>
    </div>
</x-web>
