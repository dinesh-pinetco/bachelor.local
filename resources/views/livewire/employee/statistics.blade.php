<div>
    <div class="mb-4 md:mb-7">
        <div class="flex flex-wrap justify-end md:justify-between gap-4">
            <div class="">
                <x-jet-input type="month" name="date" class="flex-grow" id="date" wire:model="date"
                             min="{{ \Carbon\Carbon::create(BEGINNING_YEAR, BEGINNING_MONTH, null)->format('Y-m') }}"
                             max="{{ now()->format('Y-m') }}"></x-jet-input>
            </div>

            <div class="w-1/2 md:w-auto">
                <div class="w-full order-4 xl:order-2">
                    <x-livewire-select
                        name="desired_beginning"
                        class="flex-grow"
                        id="desiredBeginning"
                        model="desiredBeginning">
                        <option value="">{{ __('Semester Day') }}</option>
                        @foreach ($desiredBeginnings as $selectDesiredBeginning)
                            <option
                                value="{{ data_get($selectDesiredBeginning,'key') }}">{{ data_get($selectDesiredBeginning,'title') }}</option>
                        @endforeach
                    </x-livewire-select>
                </div>
            </div>

            {{-- <div class="">
                <x-primary-button type="submit" class="-mt-0" wire:click="search">
                    {{ __('Search') }}
                </x-primary-button>
            </div> --}}
            <div class="md:ml-auto">
                <x-primary-button type="submit" class="-mt-0 flex items-center" wire:click="download">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/>
                    </svg>
                    {{ __('Download') }}
                </x-primary-button>
            </div>
        </div>
    </div>
    <h6 class="text-base md:text-xl font-medium text-primary">
        {{__('Current data')}}
    </h6>
    <div class="my-2 flex flex-wrap lg:flex-nowrap lg:space-x-4 mx-auto">
        <div class="w-full lg:w-1/2 border border-lightgray p-6 space-y-4 rounded-md">
            <div class="flex">
                <h6 class="text-darkgray">{{ __('Interested') }}: </h6>
                <a href="{{ route('employee.applicants.index', ['filteredBy' => 'interested']) }}"
                   class="text-primary pl-1">{{ data_get($statistics, 'interested') }}
                </a>
            </div>

            <div class="flex">
                <h6 class="text-darkgray">{{ __('Applications') }}: </h6>
                <a href="{{ route('employee.applicants.index', ['filteredBy' => 'approved']) }}"
                   class="text-primary pl-1">{{ data_get($statistics, 'approved') }}
                </a>
            </div>

            <div class="flex">
                <h6 class="text-darkgray flex-shrink-0">{{ __('Competency catch-up') }}: </h6>
                <a href="{{ route('employee.applicants.index', ['filteredBy' => 'competencyCatchUp']) }}"
                   class="text-primary pl-1">{{ data_get($statistics, 'competencyCatchUp') }}
                </a>
            </div>

            <div>
                <x-link-button
                    href="{{ route('employee.applicants.index', ['filteredBy' => \App\Enums\ApplicationStatus::TEST_FAILED()]) }}">
                    {{__('Check failed tests')}}
                </x-link-button>
            </div>
        </div>

        <div class="w-full lg:w-1/2 border border-lightgray p-6 space-y-4 rounded-md mt-4 lg:mt-0">
            <div class="flex">
                <h6 class="text-darkgray">{{ __('Interviews') }}: </h6>
                <a href="{{ route('employee.applicants.index', ['filteredBy' => 'testCompleted']) }}"
                   class="text-primary pl-1">{{ data_get($statistics, 'interviews') }}
                </a>
            </div>

            <div class="flex">
                <h6 class="text-darkgray">{{ __('Contracts') }}: </h6>
                <a href="{{ route('employee.applicants.index', ['filteredBy' => 'contractCompleted']) }}"
                   class="text-primary pl-1">{{ data_get($statistics, 'contracts') }}
                </a>
            </div>
        </div>
    </div>
</div>
